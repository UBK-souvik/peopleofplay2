<?php

namespace App\Http\Controllers\API\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function changePassword(Request $request)
    {
        $this->validate($request, [
            'old_password' => 'required|min:6|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
            'password' => 'required|min:6|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
        ]);

        $fieldArr = ['old_password', 'password', 'locale'];
        $dataArr = arrayFromPost($request, $fieldArr);
        $tokenUser = \JWTAuth::parseToken()->authenticate();

        if (!\Hash::check($dataArr->old_password, $tokenUser->password)) {
            errorMessage('invalid_old_password');
        }
        $tokenUser->password = bcrypt($dataArr->password);
        $tokenUser->save();

        return successMessage('password_changed', 200);
    }

    public function updateLocale(Request $request)
    {
        $fieldArr = ['user_fcm_token_id', 'locale', 'fcm_id', 'device_id', 'device_type', 'sound_key', 'vibrate', 'app_sound'];
        $dataArr = arrayFromPost($request, $fieldArr);
        $tokenUser = \JWTAuth::parseToken()->authenticate();

        $this->validate($request, [
            'user_fcm_token_id' => 'nullable|exists:user_fcm_tokens,id',
            'fcm_id' => 'required',
            'device_id' => 'required',
            'device_type' => 'required|in:android,ios',
            'sound_key' => 'required',
            'vibrate' => 'required|numeric|in:1,0',
            'app_sound' => 'required|numeric|in:1,0',
        ]);

        if ($dataArr->user_fcm_token_id) {
            $userFcmToken = new \stdClass;
            $userFcmToken->user_id = $tokenUser->user_id;
            $userFcmToken->locale = $dataArr->locale;
            $userFcmToken->fcm_id = $dataArr->fcm_id;
            $userFcmToken->device_id = $dataArr->device_id;
            $userFcmToken->device_type = $dataArr->device_type;
            $userFcmToken->sound_key = $dataArr->sound_key;
            $userFcmToken->vibrate = $dataArr->vibrate;
            $userFcmToken->app_sound = $dataArr->app_sound;
            $output = updateFCMToken($userFcmToken, $dataArr->user_fcm_token_id);
        } else {
            $userFcmToken = new \stdClass;
            $userFcmToken->user_id = $tokenUser->user_id;
            $userFcmToken->locale = $dataArr->locale;
            $userFcmToken->fcm_id = $dataArr->fcm_id;
            $userFcmToken->device_id = $dataArr->device_id;
            $userFcmToken->device_type = $dataArr->device_type;
            $userFcmToken->sound_key = $dataArr->sound_key;
            $userFcmToken->vibrate = $dataArr->vibrate;
            $userFcmToken->app_sound = $dataArr->app_sound;
            $output = updateFCMToken($userFcmToken);
        }

        return successMessage('data_updated_successfully', 200, $output['data']);
    }

    public function updateProfile(Request $request)
    {
        $tokenUser = \JWTAuth::parseToken()->authenticate();

        $this->validate($request, [
            'name' => 'required',
            'dial_code' => 'required',
            'email' => "required|email|unique:users,email,{$tokenUser->id},id",
            'mobile' => "required|numeric|digits_between:9,20|unique:users,mobile,{$tokenUser->id},id",
            'gender' => 'required|in:Male,Female',
        ]);
        $fieldArr = ['name', 'email', 'dial_code', 'mobile', 'gender', 'locale'];
        $dataArr = arrayFromPost($request, $fieldArr);

        $tokenUser->name = $dataArr->name;
        $tokenUser->email = $dataArr->email;
        $tokenUser->dial_code = $dataArr->dial_code;
        $tokenUser->mobile = $dataArr->mobile;
        $tokenUser->gender = $dataArr->gender;
        $tokenUser->save();

        // Update User in MongoDB
        $mongoUser = \App\Models\MongoDB\User::where('ref_user_id', $tokenUser->id)->first();
        if($mongoUser != null) {
            $mongoUser->name = $dataArr->name;
            $mongoUser->profile_image = $dataArr->profile_image;
            $mongoUser->save();
        }

        return successMessage('account_info_updated', 200);
    }

    public function updateProfileImage(Request $request)
    {

        $fieldArr = ['locale'];
        $dataArr = arrayFromPost($request, $fieldArr);

        $this->validate($request, [
            'profile_image' => 'required|' . config('cms.allowed_image_mimes'),
        ]);
        $tokenUser = \JWTAuth::parseToken()->authenticate();

        $image = \Input::file('profile_image');
        $filename = generateFilename() . '.' . $image->getClientOriginalExtension();
        $file_path = imagePath();
        $upload_status = $image->move($file_path, $filename);
        if ($upload_status) {
            $tokenUser->profile_image = $filename;
            $tokenUser->save();

            // Update User in MongoDB
            $mongoUser = \App\Models\MongoDB\User::where('ref_user_id', $tokenUser->id)->first();
            if($mongoUser != null) {
                $mongoUser->profile_image = $filename;
                $mongoUser->save();
            }

            return successMessage('profile_image_updated', 200, [
                'profile_image' => $tokenUser->profile_image
            ]);

        } else {
            errorMessage('file_uploading_failed');
        }
    }
}
