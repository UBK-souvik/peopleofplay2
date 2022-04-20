<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\FeedAd;
use DB;

class FeedsAdController extends Controller
{
    public function getIndex()
    {
        $data['feeds_ad'] = FeedAd::get();
        return view('admin.feeds_ad.index',$data);
    }

    public function uploadAdImage(Request $request){

        // echo '<pre>_FILES - '; print_r($_FILES); //die;
        // echo '<pre>request - '; print_r($request->all()); die;

        $message = [
            'top_ad.dimensions' => 'Please Upload Image dimensions : Min Width  300px and Min Height 250px.',
            'top_ad.mimes' => 'Invalid image type: allow Only (jpeg,png,jpg,gif).',
            'top_ad.min' => 'Image upload  minimum size 2MB.',

            'middle_ad.dimensions' => 'Please Upload Image dimensions : Min Width  300px and Min Height 600px.',
            'middle_ad.mimes' => 'Invalid image type: allow Only (jpeg,png,jpg,gif).',
            'middle_ad.min' => 'Image upload  minimum size 2MB.',

            'bottom_ad.dimensions' => 'Please Upload Image dimensions : Min Width  300px and Min Height 250px.',
            'bottom_ad.mimes' => 'Invalid image type: allow Only (jpeg,png,jpg,gif).',
            'bottom_ad.min' => 'Image upload  minimum size 2MB.',

            'right_ad.dimensions' => 'Please Upload Image dimensions : Min Width  300px and Min Height 250px.',
            'right_ad.mimes' => 'Invalid image type: allow Only (jpeg,png,jpg,gif).',
            'right_ad.min' => 'Image upload  minimum size 2MB.',
        ];
        $request->validate([
            'top_ad' => 'mimes:jpeg,png,jpg,gif',
            'middle_ad' => 'mimes:jpeg,png,jpg,gif',
            'bottom_ad' => 'mimes:jpeg,png,jpg,gif',
            'right_ad' => 'mimes:jpeg,png,jpg,gif',
        ],$message);


        try {
            if (!empty($request->top_ad_image)) {
                if ($request->hasFile('top_ad')) {
                    // Shubham Code For Image Compression Start //
                        $file_comp = $request->top_ad;
                        $extension = $file_comp->getClientOriginalExtension();
                        $timestamp = generateFilename();
                        $image_comp_size = getimagesize($file_comp);
                        $filename = $timestamp . '_top_ad' . '.' . $extension;
                        $file_path = '/uploads/images/feeds_ad/';
                        $img = \Image::make($file_comp->getRealPath());
                        $destinationPath = public_path($file_path);
                        if($img->resize($image_comp_size[0], $image_comp_size[1], function ($constraint) {
                            $constraint->aspectRatio();
                            })->save($destinationPath.'/'.$filename,50,'jpg')){

                            $t_data['image'] = $filename;
                        }else{
                            throw new \Exception(errorMessage('file_uploading_failed'));
                        }
                    // Shubham Code For Image Compression End //
                }
                $t_data['type'] = 'top_ad';
                $t_data['url'] = $request->top_ad_url;
                $t_data['status'] = 1;
                $t_data['created_at'] = time();
                $t_data['updated_at'] = time();

                FeedAd::updateOrCreate(['type' => 'top_ad'], $t_data);
            }
            if (!empty($request->middle_ad_image)) {
                if ($request->hasFile('middle_ad')) {
                    // Shubham Code For Image Compression Start //
                        $file_comp = $request->middle_ad;
                        $extension = $file_comp->getClientOriginalExtension();
                        $timestamp = generateFilename();
                        $image_comp_size = getimagesize($file_comp);
                        $filename = $timestamp . '_middle_ad' . '.' . $extension;
                        $file_path = '/uploads/images/feeds_ad/';
                        $img = \Image::make($file_comp->getRealPath());
                        $destinationPath = public_path($file_path);
                        if($img->resize($image_comp_size[0], $image_comp_size[1], function ($constraint) {
                            $constraint->aspectRatio();
                            })->save($destinationPath.'/'.$filename,50,'jpg')){

                                $m_data['image'] = $filename;
                        }else{
                            throw new \Exception(errorMessage('file_uploading_failed'));
                        }
                    // Shubham Code For Image Compression End //
                }
                $m_data['type'] = 'middle_ad';
                $m_data['url'] = $request->middle_ad_url;
                $m_data['status'] = 1;
                $m_data['created_at'] = time();
                $m_data['updated_at'] = time();

                FeedAd::updateOrCreate(['type' => 'middle_ad'], $m_data);
            }
            if (!empty($request->bottom_ad_image)) {
                if ($request->hasFile('bottom_ad')) {
                    // Shubham Code For Image Compression Start //
                        $file_comp = $request->bottom_ad;
                        $extension = $file_comp->getClientOriginalExtension();
                        $timestamp = generateFilename();
                        $image_comp_size = getimagesize($file_comp);
                        $filename = $timestamp . '_bottom_ad' . '.' . $extension;
                        $file_path = '/uploads/images/feeds_ad/';
                        $img = \Image::make($file_comp->getRealPath());
                        $destinationPath = public_path($file_path);
                        if($img->resize($image_comp_size[0], $image_comp_size[1], function ($constraint) {
                            $constraint->aspectRatio();
                            })->save($destinationPath.'/'.$filename,50,'jpg')){

                                $b_data['image'] = $filename;
                        }else{
                            throw new \Exception(errorMessage('file_uploading_failed'));
                        }
                    // Shubham Code For Image Compression End //
                }
                $b_data['type'] = 'bottom_ad';
                $b_data['url'] = $request->bottom_ad_url;
                $b_data['status'] = 1;
                $b_data['created_at'] = time();
                $b_data['updated_at'] = time();

                FeedAd::updateOrCreate(['type' => 'bottom_ad'], $b_data);
            }
            if (!empty($request->right_ad_image)) {
                if ($request->hasFile('right_ad')) {
                    // Shubham Code For Image Compression Start //
                        $file_comp = $request->right_ad;
                        $extension = $file_comp->getClientOriginalExtension();
                        $timestamp = generateFilename();
                        $image_comp_size = getimagesize($file_comp);
                        $filename = $timestamp . 'right_ad' . '.' . $extension;
                        $file_path = '/uploads/images/feeds_ad/';
                        $img = \Image::make($file_comp->getRealPath());
                        $destinationPath = public_path($file_path);
                        if($img->resize($image_comp_size[0], $image_comp_size[1], function ($constraint) {
                            $constraint->aspectRatio();
                            })->save($destinationPath.'/'.$filename,50,'jpg')){

                                $r_data['image'] = $filename;
                        }else{
                            throw new \Exception(errorMessage('file_uploading_failed'));
                        }
                    // Shubham Code For Image Compression End //
                }
                $r_data['type'] = 'right_ad';
                $r_data['url'] = $request->righ_ad_url;
                $r_data['status'] = 1;
                $r_data['created_at'] = time();
                $r_data['updated_at'] = time();

                FeedAd::updateOrCreate(['type' => 'right_ad'], $r_data);
            }

            return response()->json([
                'status' => 1,
                'msg' => adminTransLang('request_processed_successfully'),
            ], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return errorMessage($e->getMessage(), true);
        }
    }

    public function deleteAdImage(Request $request){
        FeedAd::where('id',$request->id)->update(['image' =>'']);
        return response()->json([
            'status' => 1,
            'msg' => 'Image deleted successfully',
        ], 200);
    }

}
