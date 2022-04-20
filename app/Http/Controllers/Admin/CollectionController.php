<?php

namespace App\Http\Controllers\Admin;

use App\Models\Collection;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Session;
use App\Helpers\Utilities;
use App\Helpers\UtilitiesTwo;

class CollectionController extends Controller
{
	
	 public function __construct()
    {
		$this->_collectionsPhotosFolder = Utilities::get_collections_upload_folder_path();        
	}
	
    public function getIndex()
    {
        return view('admin.collection.index');
    }

    public function getList()
    {
        $collection = \App\Models\Collection::select('*');
        return \DataTables::of($collection)
            ->editColumn('status', function ($query) {
                return config('cms.blog_status')[$query->status];
            })
            ->editColumn('featured_image', function ($query) {
                return @collectionImageBasePath($query->featured_image);
            })
            ->make();
    }

    public function getCreate()
    {
        return view('admin.collection.create');
    }

    public function postCreate(Request $request)
    {
		$str_tag = '';

        $request->validate([
            'title' => 'required',
            'featured_image' => 'required_without:collection_id|file',
            'status' => 'required|in:0,1'
        ]);

        
        try {
            DB::beginTransaction();

            $data = $request->only(Collection::$fillable_shadow);
			
        // pr($data,1);
            if ($request->hasFile('featured_image')) {
				// Shubham Code For Image Compression Start //
                    $file_comp = $request->featured_image;
                    $extension = $file_comp->getClientOriginalExtension();
                    $timestamp = generateFilename();
                    $image_comp_size = getimagesize($file_comp);
                    $filename = $timestamp . '_collections_' . '.' . $extension;
                    $file_path = $this->_collectionsPhotosFolder;
                    $img = \Image::make($file_comp->getRealPath());
                    $destinationPath = public_path($file_path);
                    if($img->resize($image_comp_size[0], $image_comp_size[1], function ($constraint) {
                        $constraint->aspectRatio();
                        })->save($destinationPath.'/'.$filename,50,'jpg')){

                            $data['featured_image'] = $filename;
                    }else{
                         // Rollback Transaction
                        DB::rollBack();

                        $message = ['msg' => errorMessage('file_uploading_failed')];
                        return response()->json($message, 422);
                    }
                // Shubham Code For Image Compression End //
            }

            Collection::updateOrCreate(['id' => $request->collection_id], $data);

            DB::commit();
			Session::flash('collection_data_saved_flag', 1);
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
        $collection  = Collection::findOrFail($id);
        return view('admin.collection.create', compact('collection'));
    }

    public function getDelete($id)
    {
        $collection  = Collection::findOrFail($id)->delete();
        return response()->json([
            'status' => 1,
            'msg' => adminTransLang('request_processed_successfully'),
        ], 200);
    }

}
