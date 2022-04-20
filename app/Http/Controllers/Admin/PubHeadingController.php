<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PubHeading;
use App\Models\PubMeetingRooms;
use DB;

class PubHeadingController extends Controller
{
    public function getIndex()
    {
        return view('admin.pub_heading.index');
    }

    public function getList()
    {
        $settings = PubHeading::select(['*']);
        return \DataTables::of($settings)->make();
    }

    public function getUpdate(Request $request)
    {
        $setting = PubHeading::find($request->id);
        if (!$setting) {
            return redirect()->route('admin.pub_heading.index')->with(['fail' => adminTransLang('setting_not_found')]);
        }
        return view('admin.pub_heading.update', ['setting' => $setting]);
    }

    public function postUpdate(Request $request)
    {
        $this->validate($request, [
            'heading' => 'required',
            'description' => 'required',
            'description_2' => 'required',
        ]);

        $settings = PubHeading::find($request->id);
        $settings->heading = $request->heading;
        $settings->description = $request->description;
        $settings->description_2 = $request->description_2;
        $settings->save();

        return response()->json([
            'status' => 1,
            'msg' => adminTransLang('request_processed_successfully'),
        ], 200);
    }
    
    public function getPubMeetingIndex()
    {
        return view('admin.pub_meeting.index');
    }

    public function getMeetingList(Request $request)
    {
        $settings = PubMeetingRooms::where('type',$request->type)->get();
        return \DataTables::of($settings)
        ->editColumn('status', function ($query) {
            if($query->status == 1){
                return 'Active';
            }else{
                return 'In-Active';
            }
        })
        ->make();
    }

    public function getCreateMeeting(Request $request)
    {
        $type = $request->type;
        $setting = array();
        if($type == 1){
            $setting = PubMeetingRooms::where('type',$type)->first();
        }
        // pr($setting); die;
        return view('admin.pub_meeting.update',compact('type','setting'));
    }

    public function getUpdateMeeting(Request $request)
    {
        $setting = PubMeetingRooms::find($request->id);
        if (!$setting) {
            return redirect()->route('admin.pub_heading.index')->with(['fail' => adminTransLang('setting_not_found')]);
        }
        // pr($setting->toArray()); die;
        return view('admin.pub_meeting.update', ['setting' => $setting]);
    }

    public function postSaveMeeting(Request $request)
    {
        // pr($request->all()); die;
        $arr = array(
            'heading' => 'required',
            'url' => 'required',
            'status' => 'required',
        );
        if(empty($request->is_image)){
            $arr['featured_image'] = 'required';
        }
        $request->validate($arr); 

        try {

            $settings = array(
                'heading' => $request->heading,
                'url' => $request->url,
                'type' => $request->type,
                'status' => $request->status,
                'created_at' => time(),
                'updated_at' => time()
            );

            if ($request->hasFile('featured_image')) {
                // Shubham Code For Image Compression Start //
                    $file_comp = $request->featured_image;
                    $extension = $file_comp->getClientOriginalExtension();
                    $timestamp = generateFilename();
                    $filename = $timestamp . '.' . $extension;
                    $file_path = 'uploads/images/pub/';
                    $image_comp_size = getimagesize($file_comp);
                    $img = \Image::make($file_comp->getRealPath());
                    $destinationPath = public_path($file_path);
                    if($img->resize($image_comp_size[0], $image_comp_size[1], function ($constraint) {
                        $constraint->aspectRatio();
                        })->save($destinationPath.'/'.$filename,50,'jpg')){   
                            $settings['image'] = $filename;
                    }else{
                        // Rollback Transaction
                        DB::rollBack();
                        $message = ['msg' => errorMessage('file_uploading_failed')];
                        return response()->json($message, 422);
                    }
                // Shubham Code For Image Compression End //
            }elseif(!empty($request->is_image)){
                $settings['image'] = $request->is_image;
            }
            // pr($settings); die;
            PubMeetingRooms::updateOrCreate(['id'=>$request->id],$settings); 

            return response()->json([
                'status' => 1,
                'msg' => adminTransLang('request_processed_successfully'),
            ], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return errorMessage($e->getMessage(), true);
        }
    }
    
    public function deletePubMeetingRoom(Request $request){
        PubMeetingRooms::where('id',$request->id)->delete();

        echo json_encode(['status'=>1,'msg'=>'Meeting room deleted successfully']);
    }
}
