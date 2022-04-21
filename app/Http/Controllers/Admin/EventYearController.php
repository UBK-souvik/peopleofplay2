<?php

namespace App\Http\Controllers\Admin;

use App\Models\Pub;
use App\Models\EventYear;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
//use App\User;
use App\Models\User;
use App\Models\EventSocialMedia;
use Session;
use App\Helpers\UtilitiesTwo;

class EventYearController extends Controller
{
    public function getIndex()
    {
// echo 111;exit;
        return view('admin.eventyear.index');
    }

    public function getList()
    {
        // echo 1111;exit;

        $event_profile = \App\Models\EventYear::select('*');
        // print_r($event_profile);exit;
        return \DataTables::of($event_profile)
            ->editColumn('main_image', function ($query) {
                return @imageBasePath($query->main_image) ?? null;
            })

            ->make();
    }

    public function getCreate()
    {
        // $users = User::pluck('email', 'id');
        //$users = User::where('role', '!=', 1)->get();
        // pr($users,1);
        $users = User::get_all_user_list_by_email_name();
		return view('admin.eventyear.create', compact('users'));
    }

    public function postCreate(Request $request)
    {
        // echo 111;exit;
            $event_profile = new EventYear();


        $request->validate([
            // 'event_id' => 'nullable|exists:events,id',

            'main_image' => 'required_without|file',
            'profileName' => 'required',
            // 'profileSubtitle' => 'required',
            'profileUrl' => 'required',

        ]);
        try {
            DB::beginTransaction();
            if ($request->filled('profile_id')) {
                    $event_profile = EventYear::findOrFail($request->profile_id);
                }


            if ($request->hasFile('main_image')) {
                // echo 111;exit;
                //$extension = UtilitiesTwo::get_image_ext_name();
                // Shubham Code For Image Compression Start //
                    $file_comp = $request->main_image;
                    $extension = $file_comp->getClientOriginalExtension();
                    $timestamp = generateFilename();
                    $image_comp_size = getimagesize($file_comp);
                    $filename = $timestamp . '.' . $extension;
                    $file_path = imagePath();
                    $img = \Image::make($file_comp->getRealPath());
                    $destinationPath = public_path($file_path);
                    if($img->resize($image_comp_size[0], $image_comp_size[1], function ($constraint) {
                        // echo 111;exit;
                        $constraint->aspectRatio();
                        })->save($destinationPath.$filename,50,'jpg')){

                            $event_profile->main_image = $filename;
                    }else{
                            // echo 2222222222;exit;

                        throw new \Exception(errorMessage('file_uploading_failed'));
                    }
                // Shubham Code For Image Compression End //
            }

            $event_profile->profileName = $request->profileName;
            $event_profile->profileSubtitle = $request->profileSubtitle;
            $event_profile->profileUrl = $request->profileUrl;

                // print_r ($event_profile);exit;
            $event_profile->save();

            // Add Socials
            DB::commit();
            // Session::flash('blog_data_saved_flag', 1);
            Session::flash('news_data_saved_flag', 1);
            return response()->json([
                'status' => 1,
                'msg' => adminTransLang('request_processed_successfully'),
            ], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return errorMessage($e->getMessage(), true);
        }
    }

    public function getUpdate($id)
    {

        $event_profile  = EventYear::findOrFail($id);
        // echo "<pre>";
        // print_r($event_profile);exit;
        // $users = User::pluck('email', 'id');
        //$users = User::where('role', '!=', 1)->get();
		// $users = User::get_all_user_list_by_email_name();
        return view('admin.eventyear.create', compact('event_profile'));
    }

    public function getView($id)
    {
        // echo 111;exit;
        $event_profile  = EventYear::findOrFail($id);
        //$users = User::pluck('email', 'id');
		// $users = User::get_all_user_list_by_email_name();
        return view('admin.eventyear.view', compact('event_profile'));
    }

    public function getDelete($id)
    {
        $event_profile  = EventYear::findOrFail($id)->delete();
        return response()->json([
            'status' => 1,
            'msg' => adminTransLang('request_processed_successfully'),
        ], 200);
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
            ->where('role', '!=', 1)
            ->select(DB::raw('CONCAT(first_name," ",last_name) as text'), 'id')
            ->paginate(50);

        return response()->json($result, 200);
    }



    public function getPubIndex()
    {
        return view('admin.pub.index');
    }

    public function getPubList()
    {
        $event = Pub::select('*');
        return \DataTables::of($event)
            ->editColumn('main_image', function ($query) {
                return @imageBasePath($query->main_image) ?? null;
            })

            ->make();
    }

    public function getPubCreate()
    {
        //$users = User::where('role', '!=', 1)->get();
		$users = User::get_all_user_list_by_email_name();
        return view('admin.pub.create', compact('users'));
    }

    public function postPubCreate(Request $request)
    {
        $request->validate([
            'header' => 'required',
        ]);
        try {

            DB::beginTransaction();
            $pub = new Pub;
            if ($request->filled('id')) {
                $pub = Pub::findOrFail($request->id);
            }

            if ($request->hasFile('main_image')) {
                // Shubham Code For Image Compression Start //
                    $file_comp = $request->main_image;
                    $extension = $file_comp->getClientOriginalExtension();
                    $timestamp = generateFilename();
                    $filename = $timestamp . '.' . $extension;
                    $file_path = imagePath();
                    $image_comp_size = getimagesize($file_comp);
                    $img = \Image::make($file_comp->getRealPath());
                    $destinationPath = public_path($file_path);
                    if($img->resize($image_comp_size[0], $image_comp_size[1], function ($constraint) {
                        $constraint->aspectRatio();
                        })->save($destinationPath.'/'.$filename,50,'jpg')){

                            $pub->main_image = $filename;
                    }else{
                        throw new \Exception(errorMessage('file_uploading_failed'));
                    }
                // Shubham Code For Image Compression End //
            }

            if ($request->hasFile('zoom_image_1')) {

                // Shubham Code For Image Compression Start //
                    $file_comp = $request->zoom_image_1;
                    $extension = $file_comp->getClientOriginalExtension();
                    $timestamp = generateFilename();
                    $filename = $timestamp . '.' . $extension;
                    $file_path = imagePath();
                    $image_comp_size = getimagesize($file_comp);
                    $img = \Image::make($file_comp->getRealPath());
                    $destinationPath = public_path($file_path);
                    if($img->resize($image_comp_size[0], $image_comp_size[1], function ($constraint) {
                        $constraint->aspectRatio();
                        })->save($destinationPath.'/'.$filename,50,'jpg')){

                            $pub->zoom_image_1 = $filename;
                    }else{
                        throw new \Exception(errorMessage('file_uploading_failed'));
                    }
                // Shubham Code For Image Compression End //
            }

            if ($request->hasFile('zoom_image_2')) {
                // Shubham Code For Image Compression Start //
                    $file_comp = $request->zoom_image_2;
                    $extension = $file_comp->getClientOriginalExtension();
                    $timestamp = generateFilename();
                    $filename = $timestamp . '.' . $extension;
                    $file_path = imagePath();
                    $image_comp_size = getimagesize($file_comp);
                    $img = \Image::make($file_comp->getRealPath());
                    $destinationPath = public_path($file_path);
                    if($img->resize($image_comp_size[0], $image_comp_size[1], function ($constraint) {
                        $constraint->aspectRatio();
                        })->save($destinationPath.'/'.$filename,50,'jpg')){

                            $pub->zoom_image_2 = $filename;
                    }else{
                        throw new \Exception(errorMessage('file_uploading_failed'));
                    }
                // Shubham Code For Image Compression End //
            }
            if ($request->hasFile('zoom_image_3')) {

                // Shubham Code For Image Compression Start //
                    $file_comp = $request->zoom_image_3;
                    $extension = $file_comp->getClientOriginalExtension();
                    $timestamp = generateFilename();
                    $filename = $timestamp . '.' . $extension;
                    $file_path = imagePath();
                    $image_comp_size = getimagesize($file_comp);
                    $img = \Image::make($file_comp->getRealPath());
                    $destinationPath = public_path($file_path);
                    if($img->resize($image_comp_size[0], $image_comp_size[1], function ($constraint) {
                        $constraint->aspectRatio();
                        })->save($destinationPath.'/'.$filename,50,'jpg')){

                            $pub->zoom_image_3 = $filename;
                    }else{
                        throw new \Exception(errorMessage('file_uploading_failed'));
                    }
                // Shubham Code For Image Compression End //
            }
            if ($request->hasFile('zoom_image_4')) {
                // Shubham Code For Image Compression Start //
                    $file_comp = $request->zoom_image_4;
                    $extension = $file_comp->getClientOriginalExtension();
                    $timestamp = generateFilename();
                    $filename = $timestamp . '.' . $extension;
                    $file_path = imagePath();
                    $image_comp_size = getimagesize($file_comp);
                    $img = \Image::make($file_comp->getRealPath());
                    $destinationPath = public_path($file_path);
                    if($img->resize($image_comp_size[0], $image_comp_size[1], function ($constraint) {
                        $constraint->aspectRatio();
                        })->save($destinationPath.'/'.$filename,50,'jpg')){

                            $pub->zoom_image_4 = $filename;
                    }else{
                        throw new \Exception(errorMessage('file_uploading_failed'));
                    }
                // Shubham Code For Image Compression End //
            }

            $pub->header = $request->header;
            $pub->zoom_text_1 = $request->zoom_text_1;
            $pub->zoom_text_2 = $request->zoom_text_2;
            $pub->zoom_text_3 = $request->zoom_text_3;
            $pub->zoom_text_4 = $request->zoom_text_4;
            $pub->news_1 = $request->news_1;
            $pub->news_2 = $request->news_2;
            $pub->news_3 = $request->news_3;
            $pub->news_4 = $request->news_4;
            $pub->news_5 = $request->news_5;
            $pub->news_6 = $request->news_6;
            $pub->news_7 = $request->news_7;
            $pub->news_8 = $request->news_8;
            $pub->news_9 = $request->news_9;
            $pub->news_10 = $request->news_10;

            $pub->save();

            DB::commit();
            // Session::flash('blog_data_saved_flag', 1);
            Session::flash('news_data_saved_flag', 1);
            return response()->json([
                'status' => 1,
                'msg' => adminTransLang('request_processed_successfully'),
            ], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return errorMessage($e->getMessage(), true);
        }
    }

    public function getPubUpdate(Request $request, $id)
    {
        $event  = Pub::findOrFail($id);
        return view('admin.pub.create', compact('event'));
    }

    public function getPubView($id)
    {
        $event  = Pub::findOrFail($id);
        return view('admin.pub.view', compact('event'));
    }

    public function getPubDelete($id)
    {
        $event  = Event::findOrFail($id)->delete();
        return response()->json([
            'status' => 1,
            'msg' => adminTransLang('request_processed_successfully'),
        ], 200);
    }

}
