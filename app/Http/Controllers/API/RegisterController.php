<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Validator;

class RegisterController extends BaseController
{
    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);

        if ($validator->fails()) return $this->sendError('Validation Error.', $validator->errors(), 422);

        try {
            $user = User::create([
                'name'     => $request->name,
                'email'    => $request->email,
                'password' => bcrypt($request->password)
            ]);

            $success['name']  = $user->name;
            $message          = 'Success! New user has been successfully registered.';
            $success['token'] = $user->createToken('accessToken')->accessToken;
        } catch (Exception $e) {
            $success['token'] = [];
            $message          = 'Error! Unable to register a new user.';
        }

        return $this->sendResponse($success, $message);
    }

    /**
     * Return Auth user api
     *
     * @return \Illuminate\Http\Response
     *  @return \Illuminate\Http\JsonResponse
     */
    public function user()
    {
        return auth()->user();
    }

}