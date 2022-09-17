<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use  App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{


    /**
     * AuthController constructor.
     * PUT MIDDLEWARE ON FUNCTIONS
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'refresh','check', 'logout']]);
    }


    /**
     * @param Request $request
     * @return array|\Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     * LOGIN USER / GET TOKEN
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mobile'=>'required|regex:/(09)[0-9]{9}/|digits:11|numeric',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'=>1002, // * CUSTOM ERROR FOR VALIDATION
                'success'=>false,
                'data'=>[
                    'msg'=>getCustomValidatorErrors($validator->errors()->toArray())
                ]
            ],200);
        }

        $credentials = $request->only(['mobile', 'password']);

        if (! $token = Auth::guard('api')->attempt($credentials)) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        return response()->json([
            'status'=>1000,
            'success'=>true,
            'data'=>$this->respondWithToken($token)
        ],200);
    }



    /**
     * @return \Illuminate\Http\JsonResponse
     * LOGOUT USER
     */
    public function logout()
    {
        auth()->guard('api')->logout();
        return response()->json([
            'status'=>1000,
            'success'=>true,
            'data'=>[
                'msg'=>__('شما با موفقیت از حساب خود خارج شدید')
            ]
        ],200);
    }


    /**
     * @return \Illuminate\Http\JsonResponse
     * GET NEW TOKEN
     */
    public function refresh()
    {
        return response()->json([
            'status'=>1000,
            'success'=>true,
            'data'=>$this->respondWithToken(auth()->guard('api')->refresh())
        ],200);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     * GET NEW TOKEN
     */
    public function check()
    {
        if (auth()->guard('api')->check()){
            return response()->json([
                'status'=>1000,
                'success'=>true,
                'data'=>['msg'=>__('تایید شده')]
            ],200);
        }else{

            return response()->json([
                'status'=>1001,
                'success'=>false,
                'data'=>['msg'=>__('خطا در احراز هویت')]
            ],200);
        }

    }

    /**
     * @param $token
     * @return array
     */
    protected function respondWithToken($token)
    {
        return [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60 * 24 * 100,
            'user' => auth()->user()
        ];
    }
}
