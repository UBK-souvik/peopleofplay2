<?php

namespace App\Http\Controllers\Front;

use App\Models\Award;
use App\Models\Event;
use App\Models\EventAward;
use App\Models\EventMedia;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\EventAwardNominee;
use App\Models\EventCategory;
use App\Models\Product;
use App\Models\User;
use App\Models\EventSocialMedia;
use Session;
use App\Helpers\UtilitiesTwo;

class EventController extends Controller
{
    public function getEvents()
    {
        $current_user = get_current_user_info();
        $events = Event::where('user_id', $current_user->id)
            ->orderBy('id', 'desc')
            ->paginate(30);

        return view('front.user.event.index', compact('events'));
    }

    public function getCreateEvent()
    {
        $categories = EventCategory::whereNull('parent_id')->pluck('name', 'id');
        $sub_categories = EventCategory::whereNotNull('parent_id')->pluck('name', 'id');
        return view('front.user.event.create', compact('categories', 'sub_categories'));
    }


    public function postCreateEvent(Request $request)
    {
        // dd($request->all());
        //$request->validate($this->validateEvent());        
		$this->validateEvent($request);
		
		try {
            $current_user = get_current_user_info();

            DB::beginTransaction();
            $event = new Event();
            if ($request->filled('event_id')) {
                $event = Event::findOrFail($request->event_id);
            }
            $event->user_id = $current_user->id;
            // $event->category_id = $request->category_id;
            // $event->sub_category_id = $request->sub_category_id;

            if ($request->hasFile('main_image')) {
                $file = $request->main_image;
                $extension = $file->getClientOriginalExtension();
				//$extension = UtilitiesTwo::get_image_ext_name();
                $timestamp = generateFilename();
                $filename = $timestamp . '.' . $extension;
                $file_path = imagePath();
                $upload_status = $file->move($file_path, $filename);
                //$upload_status =  UtilitiesTwo::compress_image($file, public_path($file_path) . $filename);//, 80
				if ($upload_status) {
                    $event->main_image = $filename;
                } else {
                    throw new \Exception(errorMessage('file_uploading_failed'));
                }
            }

            // event_id
            if (!$request->filled('event_id')) {
                $event->event_id_number = $request->event_id_number;
            }
            $event->name = $request->name;
            $event->description = $request->description;
            $event->website = $request->website;

            $event->fun_fact1 = $request->fun_fact1;
            $event->fun_fact2 = $request->fun_fact2;
            $event->fun_fact3 = $request->fun_fact3;
            
            $event->save();

            // Add Socials
            /*if ($request->filled('socials')) {
                foreach ($request->socials as $key => $socials) {
                    if (!is_null($socials)) {
                        $social_media =  EventSocialMedia::where('user_id', $event->user_id)
                            ->where('type', $key)
                            ->first();
                        if (!$social_media) {
                            $social_media = new EventSocialMedia();
                            $social_media->user_id = $event->user_id;
                            $social_media->event_id = $event->id;
                        }
                        $social_media->type = $key;
                        $social_media->value = $socials;
                        $social_media->save();
                    }
                }
            }*/			
			
			if ($request->filled('socials')) {
                foreach ($request->socials as $key => $socials) {
                    
					$social_media =  EventSocialMedia::where('user_id', $current_user->id)
					        ->where('event_id', $event->id)
                            ->where('type', $key)
                            ->first();
						
					   if (!empty($social_media->id)) {
                         	$social_media = \App\Models\EventSocialMedia::find($social_media->id);
                        }
                        else
						{
                           if (empty($socials)) {
						        continue;
					       }
                  						  	
							$social_media = new EventSocialMedia();
						}	
						
						$social_media->user_id = $event->user_id;
                        $social_media->event_id = $event->id;
                        $social_media->type = $key;
                        $social_media->value = $socials;
                        $social_media->save();                    
                }
            }
						
            DB::commit();
            return successMessage('Event Saved Successfully');
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
            return errorMessage($e->getMessage(), true);
        }
    }

    public function postAwardCreate(Request $request)
    {
        $request->validate(
            [
                'id' => 'nullable|exists:awards,id',
                'name' => 'required',
                'description' => 'required',
                'year_established' => 'required',
                'year_dissolved' => 'required',
                'events_associated_with' => 'required',
                'previous_year_recipients' => 'required',
                'previous_year_products' => 'required',
            ]
        );

        try {

            DB::beginTransaction();
            $award = new Award();
            if ($request->filled('id')) {
                $award = Award::find($request->id);
            }
            foreach ($request->only(Award::$fillable_shadow) as $key => $value) {
                $award->$key = $value;
            }
            $award->save();
            DB::commit();
            return successMessage($award);
        } catch (\Exception $e) {
            DB::rollback();
            return errorMessage($e->getMessage(), true);
        }
    }


