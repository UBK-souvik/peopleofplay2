<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Event;
use App\Models\Product;
use App\Models\HomePage;
use App\Models\HomePageAward;
use App\Models\HomePageAwardType;
use Illuminate\Http\Request;
use App\Models\HomePageDetail;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\BrandList;
use App\Models\HomePageWhateverDay;
use App\Helpers\UtilitiesTwo;
use App\Helpers\UtilitiesFour;
use App\Helpers\Utilities;
use Validator;

class HomePageController extends Controller
{
	
	public function getHappyWhateverDayIndex()
    {
        return view('admin.home_page.indexHomeWhateverDays');
    }

    public function getHappyWhateverDayList(Request $request)
    {
        $main_list_page = HomePageWhateverDay::select('*');
        if(isset($request->type) && !empty($request->type)){
            $main_list_page = $main_list_page->where('type',$request->type);
        }
        return \DataTables::of($main_list_page)
           
			->editColumn('featured_image', function ($query) {
                return @imageBasePath($query->product_data->main_image);
            })
            ->editColumn('status', function ($query) {
                return @config('cms.action_status')[$query->status];
            })
            ->make();
    }
	
	public function getHappyWhateverDayUpdate(Request $request)
    {
        $get_product_list_dropdown = Product::get_product_list_dropdown();
		
		$happy_whatever_day = HomePageWhateverDay::find($request->id);
        
        return view('admin.home_page.home_whatever_day_create', compact('happy_whatever_day', 'get_product_list_dropdown'));
    }
	
	public function getHappyWhateverDayCreate(Request $request)
    {
        $get_product_list_dropdown = Product::get_product_list_dropdown();
		
		return view('admin.home_page.home_whatever_day_create', compact('get_product_list_dropdown'));
    }
	
	public function getHappyWhateverDayDelete($id)
    {
		try {
            DB::beginTransaction();
		
        $happy_whatever_day  = HomePageWhateverDay::findOrFail($id)->delete();
        DB::commit();
		return response()->json([
            'status' => 1,
            'msg' => adminTransLang('request_processed_successfully'),
        ], 200);
		
	    } catch (\Exception $e) {
            DB::rollback();
            return errorMessage($e->getMessage(), true);
        }	
    }
	
