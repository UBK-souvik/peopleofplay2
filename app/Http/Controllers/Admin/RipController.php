<?php

namespace App\Http\Controllers\Admin;

use App\Models\RipCategory;
use App\Models\Rip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class RipController extends Controller
{
    public function getIndex()
    {
        return view('admin.rip.index');
    }

    public function getList()
    {
        $data = Rip::all();
        return \DataTables::of($data)
            ->editColumn('featured_image', function ($query) {
                return @imageBasePath($query->featured_image);
            })

             ->editColumn('category_id', function ($query) {
                return RipCategory::getName($query->category_id);
            })


            ->editColumn('status', function ($query) {
                return config('cms.action_status')[$query->status];
            })
            ->make();
    }

    public function getCreate()
    {
        $categories = RipCategory::where('status',1)->get();
        return view('admin.rip.create',compact('categories'));
    }

    public function postCreate(Request $request)
    {
        $message = [
                  'featured_image.dimensions' => 'Please Upload Image dimensions : Min Width  400px and Min Height 500px.',
                   'featured_image.mimes' => 'Invalid image type: allow Only (jpeg,png,jpg,gif).',
                   'featured_image.min' => 'Image upload  minimum size 2MB.',
                   'category_id.required' => 'The category field is required.',
                  ];
       

        if($request->image == 1) {
             $request->validate([
            'title' => 'required',
            'category_id' => 'required',
            'url' => ['required','regex:/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i'],
            'featured_image' => 'mimes:jpeg,png,jpg,gif',
            // 'description' => 'required',
            'status' => 'required|in:0,1'
        ],$message);
        } else {
             $request->validate([
            'title' => 'required',
            'category_id' => 'required',
            'url' => ['required','regex:/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i'],
            'featured_image' => 'required|mimes:jpeg,png,jpg,gif',
            // 'description' => 'required',
            'status' => 'required|in:0,1'
        ],$message);
        }

        try {



            DB::beginTransaction();

            $data = $request->only(Rip::$fillable_shadow);
             if ($request->hasFile('featured_image')) {
                // Shubham Code For Image Compression Start //
                    $file_comp = $request->featured_image;
                    $extension = $file_comp->getClientOriginalExtension();
                    $timestamp = generateFilename();
                    $filename = $timestamp . '_rip_'.'.' . $extension;
                    $file_path = '/uploads/images/rip';
                    $image_comp_size = getimagesize($file_comp);
                    $img = \Image::make($file_comp->getRealPath());
                    $destinationPath = public_path($file_path);
                    if($img->resize($image_comp_size[0], $image_comp_size[1], function ($constraint) {
                        $constraint->aspectRatio();
                        })->save($destinationPath.'/'.$filename,50,'jpg')){

                            $data['featured_image'] = $filename;
                    } else {
                        throw new \Exception(errorMessage('file_uploading_failed'));
                    }
                // Shubham Code For Image Compression End //
            }
            // $data['featured_image'] = 

            Rip::updateOrCreate(['id' => $request->id], $data);

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
         $categories = RipCategory::where('status',1)->get();
        $data  = Rip::findOrFail($id);
        return view('admin.rip.create', compact('data','categories'));
    }

    public function getDelete($id)
    {
        $news_category  = Rip::findOrFail($id)->delete();
        return response()->json([
            'status' => 1,
            'msg' => adminTransLang('request_processed_successfully'),
        ], 200);
    }

        public function getView($id)
    {
        $data  = Rip::leftJoin('rip_categories', 'rip_categories.id', '=', 'rips.id')->where('rips.id',$id)->select('rips.*','rip_categories.name')->first();
        return view('admin.rip.view', compact('data'));
    }
}
