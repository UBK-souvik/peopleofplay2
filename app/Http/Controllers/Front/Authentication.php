<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class Authentication extends Controller
{
    public function getLogin()
    {
        return view('front.auth.login');
    }

    public function postLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|exists:users,email',
            'password' => 'required|min:6',
        ]);

        try {
            $checkAuthentication = Auth::guard('users')->attempt($request->only(['email', 'password']));
            if (!$checkAuthentication) {
                return errorMessage('Invalid credential', true);
            }
            return successMessage('Login successfully');
        } catch (\Exception $e) {
            return errorMessage($e->getMessage(), true);
        }
        return view('front.auth.login');
    }
}