    public function getEventView($slug)
    {
        $event = Event::where('slug', $slug)
            ->firstOrFail();

        return view('front.user.event.view', compact('event'));
    }

    public function getDeleteEvent($slug)
    {
		try {

            DB::beginTransaction();
			
			$event = Event::where('slug', $slug)->firstOrFail();
			
            //Event::where('slug', $slug)->firstOrFail()->delete();		    
			EventAward::where('event_id', $event->id)->delete();
			EventSocialMedia::where('event_id', $event->id)->delete();  
            Event::where('id', $event->id)->delete();			
			 
			DB::commit();
			
			Session::flash('event_data_deleted_flag', 1);
            
        } catch (\Exception $e) {
            DB::rollback();
            
			Session::flash('event_data_deleted_flag', 0);
        }
		
        return redirect()->route('front.user.event.index');
    }

    public function getUpdateEvent($slug)
    {
        $event = Event::where('slug', $slug)->firstOrFail();

        $categories = EventCategory::whereNull('parent_id')->pluck('name', 'id');
        $sub_categories = EventCategory::whereNotNull('parent_id')->pluck('name', 'id');
        return view('front.user.event.create', compact('categories', 'sub_categories', 'event'));
    }

    public function getNominee(Request $request)
    {
        // pr($request->all(),1);
        $request->validate([
            'type' => 'required|in:1,2',
            'query' => 'required'
        ]);

        $result = null;
        if ($request->type == 1) {
            $result = Product::where('name', 'like', '%' . $request->input('query.term') . '%')
                ->select('name as text', 'id')
                ->paginate(50);
        } else {
            $result = User::where(DB::raw('concat(first_name," ",last_name)') , 'LIKE' , '%' . $request->input('query.term') . '%')
            // $result = User::where('first_name', 'like', '%' . $request->input('query.term') . '%')
                // ->orWhere('last_name', 'like', '%' . $request->input('query.term') . '%')
                ->orWhere('email', 'like', '%' . $request->input('query.term') . '%')
                ->select(DB::raw('CONCAT(first_name," ",last_name," | ",email) as text'), 'id')
                ->paginate(50);
        }

        return response()->json($result, 200);
    }
    public function getAgent(Request $request)
    {
        // pr($request->all(),1);
        $request->validate([
            'query' => 'required'
        ]);

        $result = null;
        $result = User::where(DB::raw('concat(first_name," ",last_name)') , 'LIKE' , '%' . $request->input('query.term') . '%')
        // $result = User::where('first_name', 'like', '%' . $request->input('query.term') . '%')
            // ->orWhere('last_name', 'like', '%' . $request->input('query.term') . '%')
            ->where('role',3)
            ->select(DB::raw('CONCAT(first_name," ",last_name) as text'), 'id')
            ->paginate(50);
        // pr($result->toArray(),1);
        return response()->json($result, 200);
    }

