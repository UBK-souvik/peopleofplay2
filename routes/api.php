<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'v1', 'namespace' => 'API\v1', 'middleware' => 'detect.api.locale'], function() {
    
    /* Start SingIn/SingUp Logic */
        Route::post('/register', [
            'uses' => 'UserOauthController@signup'
        ]);

        Route::post('/otp/resend', [
            'uses' => 'UserOauthController@resendOTP'
        ]);

        Route::post('/signup/otp/verify', [
            'uses' => 'UserOauthController@verifySignUpOtp'
        ]);

        Route::post('/guest/register/token', [
            'uses' => 'UserOauthController@registerGuestUser'
        ]);

        Route::post('/login', [
            'uses' => 'UserOauthController@signin'
        ]);

        Route::post('/logout', [
            'uses' => 'UserOauthController@signout'
        ]);

        Route::post('/forgot/password', [
            'uses' => 'UserOauthController@forgotPassword'
        ]);

        Route::post('/forgot/otp/verfy', [
            'uses' => 'UserOauthController@verifyForgotPasswordOtp'
        ]);

        Route::post('/forgot/password/reset', [
            'uses' => 'UserOauthController@verifyOtpUpdatePassword'
        ]);

        Route::get('/user/token/refresh', [
            'uses' => 'UserOauthController@refreshJwtToken'
        ]);
    /* End SingIn/SingUp Logic */


    /* Start Country Routes */
        Route::get('/countries/list', [
            'uses' => 'CountryController@getList'
        ]);
    /* End Country Routes */


    /* Start Update Phone # Route */
        Route::patch('/user/update/mobile', [
            'uses' => 'UserOauthController@changePhoneNo'
        ]);
    /* End Update Phone # Route */
});

Route::group(['prefix' => 'v1', 'namespace' => 'API\v1', 'middleware' => ['detect.api.locale']], function() {
    
    /* Start User Profile Routes */
        Route::post('/user/change_password', [
            'uses' => 'UserController@changePassword'
        ]);
        Route::post('/user/update/device/locale', [
            'uses' => 'UserController@updateLocale'
        ]);
        Route::patch('/user/profile/update', [
            'uses' => 'UserController@updateProfile'
        ]);
        Route::post('/user/profile_image/update', [
            'uses' => 'UserController@updateProfileImage'
        ]);
    /* End User Profile Routes */    
});