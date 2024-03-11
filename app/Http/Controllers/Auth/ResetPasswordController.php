<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Str;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '';

    protected function setRedirectTo($redirectTo = '')
    {
        $this->redirectTo = $redirectTo;
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');

        $this->setRedirectTo(route('adm.dashboard.index'));
    }

    /**
     * I had to overrite this function so It would pass the session key `message` instead of `status`
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    protected function sendResetResponse(Request $request, $response)
    {
        return redirect($this->redirectPath())->with('message', trans($response));
    }

    public function resetForm(Request $request, $token = null)
    {
        return view('adm.auth.reset')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }

    public function doReset(Request $request)
    {
        return $this->reset($request);
    }
}
