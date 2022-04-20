<?php

namespace App\Http\Controllers\Admin;
use App\Models\OfficeHour;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class OfficeHourController extends Controller
{
    public function getIndex()
    {
        return view('admin.office-hour.index');
    }

    public function getList()
    {
        $data = OfficeHour::all();
        return \DataTables::of($data)
            ->editColumn('featured_image', function ($query) {
                return @imageBasePath($query->featured_image);
            })

            ->editColumn('status', function ($query) {
                return config('cms.action_status')[$query->status];
            })
            ->make();
    }

    public function getCreate()
    {
        return view('admin.office-hour.create');
    }

    public function postCreate(Request $request)
    {
        $message = [
                  
                   'meeting_url.email' => 'Enter valid email in meeting.',
                  ];
       

        
         
             $request->validate([
            'featured_image_url' => ['required','regex:/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i'],
             'status' => 'required|in:0,1',
             // 'website_url' => ,
        ],$message);

        if($request->image == 1) {
            $request->validate([ 
                'featured_image' => 'mimes:jpeg,png,jpg,gif',
            ]);
        } else {
             $request->validate([ 
                'featured_image' => 'required|mimes:jpeg,png,jpg,gif',
            ]);
        }

        if($request->type == 1) {
             
            $request->validate([ 
                'meeting_url' => 'required|email',
            ]);
        }elseif($request->type == 2) {
             $request->validate([ 
                 'meeting_url' => ['required','regex:/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i'],
            ]);
        }
        if(!empty($request->meeting_url)) {
            $request->validate([ 
                'type' => ['required'],
            ]);
        }
        try {
            DB::beginTransaction();
            $data = $request->only(OfficeHour::$fillable_shadow);
             if ($request->hasFile('featured_image')) {
                // Shubham Code For Image Compression Start //
                    $file_comp = $request->featured_image;
                    $extension = $file_comp->getClientOriginalExtension();
                    $timestamp = generateFilename();
                    $filename = $timestamp . '_office_'.'.' . $extension;
                    $file_path = '/uploads/images/office_hour';
                    $image_comp_size = getimagesize($file_comp);
                    $img = \Image::make($file_comp->getRealPath());
                    $destinationPath = public_path($file_path);
                    if($img->resize($image_comp_size[0], $image_comp_size[1], function ($constraint) {
                        $constraint->aspectRatio();
                        })->save($destinationPath.'/'.$filename,50,'jpg')){

                            $data['featured_image'] = $filename;
                    }else{
                        throw new \Exception(errorMessage('file_uploading_failed'));
                    }
                // Shubham Code For Image Compression End //
            }
            // $data['featured_image'] = 

            OfficeHour::updateOrCreate(['id' => $request->id], $data);

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

    public function getUpdate($id)
    {
        $data  = OfficeHour::findOrFail($id);
        return view('admin.office-hour.create', compact('data'));
    }

    public function getDelete($id)
    {
        $news_category  = OfficeHour::findOrFail($id)->delete();
        return response()->json([
            'status' => 1,
            'msg' => adminTransLang('request_processed_successfully'),
        ], 200);
    }

    public function getView($id)
    {
        $data  = OfficeHour::find($id);
        return view('admin.office-hour.view', compact('data'));
    }
  
}
