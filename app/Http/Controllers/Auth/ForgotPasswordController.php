<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function forgotPasswordForm()
    {
        return view('adm.auth.recover');
    }

    public function sendResetLinkResponse()
    {
        return back()->with(['type' => 'success', 'message' => 'A message to reset your password was sent to your email!']);
    }

    public function sendEmail(Request $request)
    {
        return $this->sendResetLinkEmail($request);
    }
}
