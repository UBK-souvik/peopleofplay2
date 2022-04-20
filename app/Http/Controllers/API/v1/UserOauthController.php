<?php

namespace App\Http\Controllers\API\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserOauthController extends Controller
{
    public function signup(Request $request)
    {
        $fieldArr = ['name', 'email', 'gender', 'dial_code', 'mobile', 'password', 'locale', 'fcm_id', 'device_id', 'device_type'];
        $dataArr = arrayFromPost($request, $fieldArr);

        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'gender' => 'required|in:Male,Female',
            'dial_code' => 'required|numeric|digits_between:1,5|exists:countries,dial_code',
            'mobile' => 'required|numeric|digits_between:9,20',
            'password' => 'required|min:6|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
            'fcm_id' => 'required',
            'device_id' => 'required',
            'device_type' => 'required|in:android,ios',
        ]);

        // Check Mobile No Duplicate
        if(\App\Models\User::where('dial_code', $dataArr->dial_code)->where('mobile', $dataArr->mobile)->count()) {
            errorMessage('mobile_already_taken');
        }

        $user = new \App\Models\User([
            'name' => $dataArr->name,
            'email' => $dataArr->email,
            'dial_code' => $dataArr->dial_code,
            'mobile' => $dataArr->mobile,
            'gender' => $dataArr->gender,
            'password' => bcrypt($dataArr->password),
        ]);

        if ($user->save()) {
            $userFcmToken = new \stdClass;
            $userFcmToken->user_id = $user->id;
            $userFcmToken->locale = $dataArr->locale;
            $userFcmToken->fcm_id = $dataArr->fcm_id;
            $userFcmToken->device_id = $dataArr->device_id;
            $userFcmToken->device_type = $dataArr->device_type;
            $userFcmToken->sound_key = 'default';
            $userFcmToken->vibrate = '1';
            $userFcmToken->app_sound = '1';
            updateFCMToken($userFcmToken);

            // Trying to send OTP to user
            sendOtpToUser($user->id);

            return successMessage('otp_generated', 200, [
                'id' => $user->id,
                'dial_code' => $dataArr->dial_code,
                'mobile' => $dataArr->mobile,
            ]);

        } else {
            errorMessage('signup_failed');
        }
    }

    public function resendOTP(Request $request)
    {
        $fieldArr = ['user_id', 'locale'];
        $dataArr = arrayFromPost($request, $fieldArr);

        $this->validate($request, [
            'user_id' => 'required|exists:users,id',
        ]);

        // Trying to send OTP to user
        sendOtpToUser($dataArr->user_id);
        return successMessage('otp_resend_successfully', 200);
    }

    public function verifySignUpOtp(Request $request)
    {
        $fieldArr = ['user_id', 'device_id', 'otp', 'locale'];
        $dataArr = arrayFromPost($request, $fieldArr);

        $this->validate($request, [
            'user_id' => 'required|exists:users,id',
            'device_id' => 'required',
            'otp' => 'required|numeric|digits:4',
        ]);

        $user = \App\Models\User::find($dataArr->user_id);
        if ($user->otp != $dataArr->otp) {
            errorMessage('invalid_otp');
        }

        $credentials = ['email' => $user->email];
        try {
            if (!$token = \JWTAuth::fromUser($user)) {
                errorMessage('email_password_not_exist');
            }
        } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
            errorMessage('could_not_create_token');
        }

        $user->otp = null;
        $user->otp_generated_at = null;
        $user->is_mobile_verified = 1;
        $user->save();

        $output = processUserResponseData($user->id, $dataArr->device_id);

        return successMessage('otp_verified_logged_in', 200, [
            'token' => ($token),
            'data' => $output
        ]);
    }

    public function signin(Request $request)
    {
        $fieldArr = ['email', 'password', 'fcm_id', 'device_id', 'device_type', 'locale'];
        $dataArr = arrayFromPost($request, $fieldArr);

        $this->validate($request, [
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:6',
            'fcm_id' => 'required',
            'device_id' => 'required',
            'device_type' => 'required|in:android,ios',
        ]);

        $credentials = $request->only(['email', 'password']);
        try {
            if (!$token = \JWTAuth::attempt($credentials)) {
                errorMessage('email_password_not_exist');
            }
        } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
            errorMessage('could_not_create_token');
        }

        $tokenUser = \JWTAuth::toUser($token);

        if ($tokenUser->status != 1) {
            \JWTAuth::invalidate($token);

            if ($tokenUser->status == 0) {
                errorMessage('account_inactive');

            } else {
                errorMessage('account_blocked');
            }

            errorMessage('email_password_not_exist');
        } elseif ($tokenUser->is_mobile_verified != 1) {
            \JWTAuth::invalidate($token);
            
            // Trying to send OTP to user
            sendOtpToUser($tokenUser->id);

            return successMessage('mobile_not_verified', 200, ['data' => [
                'id' => $tokenUser->id,
                'mobile' => $tokenUser->mobile,
                'dial_code' => $tokenUser->dial_code,
                'is_mobile_verified' => 0,
            ]]);
        }

        /* Save FCM Data */
        $userFcmToken = new \stdClass;
        $userFcmToken->user_id = $tokenUser->id;
        $userFcmToken->locale = $dataArr->locale;
        $userFcmToken->fcm_id = $dataArr->fcm_id;
        $userFcmToken->device_id = $dataArr->device_id;
        $userFcmToken->device_type = $dataArr->device_type;
        $userFcmToken->sound_key = 'default';
        $userFcmToken->vibrate = '1';
        $userFcmToken->app_sound = '1';
        updateFCMToken($userFcmToken);

        $output = processUserResponseData(false, $dataArr->device_id, $tokenUser);

        return successMessage('logged_in_successfully', 200, [
            'token' => ($token),
            'data' => $output
        ]);
    }

    public function signout(Request $request)
    {
        $this->validate($request, [
            'device_id' => 'required'
        ]);

        $fieldArr = ['device_id', 'locale'];
        $dataArr = arrayFromPost($request, $fieldArr);

        \JWTAuth::invalidate(\JWTAuth::getToken());
        deleteFCMToken($dataArr->device_id);

        return successMessage('logged_out_successfully', 200);
    }

    public function forgotPassword(Request $request)
    {
        $fieldArr = ['dial_code', 'mobile', 'locale'];
        $dataArr = arrayFromPost($request, $fieldArr);

        $this->validate($request, [
            'dial_code' => 'required|numeric|digits_between:1,5|exists:countries,dial_code',
            'mobile' => 'required|numeric|digits_between:9,20',
        ]);

        $user = \App\Models\User::where('dial_code', $dataArr->dial_code)->where('mobile', $dataArr->mobile)->first();

        // Check Mobile No Duplicate
        if ($user == null) {
            errorMessage('mobile_not_exist');
        } elseif ($user->status != 1) {
            if ($user->status == 0) {
                errorMessage('account_inactive');
            } else {
                errorMessage('account_blocked');
            }

            errorMessage('email_password_not_exist');
        }

        // Trying to send OTP to user
        sendOtpToUser($user->id);

        return successMessage('otp_generated', 200, [
            'id' => $user->id,
        ]);
    }

    public function verifyForgotPasswordOtp(Request $request)
    {
        $fieldArr = ['user_id', 'otp', 'locale'];
        $dataArr = arrayFromPost($request, $fieldArr);

        $this->validate($request, [
            'user_id' => 'required|exists:users,id',
            'otp' => 'required|numeric|digits:4',
        ]);

        $user = \App\Models\User::find($dataArr->user_id);
        if ($user->otp != $dataArr->otp) {
            errorMessage('invalid_otp');
        }

        return successMessage('otp_verified_successfully', 200);
    }

    public function verifyOtpUpdatePassword(Request $request)
    {
        $fieldArr = ['user_id', 'otp', 'password', 'locale'];
        $dataArr = arrayFromPost($request, $fieldArr);

        $this->validate($request, [
            'user_id' => 'required|exists:users,id',
            'otp' => 'required|numeric|digits:4',
            'password' => 'required|min:6|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
        ]);

        $user = \App\Models\User::find($dataArr->user_id);
        if ($user->otp != $dataArr->otp) {
            errorMessage('invalid_otp');
        }
        $user->password = bcrypt($dataArr->password);
        $user->otp = null;
        $user->otp_generated_at = null;
        $user->save();

        return successMessage('password_changed', 200);
    }

    public function changePhoneNo(Request $request)
    {
        $this->validate($request, [
            'user_id' => 'required|numeric|exists:users,id',
            'dial_code' => 'required|numeric|digits_between:1,5|exists:countries,dial_code',
            'mobile' => 'required|numeric|digits_between:9,20',
        ]);

        $fieldArr = ['user_id', 'dial_code', 'mobile', 'locale'];
        $dataArr = arrayFromPost($request, $fieldArr);

        $user = \App\Models\User::find($dataArr->user_id);
        if ($user == null) {
            errorMessage('user_not_found');
        } elseif ($user->otp == null) {
            errorMessage('invalid_request');
        } elseif ($user->mobile == $dataArr->mobile && $user->dial_code == $dataArr->mobile) {
            return successMessage('otp_generated', 200, [
                'id' => $user->id,
                'otp' => $user->otp
            ]);
        }

        $user->dial_code = $dataArr->dial_code;
        $user->mobile = $dataArr->mobile;
        $user->save();

        // Trying to send OTP to user
        sendOtpToUser($user->id);

        return successMessage('otp_generated', 200, [
            'id' => $user->id
        ]);
    }

    public function refreshJwtToken(Request $request)
    {
        // Refresh JWT Token
        $refreshToken = \JWTAuth::parseToken()->refresh();

        return successMessage('success', 200, ['token' => ($refreshToken)]);
    }

    public function registerGuestUser(Request $request)
    {
        $fieldArr = ['locale', 'fcm_id', 'device_id', 'device_type', 'sound_key', 'vibrate', 'app_sound'];
        $dataArr = arrayFromPost($request, $fieldArr);
        $tokenUser = \JWTAuth::parseToken()->authenticate();

        $this->validate($request, [
            'fcm_id' => 'required',
            'device_id' => 'required',
            'device_type' => 'required|in:android,ios',
            'sound_key' => 'required',
            'vibrate' => 'required|numeric|in:1,0',
            'app_sound' => 'required|numeric|in:1,0',
        ]);

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

        return successMessage('data_updated_successfully', 200, $output['data']);
    }
}