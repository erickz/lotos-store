<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Web\WebBaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends WebBaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function doLogin(Request $request)
    {
        $errors = $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        //Attempt to login
        if (Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password])) {
            if ($request->has('redirectTo') && $request->get('redirectTo')){
                return response()->json(['message' => $request->get('redirectTo'), 'error' => 0]);
            }
            else {
                return response()->json(['message' => route('web.customers.mybuys'), 'error' => 0]);
            }
        }

        return response()->json(['message' => 'Seu email ou senha estão errado(s), por favor tente de novo.', 'error' => 1]);
    }

    public function logout()
    {
        auth()->guard('web')->logout();

        return redirect()->route('web.home'); 
    }
}
