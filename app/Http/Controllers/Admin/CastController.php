<?php

namespace App\Http\Controllers\Admin;

use App\Models\EntertainmentCategory;
use App\Models\Entertainment;
use App\Models\Feed;
use App\Models\NewsFeeds;
use App\Models\FeedsCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use File;

class CastController extends Controller
{
    public function getIndex()
    {
        return view('admin.cast.index');
    }

    public function getList()
    {
        $data = Entertainment::where('type','cast')->orderBy('id','DESC')->get();
        // echo "<pre>"; print_r($data); die;
        return \DataTables::of($data)
            ->editColumn('featured_image', function ($query) {
                return @imageBasePath($query->featured_image);
            })

            ->editColumn('category_id', function ($query) {
                return  EntertainmentCategory::getName($query->category_id);
            })

            ->editColumn('status', function ($query) {
                return config('cms.action_status')[$query->status];
            })
            ->make();
    }

    public function getCreate()
    {
        $categories = EntertainmentCategory::where(['status'=>1,'type'=>'cast'])->get();
        $feeds_categories = FeedsCategory::get();
        return view('admin.cast.create',compact('categories','feeds_categories'));
    }

    public function postCreate(Request $request)
    {
        // echo '<pre>'; print_r($request->all()); die;
        $message = [
                  'featured_image.dimensions' => 'Please Upload Image dimensions : Min Width  400px and Min Height 500px.',
                   'featured_image.mimes' => 'Invalid image type: allow Only (jpeg,png,jpg,gif).',
                   'featured_image.min' => 'Image upload  minimum size 2MB.',
                   'category_id.required' => 'The category field is required.',
                  ];
       

        if($request->image == 1) {
             $request->validate([
            'title' => 'required',
            'news_feeds_category' => 'required',
            'category_id' => 'required',
            'url' => ['required','regex:/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i'],
            'featured_image' => 'mimes:jpeg,png,jpg,gif',
            // 'description' => 'required',
            'status' => 'required|in:0,1'
        ],$message);
        } else {
             $request->validate([
            'title' => 'required',
            'news_feeds_category' => 'required',
            'category_id' => 'required',
            'url' => ['required','regex:/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i'],
            'featured_image' => 'required|mimes:jpeg,png,jpg,gif',
            // 'description' => 'required',
            'status' => 'required|in:0,1'
        ],$message);
        }

        try {
            // DB::beginTransaction();
            
            $data = $request->only(Entertainment::$fillable_shadow);
             if ($request->hasFile('featured_image')) {

                // Shubham Code For Image Compression Start //
                    $file_comp = $request->featured_image;
                    $extension = $file_comp->getClientOriginalExtension();
                    $timestamp = generateFilename();
                    $image_comp_size = getimagesize($file_comp);
                    $filename = $timestamp . '_entertainment_' . '.' . $extension;
                    $file_path = '/uploads/images/entertainment';
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
            
            $search_type = Entertainment::updateOrCreate(['id' => $request->id], $data);

            if(!empty($request->feed_check == 'on')){
                $user_id = DB::table('users')->where(['email'=>'info@peopleofplay.com','is_front_admin_user'=>1])->first();
                $feed_data = array(
                    'user_id' => $user_id->id,
                    'type' => 4,
                    'title' => ucfirst($search_type->title),
                    'caption' => ucfirst($search_type->entertainmentCategory->name),
                    'url' => trim($search_type->url),
                    'check_post' => 5, // 5 -> Cast
                    'time' => time(),
                );

                // echo '<pre>search_type - '; print_r($search_type); die;
                if ($request->hasFile('featured_image')) {
                    // echo 'here'; die;
                    $oldPath = public_path('/uploads/images/entertainment/'.$search_type->featured_image); 
                    $fileExtension = \File::extension($oldPath);
                    $timestamp = generateFilename();
                    $filename = $timestamp . '.' . $fileExtension;
                    $newPathWithName =public_path('/uploads/images/feed/'.$filename);
                    if (\File::copy($oldPath , $newPathWithName)) {
                            // dd("success");
                    }
                    $feed_data['image'] = $filename;
                }else{
                    $oldPath = public_path('/uploads/images/entertainment/'.$search_type->featured_image); 
                    $fileExtension = \File::extension($oldPath);
                    $timestamp = generateFilename();
                    $filename = $search_type->featured_image;
                    $newPathWithName =public_path('/uploads/images/feed/'.$filename);
                    if (\File::copy($oldPath , $newPathWithName)) {
                            // dd("success");
                    }
                    $feed_data['image'] = $filename;
                }
                // pr($feed_data); die;
                $feedInsert = Feed::updateOrCreate(['id' => $search_type->is_feed_id],$feed_data);
                Entertainment::where(['id'=>$request->id])->update(['is_feed_id'=>$feedInsert->id]);
            }
            if(!empty($request->news_feed_check == 'on')){
                $user_id = DB::table('users')->where(['email'=>'info@peopleofplay.com','is_front_admin_user'=>1])->first();
                $feed_data = array(
                    'user_id' => $user_id->id,
                    'type' => 4,
                    'title' => ucfirst($search_type->title),
                    'caption' => ucfirst($search_type->entertainmentCategory->name),
                    'url' => trim($search_type->url),
                    'check_post' => 5, // 5 -> Cast
                    'time' => time(),
                );

                // echo '<pre>search_type - '; print_r($search_type); die;
                if ($request->hasFile('featured_image')) {
                    // echo 'here'; die;
                    $oldPath = public_path('/uploads/images/entertainment/'.$search_type->featured_image); 
                    $fileExtension = \File::extension($oldPath);
                    $timestamp = generateFilename();
                    $filename = $timestamp . '.' . $fileExtension;
                    $newPathWithName =public_path('/uploads/images/feed/'.$filename);
                    if (\File::copy($oldPath , $newPathWithName)) {
                            // dd("success");
                    }
                    $feed_data['image'] = $filename;
                }else{
                    $oldPath = public_path('/uploads/images/entertainment/'.$search_type->featured_image); 
                    $fileExtension = \File::extension($oldPath);
                    $timestamp = generateFilename();
                    $filename = $search_type->featured_image;
                    $newPathWithName =public_path('/uploads/images/feed/'.$filename);
                    if (\File::copy($oldPath , $newPathWithName)) {
                            // dd("success");
                    }
                    $feed_data['image'] = $filename;
                }
                // pr($feed_data); die;
                $feed_data['category_id'] = $request->news_feeds_category;
                $newsFeedInsert = NewsFeeds::updateOrCreate(['id' => $search_type->is_news_feed_id],$feed_data);
                Entertainment::where(['id'=>$request->id])->update(['is_news_feed_id'=>$newsFeedInsert->id]);
            }

            // DB::commit();
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
        $categories = EntertainmentCategory::where(['status'=>1,'type'=>'cast'])->get();
        $feeds_categories = FeedsCategory::get();
        $data  = Entertainment::findOrFail($id);
        return view('admin.cast.create', compact('data','categories','feeds_categories'));
    }

    public function getDelete($id)
    {
        $get_feeds_data = Entertainment::where('id',$id)->first();
        $news_category  = Entertainment::findOrFail($id)->delete();
        Feed::where('id',$get_feeds_data->is_feed_id)->delete();
        NewsFeeds::where('id',$get_feeds_data->is_news_feed_id)->delete();
        return response()->json([
            'status' => 1,
            'msg' => adminTransLang('request_processed_successfully'),
        ], 200);
    }

  public function getView($id)
    {
        $data  = Entertainment::leftJoin('entertainment_categories', 'entertainment_categories.id', '=', 'entertainments.category_id')->where('entertainments.id',$id)->select('entertainments.*','entertainment_categories.name')->first();
        return view('admin.cast.view', compact('data'));
    }
}
