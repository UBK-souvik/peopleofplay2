<?php

namespace App\Http\Controllers\Front;

use App\Models\AwardUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Helpers\Utilities;
use App\Helpers\UtilitiesTwo;
use App\Helpers\UtilitiesFour;
use Session;
use File;

class AwardUserController extends ModuleTwoController
{
	

    public function getAwardList()
    {
        $current_user = get_current_user_info();
        $award_list = AwardUser::where('user_id', $current_user->id)
        ->orderBy('id', 'desc')
        ->paginate(20);

        return view('front.user.award.index', compact('award_list'));
    }

    public function getCreateAward(Request $request)
    {
        return view('front.user.award.create');
    }

    public function postCreateAward(Request $request)
    {
       $rules = [
        'award_id' => 'nullable|exists:award_users,id',
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
    $rules['featured_image'] = 'required|file';	
}

$this->validate($request, $rules, [], $niceNames);

try {

    DB::beginTransaction();

    $current_user = get_current_user_info();
    $data = $request->only(AwardUser::$fillable_shadow);
    $data['user_id'] = $current_user->id;
    $data['status'] = 1;
    $data = UtilitiesFour::uploadImageToDirectory($data, $request, 'featured_image', 'awarduser'); 
    AwardUser::updateOrCreate(['id' => $request->media_id], $data);
  DB::commit();
  Session::flash('award_data_saved_flag', 1);
  return successMessage('Media saved');
} catch (\Exception $e) {
    DB::rollback();
    return errorMessage($e->getMessage(), true);
}
}

public function getUpdateAward($slug)
{
    $current_user = get_current_user_info();
    $media = AwardUser::where('id', $slug)
    ->where('user_id', $current_user->id)
    ->firstOrFail();
    return view('front.user.award.create', compact('media'));
}

public function getDeleteAward($slug)
{


   try {

    DB::beginTransaction();

    $image_data = AwardUser::select('featured_image')->where('id', $slug)->first();			
    $file_path = Utilities::get_awardUser_upload_folder_path();
    $image_path = public_path($file_path . $image_data->featured_image);

    if(file_exists($image_path)) {
        File::delete($image_path);
    }

    $current_user = get_current_user_info();

    AwardUser::where('id', $slug)
    ->where('user_id', $current_user->id)
    ->firstOrFail()
    ->delete();

    Session::flash('award_data_deleted_flag', 1);

    DB::commit();

    return redirect()->route('front.user.award.index');

} catch (\Exception $e) {
    DB::rollback();
    throw $e;
    return errorMessage($e->getMessage(), true);
}

}
}
