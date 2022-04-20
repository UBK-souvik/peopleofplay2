<?php

namespace App\Http\Controllers\Front;

use App\Models\MediaList;
use App\Models\Feed;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Helpers\Utilities;
use App\Helpers\UtilitiesTwo;
use App\Helpers\UtilitiesFour;
use Session;
use File;

class MediaController extends ModuleTwoController
{
	

    public function getMediaList()
    {
        $current_user = get_current_user_info();
        $media_list = MediaList::where('user_id', $current_user->id)
        ->orderBy('id', 'desc')
        ->paginate(20);

        return view('front.user.media.index', compact('media_list'));
    }

    public function getCreateMedia(Request $request)
    {
        return view('front.user.media.create');
    }

    public function postCreateMedia(Request $request)
    {
        // echo "<pre>request - "; print_r($request->all()); die;
        $rules = [
            'media_id' => 'nullable|exists:media_lists,id',
            'title' => 'required',
            'url_data' => ['required', 
                function($attribute, $value, $fail) {            
                $chk_url_validation_check = UtilitiesTwo::get_url_validation_check($value);
                if ($chk_url_validation_check == false) {
                    return $fail('Url is invalid.');
                }
            }],
        ];

        $niceNames = [
            'title' => 'Title',
            'featured_image' => 'Featured Image',
            'url_data' => 'Url',
                    //'status' => 'required|in:0,1'
        ];
        
        if(empty($request->media_id))
        {
            // $rules['featured_image'] = 'required|file';	
        }

        $this->validate($request, $rules, [], $niceNames);

        try {
            
            // DB::beginTransaction();

            $current_user = get_current_user_info();

            $data = $request->only(MediaList::$fillable_shadow);

            $data['user_id'] = $current_user->id;

            $data['status'] = 1;

            $data = UtilitiesFour::uploadImageToDirectory($data, $request, 'featured_image', 'media'); 
                    //echo "<pre>"; print_r($data); die;           
            if(!empty($request->is_only_feed == 1)){
                $mediaMention = $request;
                $check_Post = 0;
                $mediaMention['feed_id'] = $request['media_id'];
            }else{
                $mediaMention = MediaList::updateOrCreate(['id' => $request->media_id], $data);
                $check_Post = 1;
            }

            // $mediaMention = MediaList::where('id',$request->media_id)->first();

            if((isset($mediaMention) && !empty($mediaMention))  && !empty($request->feed_check == 'on')) {
                // echo "<pre>mediaMention - "; print_r($mediaMention->all()); die;  
                
                $feedMediaData = array(
                    'user_id' => $current_user->id,
                    'type' => 4,
                    'title' =>$mediaMention['title'],
                    'url' =>$mediaMention['url_data'],
                    'caption' =>$mediaMention['caption'],
                    'time' => time(),
                    'check_post' => $check_Post
                );

                if(!empty($request->is_only_feed == 1)){
                    if(!empty($data['featured_image'])){
                        $oldPath = public_path('/uploads/images/media/'.$data['featured_image']); 
                        $extension = \File::extension($oldPath);
                        $filename = $data['featured_image'].'.'.$extension;
                        $destinationPath = public_path('uploads/images/feed/'.$filename);
                        $img = \Image::make($oldPath);                
                        if($img->save($destinationPath,50,'jpg')){
                            $feedMediaData['image'] = $filename;
                            // echo $filename; die;
                        }
                    }elseif(!empty($request->is_feed_image)){
                        $feedMediaData['image'] = $request->is_feed_image;
                    }else{
                        $feedMediaData['image'] = '';
                    }
                }else{
                    if(!empty($mediaMention['featured_image'])){
                        $oldPath = public_path('/uploads/images/media/'.$mediaMention['featured_image']); 
                        $extension = \File::extension($oldPath);
                        $filename = $mediaMention['featured_image'].'.'.$extension;
                        $destinationPath = public_path('uploads/images/feed/'.$filename);
                        $img = \Image::make($oldPath);                
                        if($img->save($destinationPath,50,'jpg')){
                            $feedMediaData['image'] = $filename;
                            // echo $filename; die;
                        }
                    }else{
                        $feedMediaData['image'] = '';
                    }
                }
                

                // echo "<pre>feedMediaData - "; print_r($feedMediaData); die;  
                $feed_update = Feed::updateOrCreate(['id' => $mediaMention['feed_id']], $feedMediaData);
                if(empty($request->is_only_feed)){
                    MediaList::where('id',$mediaMention->id)->update(['feed_id'=>$feed_update->id]);
                }
            }

        // DB::commit();
        Session::flash('media_data_saved_flag', 1);
        return successMessage('Media saved');
        } catch (\Exception $e) {
            DB::rollback();
            return errorMessage($e->getMessage(), true);
        }
    }

public function getUpdateMedia($slug)
{
    $current_user = get_current_user_info();
    $media = MediaList::where('id', $slug)
    ->where('user_id', $current_user->id)
    ->firstOrFail();
    // pr($media); die;
    return view('front.user.media.create', compact('media'));
}

public function getWithOutProfileUpdateMedia($feed_id)
{
    // echo '<pre>getWithOutProfileUpdateMedia - '; print_r($media_data); die;
    $current_user = get_current_user_info();
    $media = Feed::where('id',$feed_id)->first();
    $media->url_data = @$media->url;
    $media->featured_image = @$media->image;
    $is_only_feed = 1;
    // pr($media); die;
    return view('front.user.media.create', compact('media','is_only_feed'));
}

public function getDeleteMedia($slug)
{


   try {

    DB::beginTransaction();

    $image_data = MediaList::select('featured_image')->where('id', $slug)->first();			
    $file_path = Utilities::get_media_upload_folder_path();
    $image_path = public_path($file_path . $image_data->featured_image);

    if(file_exists($image_path)) {
        File::delete($image_path);
    }

    $current_user = get_current_user_info();

    MediaList::where('id', $slug)
    ->where('user_id', $current_user->id)
    ->firstOrFail()
    ->delete();

    Session::flash('media_data_deleted_flag', 1);

    DB::commit();

    return redirect()->route('front.user.media.index');

} catch (\Exception $e) {
    DB::rollback();
    throw $e;
    return errorMessage($e->getMessage(), true);
}

}
}