    // Private Methods
    private function validateEvent(Request $request)
    {
        /*return [
            'event_id' => 'nullable|exists:events,id',
            'event_id_number' => 'required_without:event_id',
            'main_image' => 'required_without:event_id|file',
            'name' => 'required',
            'description' => 'required',
            'website' => 'required',
            // 'award' => 'required|array',
            // 'award.*.type' => 'required|in:1,2',
            // 'award.*.name' => 'required',
            // 'award.*.nominee.*.is_winner' => 'required',
            // 'award.*.nominee.*.reference_type' => 'required',
            // 'award.*.nominee.*.reference' => 'required'
            // 'category_id' => 'required|exists:event_categories,id',
            // 'sub_category_id' => 'required|exists:event_categories,id',
            // 'year_started' => 'required',
            // 'company' => 'required',
            // 'company_info' => 'required',
            // 'award.*.id' => 'required|exists:awards,id',
            // 'award.*.description' => 'required',
            // 'award.*.year_established' => 'required',
            // 'award.*.year_dissolved' => 'required',
            // 'award.*.events_associated_with' => 'required',
            // 'award.*.previous_year_recipients' => 'required',
            // 'award.*.previous_year_products' => 'required'
        ]; */
		
				 $rules = [
                    'event_id' => 'nullable|exists:events,id',
            'event_id_number' => 'required_without:event_id',
            //'main_image' => 'required|file',//required_without:event_id|file
            'name' => 'required',
            'description' => 'required',
            'website' => 'required',
            'socials.*' => 'sometimes|nullable|url',
            // 'award' => 'required|array',
            // 'award.*.type' => 'required|in:1,2',
            // 'award.*.name' => 'required',
            // 'award.*.nominee.*.is_winner' => 'required',
            // 'award.*.nominee.*.reference_type' => 'required',
            // 'award.*.nominee.*.reference' => 'required'
            // 'category_id' => 'required|exists:event_categories,id',
            // 'sub_category_id' => 'required|exists:event_categories,id',
            // 'year_started' => 'required',
            // 'company' => 'required',
            // 'company_info' => 'required',
            // 'award.*.id' => 'required|exists:awards,id',
            // 'award.*.description' => 'required',
            // 'award.*.year_established' => 'required',
            // 'award.*.year_dissolved' => 'required',
            // 'award.*.events_associated_with' => 'required',
            // 'award.*.previous_year_recipients' => 'required',
            // 'award.*.previous_year_products' => 'required'
    ];
	
	$niceNames = [
            //    'event_id' => 'nullable|exists:events,id',
            'event_id_number' => 'Event Id',
            //'main_image' => 'Image',
            'name' => 'Name',
            'description' => 'Description',
            'website' => 'Website',
            // 'award' => 'required|array',
            // 'award.*.type' => 'required|in:1,2',
            // 'award.*.name' => 'required',
            // 'award.*.nominee.*.is_winner' => 'required',
            // 'award.*.nominee.*.reference_type' => 'required',
            // 'award.*.nominee.*.reference' => 'required'
            // 'category_id' => 'required|exists:event_categories,id',
            // 'sub_category_id' => 'required|exists:event_categories,id',
            // 'year_started' => 'required',
            // 'company' => 'required',
            // 'company_info' => 'required',
            // 'award.*.id' => 'required|exists:awards,id',
            // 'award.*.description' => 'required',
            // 'award.*.year_established' => 'required',
            // 'award.*.year_dissolved' => 'required',
            // 'award.*.events_associated_with' => 'required',
            // 'award.*.previous_year_recipients' => 'required',
            // 'award.*.previous_year_products' => 'required'
    ];
    $name = [
                'socials.*' => 'Socials URL format is Invalid. Please enter full https:// address'
            ]; 
       return $this->validate($request, $rules, $name, $niceNames);
		
    }

    private function addEventAwards($request, $event_id)
    {
        $data = [];
        foreach ($request->award as $award) {
            $data[] = array_merge(Arr::only($award, Award::$fillable_shadow), [
                'award_id' => $award['id'],
                'event_id' => $event_id
            ]);
        }

        return EventAward::insert($data);
    }

    private function addEventMedia($request, $event_id)
    {
        $data = [];
        if ($request->hasFile('photo')) {

            foreach ($request->photo as $photo) {
                $file = $photo;
                $extension = $file->getClientOriginalExtension();
                $timestamp = generateFilename();
                $filename = $timestamp . '.' . $extension;
                $file_path = imagePath();
                $upload_status = $file->move($file_path, $filename);
                if ($upload_status) {
                    $data[] = [
                        'title' => $filename,
                        'event_id' => $event_id,
                        'media_type' => 1
                    ];
                } else {
                    throw new \Exception(errorMessage('file_uploading_failed'));
                }
            }
        }

        if ($request->hasFile('video')) {
            foreach ($request->video as $video) {
                $file = $video;
                $extension = $file->getClientOriginalExtension();
                $timestamp = generateFilename();
                $filename = $timestamp . '.' . $extension;
                $file_path = imagePath();
                $upload_status = $file->move($file_path, $filename);
                if ($upload_status) {
                    $data[] = [
                        'title' => $filename,
                        'event_id' => $event_id,
                        'media_type' => 2
                    ];
                } else {
                    throw new \Exception(errorMessage('file_uploading_failed'));
                }
            }
        }

        if ($request->hasFile('article')) {
            foreach ($request->article as $article) {
                $file = $article;
                $extension = $file->getClientOriginalExtension();
                $timestamp = generateFilename();
                $filename = $timestamp . '.' . $extension;
                $file_path = imagePath();
                $upload_status = $file->move($file_path, $filename);
                if ($upload_status) {
                    $data[] = [
                        'title' => $filename,
                        'event_id' => $event_id,
                        'media_type' => 3
                    ];
                } else {
                    throw new \Exception(errorMessage('file_uploading_failed'));
                }
            }
        }

        return EventMedia::insert($data);
    }

    public function test_data_check()
    {
        return view('welcome');
    }
}
