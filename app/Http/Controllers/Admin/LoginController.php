<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Plan;
use App\Helpers\Utilities;
use DB;
use Auth;
//Class needed for login and Logout logic
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Support\Facades\Response;

class LoginController extends Controller
{
    //Trait
    use AuthenticatesUsers;

    // Custom guard for admin
    protected function guard()
    {
        return \Auth::guard('admin');
    }

    /**
     * Rendered a login of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getLogin()
    {
        return view('admin.login');
    }

    /**
     * Validate the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postLogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|exists:admins,email',
            'password' => 'required|min:6'
        ]);

        $remember = $request->remember == "on" ? true : false;
        $credentials = $request->only('email', 'password');

        if (!\Auth::guard('admin')->attempt($credentials, $remember)) {
            $message = adminTransLang('username_password_not_exist');
            return response()->json($message, 422);

        } else {
            $user = \Auth::guard('admin')->user();
            if ($user->status != 1) {
                $message = $user->status == 0 ? adminTransLang('account_inactive') : adminTransLang('account_blocked');

                \Auth::guard('admin')->logout();
                return response()->json(['msg' => $message], 422);
            }
            userMenuList();
            return response()->json([
                'msg' => adminTransLang('logged_in_successfully')
            ], 200);
        }
    }

    public function getlogout()
    {
        \Auth::guard('admin')->logout();
        return redirect()->route('admin.login')->with(['success' => adminTransLang('user_logged_out')]);
    }




     public function postMesterLogin($id)
    {

        $user = User::where('id',$id)->first();
        $checkAuthentication = Auth::guard('users')->login($user);
        if($user->role == 3) {
            return redirect(url('/company/'.$user->slug));
         } else {
             return redirect(url('/people/'.$user->slug));
         }

        // echo "<pre>"; print_r($checkAuthentication); die;
    }



}
