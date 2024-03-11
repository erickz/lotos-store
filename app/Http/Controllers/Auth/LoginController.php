<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * @return string
     */
    public function getRedirectTo(): string
    {
        return route('adm.dashboard.index');
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function index()
    {
        return view('adm.auth.login');
    }

    /**
     *
     */
    public function doLogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        //Attempt to login
        if (Auth::guard('adm')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            return redirect($this->getRedirectTo());
        }

        return back()->withInput($request->except("password"))->withErrors(['authentication' => 'Your email or password are wrong, please try again.']);

    }

    public function logout(Request $request)
    {
        auth()->logout();

        return redirect(route('adm.auth.index'));
    }
}