	public function saveOrder(Request $request)
    {
		$data = array();
		
		try {
            DB::beginTransaction();
			
			foreach($request->display_order as $display_order_key => $display_order_val)
			{
				$update = HomePage::where('id', $display_order_key)
				->update(['display_order' => $display_order_val]);
				
			}
		         
		 DB::commit();
			return response()->json([
            'status'    => 1,
            'msg'       => adminTransLang('request_processed_successfully'),
        ], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return errorMessage($e->getMessage(), true);
        }
		
    }

    public function postHappyWhateverDayUpdate(Request $request)
    {
		$data = array();
		
		$int_happy_whatever_day_id =  @$request->happy_whatever_day_id;
		
		$request->validate([
            'happy_whatever_day_id' => 'nullable|exists:home_page_whatever_days,id',
            //'featured_image' => 'required_without:happy_whatever_day_id|file',
            'home_caption_one' => 'required',
			'home_caption_two' => 'required',
			'product_id' => 'required',
            'status' => 'required|in:0,1'
        ]);
		
		try {
            DB::beginTransaction();
        // pr($data,1);			
		//$data['home_caption_one'] = $request->home_caption_one;			
        //$data['home_caption_two'] = $request->home_caption_two;
        //$data['home_page_url'] = $request->home_page_url;
        //$data['status'] = $request->status;  		
		
    $hpw_chk_dup_data = HomePageWhateverDay::select('id')
	->where('date_to_be_published', $request->date_to_be_published)
	->first();
	
	if(!empty($request->date_to_be_published))
	{
		if(!empty($hpw_chk_dup_data) && $hpw_chk_dup_data->id && $int_happy_whatever_day_id!=$hpw_chk_dup_data->id)
		{
			$error_msg = 'Happy Whatever day already exists on this Date. Please Select a different Date';
			$message_new = ['msg' => $error_msg];
			return response()->json($message_new, 422);
		}
	}	
         
            //$data = UtilitiesFour::uploadImageToDirectory($data, $request, 'featured_image', 'happy_whatever_day');
			
            //HomePageWhateverDay::updateOrCreate(['id' => $request->happy_whatever_day_id], $data);
			
		if(!empty($request->happy_whatever_day_id))
		{
		   $happy_whatever_day = HomePageWhateverDay::find($request->happy_whatever_day_id);
		}
		else
		{
		   $happy_whatever_day = new \App\Models\HomePageWhateverDay();
		}	
        
		//print_r($happy_whatever_day);
       
        $happy_whatever_day->home_caption_one = $request->home_caption_one;
		$happy_whatever_day->home_caption_two = $request->home_caption_two;
		$happy_whatever_day->product_id = $request->product_id;
		$happy_whatever_day->date_to_be_published = $request->date_to_be_published;
		
		//if(!empty($data['featured_image']))
		//{
		  //$happy_whatever_day->featured_image = $data['featured_image'];
		//}
		
		$happy_whatever_day->status = $request->status;
        $happy_whatever_day->save();
			        
		 DB::commit();
			return response()->json([
            'status'    => 1,
            'msg'       => adminTransLang('request_processed_successfully'),
        ], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return errorMessage($e->getMessage(), true);
        }
		
    }
	
    public function getIndex()
    {
        return view('admin.home_page.index');
    }

    public function getList()
    {
        $home_page = HomePage::select('*');
        return \DataTables::of($home_page)
            ->editColumn('type', function ($query) {
                return @config('cms.home_page_type')[$query->type];
            })
            ->editColumn('status', function ($query) {
                return @config('cms.action_status')[$query->status];
            })
            ->make();
    }


    public function getUpdate(Request $request)
    {
        $home_page = HomePage::find($request->id);
        if (!$home_page) {
            return redirect()->route('admin.home_page.index')->with(['fail' => adminTransLang('setting_not_found')]);
        }
        return view('admin.home_page.update', compact('home_page'));
    }

    // when the home page section is updated
    public function postUpdate(Request $request)
    {
        // pr($request->all(),1);
        // $request->validate([
        //     'title' => 'required',
        //     'display_order' => 'required|digits_between:1,6',
        //     'type' => 'required|in:' . implode(',', array_keys(config('cms.home_page_type'))),
        //     'status' => 'required|in:0,1',
        //     'expandable' => 'nullable',

        //     'Link'      => 'required_if:type,==,0|required_if:status,==,1|array|min:3',
        //     "Link.*"  => "required_if:type,==,0|required_if:status,==,1|string|distinct|min:3",
        //     'RightLink' => 'required_if:type,==,0|required_if:status,==,1|array|min:3',
        //     "RightLink.*"  => "required_if:type,==,0|required_if:status,==,1|string|distinct|min:3",
        // ]);

        $rules = array(
            'title' => 'required',
            //'display_order' => 'required|digits_between:1,6',
            'type' => 'required|in:' . implode(',', array_keys(config('cms.home_page_type'))),
            'status' => 'required|in:0,1',
            'expandable' => 'nullable',
        );

        if($request->type == 0)
        {
            $rules['Link']    = 'required_if:status,==,1|array|min:3';
            // $rules["Link.*"]  = "required_if:status,==,1";
            $rules['RightLink']  = 'required_if:status,==,1|array|min:3';
            $rules["RightLink.*"]  = "required_if:status,==,1";
        }

        $this->validate($request, $rules);

        $home_page = HomePage::find($request->id);

        //HomePage::where('display_order', $request->display_order)
        //    ->update([
        //        'display_order' => $home_page->display_order
        //    ]);

        $home_page->title = $request->title;
        //$home_page->display_order = $request->display_order;
        $home_page->type = $request->type;
        $home_page->status = $request->status;
        $home_page->save();
		
		// for products , events, brands, users,...
        if ($request->filled('expandable') && in_array($request->type, [1, 2, 4, 6, 7])) {
            HomePageDetail::where('home_page_id', $home_page->id)->delete();
            foreach ($request->expandable ?? [] as $expandable) {
                $home_page_detail = new HomePageDetail();
                $home_page_detail->home_page_id =  $home_page->id;
                $home_page_detail->type =  $home_page->type;
                $home_page_detail->reference_id =  $expandable;
                $home_page_detail->save();
            }
        }

        // for links,...
        if ($request->filled('Link') && $request->filled('RightLink') && in_array($request->type, [0])) {
            HomePageDetail::where('home_page_id', $home_page->id)->delete();
            foreach ($request->Link ?? [] as $link) {
                $home_page_detail = new HomePageDetail();
                $home_page_detail->home_page_id =  $home_page->id;
                $home_page_detail->type =  $home_page->type;
                $home_page_detail->video_link =  $link;
				
				$GetAPI = @GetYoutubeAPI($link);
				$video_link_thumbnail = @$GetAPI['thumbnail']['thumb'];
				$video_link_title = @$GetAPI['title'];
				$video_link_duration = @$GetAPI['duration'];
				$video_link_description = @$GetAPI['description'];
				
				$home_page_detail->video_link_title =  $video_link_title;
				$home_page_detail->video_link_duration =  $video_link_duration;
				$home_page_detail->video_link_description =  $video_link_description;
				$home_page_detail->video_link_thumbnail =  $video_link_thumbnail;
				
                $home_page_detail->save();
            }
            foreach ($request->RightLink ?? [] as $RightLink) {
                $home_page_detail = new HomePageDetail();
                $home_page_detail->home_page_id =  $home_page->id;
                $home_page_detail->type =  $home_page->type;
                $home_page_detail->right_video_link =  $RightLink;
				
				$Right_GetAPI = @GetYoutubeAPI($RightLink);
				$right_video_link_thumbnail = @$Right_GetAPI['thumbnail']['thumb'];
				$right_video_link_title = @$Right_GetAPI['title'];
				$right_video_link_duration = @$Right_GetAPI['duration'];
				$right_video_link_description = @$Right_GetAPI['description'];
				
				$home_page_detail->right_video_link_title =  $right_video_link_title;
				$home_page_detail->right_video_link_duration =  $right_video_link_duration;
				$home_page_detail->right_video_link_description =  $right_video_link_description;
				$home_page_detail->right_video_link_thumbnail =  $right_video_link_thumbnail;
				
                $home_page_detail->save();
            }
        }

        return response()->json([
            'status' => 1,
            'msg' => adminTransLang('request_processed_successfully'),
        ], 200);
    }

    // binding the data to the auto select drop down in update home page section
    public function getDataOnBasisOfType(Request $request)
    {
        $request->validate([
            'type' => 'required|in:' . implode(',', array_keys(config('cms.home_page_type'))),
            'query.term' => 'required'
        ]);
        $data = null;
        $term = $request->input('query.term');
        switch ($request->type) {
            case 1:
                $data = Product::where('name', 'like', '%' . $term . '%')->select('name as text', 'id')->paginate(50);
                break;

            case 2:
                $data = Event::where('name', 'like', '%' . $term . '%')->select('name as text', 'id')->paginate(50);
                break;

            case 4:
                # code...
                break;

            case 6:
                $data = User::select(DB::raw('CONCAT(first_name," | ",email) as text'), 'id')
                    ->where('stripe_id', '!=', NULL)
			        ->where('stripe_id', '<>',  '')
					->where('email', 'like', '%' . $term . '%')
                    ->orWhere('first_name', 'like', '%' . $term . '%')
                    ->paginate(50);
                break;
			case 7:
                $data = BrandList::where('name', 'like', '%' . $term . '%')->select('name as text', 'id')->paginate(50);
                break;	
        }

        return response()->json($data, 200);
    }


    public function getHomeAwardIndex()
    {
        return view('admin.home_page.indexAwardList');
    }

     public function getAwardList(Request $request)
    {
        $main_list_page = HomePageAward::select('*');
        //$main_list_page = HomePageAward::get();
       // echo "<pre>"; print_r($main_list_page); die;
        // if(isset($request->type) && !empty($request->type)){
        //     $main_list_page = $main_list_page->where('type',$request->type);
        // }
        return \DataTables::of($main_list_page)
           
            ->editColumn('featured_image', function ($query) {
                return @imageBasePath($query->featured_image);
            })
            ->editColumn('status', function ($query) {
                return @config('cms.action_status')[$query->status];
            })
            ->make();
    }

    public function getHomeAwradCreate(Request $request)
    {
     
         $get_award_type_list = HomePageAwardType::get();
        return view('admin.home_page.home_page_award_create',compact('get_award_type_list')); 
        // return view('admin.home_page.home_page_award_create');
    } 
    public function postHomeAwardUpdate(Request $request)
    {
     
     // echo "<pre>"; print_r($request->hasFile('featured_image')); die;
        $data = array();
        $messages = [
        'image.required' => 'The Image is required.',
        'type.required' => 'The Type is required.',
        'status.required' => 'The Status is required.',
        'homa_caption_url_one.required' => 'The Caption One Url is required.',
        'homa_caption_url_one.url' => 'The Caption One Url Invalid Url.',
        'homa_caption_url_two.required' => 'The Caption Two Url is required.',
        'homa_caption_url_two.url' => 'The Caption Two Url Invalid Url.',
        'homa_caption_url_three.required' => 'The Caption Three Url is required.',
        'homa_caption_url_three.url' => 'The Caption Three Url Invalid Url.',
        'homa_caption_url_four.required' => 'The Caption Four Url is required.',
        'homa_caption_url_four.url' => 'The Caption Four Url Invalid Url.',
        'homa_caption_url_five.required' => 'The Caption Five Url is required.',
        'homa_caption_url_five.url' => 'The Caption Five Url Invalid Url.',
        'homa_caption_url_six.required' => 'The Caption Six Url is required.',
        'homa_caption_url_six.url' => 'The Caption Six Url Invalid Url.',
        'homa_caption_url_seven.required' => 'The Caption Seven Url is required.',
        'homa_caption_url_seven.url' => 'The Caption Seven Url Invalid Url.',
        ];
        $int_happy_whatever_day_id =  @$request->happy_whatever_day_id;
       $errorArr =  [
            'happy_whatever_day_id' => 'nullable|exists:home_page_whatever_days,id',
            'image' => 'required',
            'type' => 'required',
            'status' => 'required|in:0,1',
          
        ];
        if(!empty($request->home_caption_one)) {
            $errorArr['homa_caption_url_one'] = 'required|url';
        } 
        if(!empty($request->home_caption_two)) {
            $errorArr['homa_caption_url_two'] = 'required|url';
        } 
        if(!empty($request->home_caption_three)) {
            $errorArr['homa_caption_url_three'] = 'required|url';
        }
        if(!empty($request->home_caption_four)) {
            $errorArr['homa_caption_url_four'] = 'required|url';
        }

        if(!empty($request->home_caption_five)) {
            $errorArr['homa_caption_url_five'] = 'required|url';
        }

        if(!empty($request->home_caption_six)) {
            $errorArr['homa_caption_url_six'] = 'required|url';
        }

        if(!empty($request->home_caption_seven)) {
            $errorArr['homa_caption_url_seven'] = 'required|url';
        }
        $request->validate($errorArr,$messages);
        
        try {
            DB::beginTransaction();
        
            
        if(!empty($request->happy_whatever_day_id))
        {
           $home_award = HomePageAward::find($request->happy_whatever_day_id);
        }
        else
        {
           $home_award = new \App\Models\HomePageAward();
        }   
        

        if ($request->hasFile('featured_image')) {
                // Shubham Code For Image Compression Start //
                    $file_comp = $request->featured_image;
                    $extension = $file_comp->getClientOriginalExtension();
                    $timestamp = generateFilename();
                    $filename = $timestamp . '_award_'.'.' . $extension;
                    $file_path = imagePath();
                    $image_comp_size = getimagesize($file_comp);
                    $img = \Image::make($file_comp->getRealPath());
                    $destinationPath = public_path($file_path);
                    if($img->resize($image_comp_size[0], $image_comp_size[1], function ($constraint) {
                        $constraint->aspectRatio();
                        })->save($destinationPath.'/'.$filename,50,'jpg')){

                            $home_award->featured_image = $filename;
                    }else{
                        throw new \Exception(errorMessage('file_uploading_failed'));
                    }
                // Shubham Code For Image Compression End //
            }
       $url_three = $url_four = $url_five = $url_six = $url_seven ='';
    if(!empty($request->home_caption_three)) {
            $url_three = array(
                'caption' =>$request->home_caption_three,
                'url' =>$request->homa_caption_url_three
            );
            $url_three = json_encode($url_three);
      }
       if(!empty($request->home_caption_four)) {
        $url_four = array(
            'caption' =>$request->home_caption_four,
            'url' =>$request->homa_caption_url_four
        );
        $url_four = json_encode($url_four);
    }
     if(!empty($request->home_caption_five)) {
        $url_five = array(
            'caption' =>$request->home_caption_five,
            'url' =>$request->homa_caption_url_five
        );
         $url_five = json_encode($url_five);
    }
     if(!empty($request->home_caption_five)) {
        $url_six = array(
            'caption' =>$request->home_caption_six,
            'url' =>$request->homa_caption_url_six
        );
        $url_six = json_encode($url_six);
    }
    if(!empty($request->home_caption_five)) {
        $url_seven = array(
            'caption' =>$request->home_caption_seven,
            'url' =>$request->homa_caption_url_seven
        );
        $url_seven = json_encode($url_seven);
    }
        $home_award->type = $request->type;
        $home_award->home_caption_one = $request->home_caption_one;
        $home_award->homa_caption_url_one = $request->homa_caption_url_one;
        $home_award->home_caption_two = $request->home_caption_two;
        $home_award->homa_caption_url_two = $request->homa_caption_url_two;
        $home_award->url_caption_three =$url_three;
        $home_award->url_caption_four = $url_four;
        $home_award->url_caption_five = $url_five;
        $home_award->url_caption_six = $url_six;
        $home_award->url_caption_seven = $url_seven;
        $home_award->status = $request->status;
        
        $home_award->save();
                    
         DB::commit();
            return response()->json([
            'status'    => 1,
            'msg'       => adminTransLang('request_processed_successfully'),
        ], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return errorMessage($e->getMessage(), true);
        }
    }

    public function getHomeAwardDelete($id)
    {
        try {
            DB::beginTransaction();
        
        $happy_whatever_day  = HomePageAward::findOrFail($id)->delete();
        DB::commit();
        return response()->json([
            'status' => 1,
            'msg' => adminTransLang('request_processed_successfully'),
        ], 200);
        
        } catch (\Exception $e) {
            DB::rollback();
            return errorMessage($e->getMessage(), true);
        }   
    }

    public function getHomeAwardUpdate($id)
    {
        $home_page_award = HomePageAward::find($id);
          $get_award_type_list = HomePageAwardType::get();
        return view('admin.home_page.home_page_award_create', compact('home_page_award','get_award_type_list'));
    }


    public function getHomeAwardTypeIndex()
    {
        return view('admin.home_page.indexAwardListType');
    }

     public function getAwardTypeList(Request $request)
    {

        $main_list_page = HomePageAwardType::select('*');
        //$main_list_page = HomePageAward::get();
       // echo "<pre>"; print_r($main_list_page); die;
        // if(isset($request->type) && !empty($request->type)){
        //     $main_list_page = $main_list_page->where('type',$request->type);
        // }
        return \DataTables::of($main_list_page)
           
            ->editColumn('featured_image', function ($query) {
                return @imageBasePath($query->featured_image);
            })
            ->editColumn('status', function ($query) {
                return @config('cms.action_status')[$query->status];
            })
            ->make();
    }

       public function getHomeAwardTypeDelete($id)
    {
        try {
            DB::beginTransaction();
        
        $happy_whatever_day  = HomePageAwardType::findOrFail($id)->delete();
        DB::commit();
        return response()->json([
            'status' => 1,
            'msg' => adminTransLang('request_processed_successfully'),
        ], 200);
        
        } catch (\Exception $e) {
            DB::rollback();
            return errorMessage($e->getMessage(), true);
        }   
    }

    public function getHomeAwradTypeCreate(Request $request)
    {
    return view('admin.home_page.home_page_award_type_create');
    }

    public function getHomeAwardTypeUpdate($id)
    {
        $home_page_award_type = HomePageAwardType::find($id);
        return view('admin.home_page.home_page_award_type_create', compact('home_page_award_type'));
    }



      public function postHomeAwardTypeUpdate(Request $request)
    {
     
     // echo "<pre>"; print_r($request->hasFile('featured_image')); die;
        $data = array();
        $messages = [
        'title.required' => 'The Title is required.',
        'status.required' => 'The Status is required.',
        
        ];
        $int_happy_whatever_day_id =  @$request->happy_whatever_day_id;
       $errorArr =  [
            'happy_whatever_day_id' => 'nullable|exists:home_page_whatever_days,id',
            'title' => 'required',
            'status' => 'required|in:0,1',
          
        ];
        
        $request->validate($errorArr,$messages);
        
        try {
            DB::beginTransaction();
        
            
        if(!empty($request->happy_whatever_day_id))
        {
           $home_award_type = HomePageAwardType::find($request->happy_whatever_day_id);
        }
        else
        {
           $home_award_type = new \App\Models\HomePageAwardType();
        }   
    
        $home_award_type->title = $request->title;
        $home_award_type->status = $request->status;
        $home_award_type->save();
                    
         DB::commit();
            return response()->json([
            'status'    => 1,
            'msg'       => adminTransLang('request_processed_successfully'),
        ], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return errorMessage($e->getMessage(), true);
        }
    }
}
