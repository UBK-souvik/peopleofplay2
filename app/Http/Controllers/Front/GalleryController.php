<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\GalleryAwardTag;
use App\Models\GalleryOtherTag;
use App\Models\GalleryPersonTag;
use App\Models\GalleryProductTag;

class GalleryController extends Controller
{
    public function getIndex()
    {
        return view('front.user.gallery.index');
    }

    public function postCreate(Request $request)
    {
        $request->validate([
            'type' => 'required|in:1,2,3',
            'media' => 'required|file|' . config('cms.allowed_image_mimes'),
            'title' => 'required',
            'caption' => 'required',
            'url' => 'required',
            'person' => 'required|array',
            'person.*' => 'required',
            'product' => 'required|array',
            'product.*' => 'required',
            'award' => 'required|array',
            'award.*' => 'required',
            'company' => 'required|array',
            'company.*' => 'required',
            'other' => 'required|array',
            'other.*' => 'required|array',
        ]);
        try {

            $current_user  = get_current_user_info();

            DB::beginTransaction();
            $gallery = new Gallery();
            $gallery->type = $request->type;
            $gallery->user_id = $current_user->user_id;
            $gallery->title = $request->title;
            $gallery->caption = $request->caption;
            $gallery->url = $request->url;
            if ($request->hasFile('media')) {
                $file = $request->media;
                $extension = $file->getClientOriginalExtension();
                $timestamp = generateFilename();
                $filename = $timestamp . '.' . $extension;
                $file_path = imagePath();
                $upload_status = $file->move($file_path, $filename);
                if ($upload_status) {
                    $gallery->media = $filename;
                } else {
                    throw new \Exception(errorMessage('file_uploading_failed'));
                }
            }
            $gallery->save();

            foreach ($request->person as $person) {
                $person_tag = new GalleryPersonTag();
                $person_tag->user_id = $person;
                $person_tag->gallery = $gallery->id;
                $person_tag->save();
            }

            foreach ($request->product as $product) {
                $product_tag = new GalleryProductTag();
                $product_tag->product_id = $product;
                $product_tag->gallery = $gallery->id;
                $product_tag->save();
            }


            foreach ($request->award as $award) {
                $product_tag = new GalleryAwardTag();
                $product_tag->award_id = $award;
                $product_tag->gallery = $gallery->id;
                $product_tag->save();
            }

            foreach ($request->other as $other) {
                $product_tag = new GalleryOtherTag();
                $product_tag->tag = $other;
                $product_tag->gallery = $gallery->id;
                $product_tag->save();
            }

            DB::commit();
            return successMessage('Gallery added');
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
            return errorMessage($e->getMessage(), true);
        }
    }

    public function getDelete($id)
    {
        try {
            DB::beginTransaction();
            $current_user  = get_current_user_info();
            $gallery = Gallery::where('user_id', $current_user->id)
                ->where('id', $id)
                ->firstOrFail();
            GalleryPersonTag::where('gallery_id', $gallery->id)->delete();
            GalleryProductTag::where('gallery_id', $gallery->id)->delete();
            GalleryAwardTag::where('gallery_id', $gallery->id)->delete();
            GalleryOtherTag::where('gallery_id', $gallery->id)->delete();
            $gallery->delete();
            DB::commit();
            return successMessage('Gallery deleted');
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
            return errorMessage($e->getMessage(), true);
        }
    }
}
