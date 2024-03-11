<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\BaseApiController;
use Illuminate\Http\Request;
use Validator;

class LoginController extends BaseApiController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    public function doLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $credentials = $request->only(['email', 'password']);

        if (!$token = auth('api')->attempt($credentials)) {
            return $this->sendError('Unauthorized', [], 401);
        }

        return $this->sendResponse([
            'token' => $token,
            'expires' => auth('api')->factory()->getTTL() * 60,
        ], 'Logged in!');
    }
}
