<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Instantiate a new UserController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['register','verifyPass']]);
    }



    public function register(Request $request) {


//        return 'here';
        $validator = Validator::make($request->all(), [
            'profile_id'=>'required|string',
            'mobile'=>'required|regex:/(09)[0-9]{9}/|digits:11|numeric|unique:users',
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

        try {

            $user = new \App\Models\User();

            $user['profile_id'] = $request->get('profile_id') ?? '';
            $user['mobile'] = $request->get('mobile') ?? '';
            $user['password'] = Hash::make($request->get('password'))  ;
            $user['last_attempt_login'] = date('Y-m-d H:i:s') ?? '';
            $user->save();


            if ( $token = auth('api')->attempt(['mobile' => $user['mobile'], 'password' => $request->get('password')])) {
                $newToken = auth('api')->refresh();
            }

            return response()->json([
                'status'=>1000,
                'success'=>true,
                'data'=>[
                    'msg'=>__('ثبت نام شما با موفقیت انجام شد'),
                    'access_token'=>$newToken ?? '',
                    'user'=>$user
                ]
            ],201);
        }catch (\Exception $exception){
            return returnExceptionApiResponse();
        }
    }


    public function verifyPass(Request $request) {

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

        try {

            $user = User::query()->where('mobile',$request->get('mobile'))->first();

            if (Hash::check($request->get('password'),$user['password'])){
                $user['last_attempt_login'] = date('Y-m-d H:i:s') ?? '';
                $user->save();

                return response()->json([
                    'status'=>1000,
                    'success'=>true,
                    'data'=>[
                        'user'=>$user
                    ]
                ],201);
            }
            return response()->json([
                'status'=>1004,
                'success'=>false,
                'data'=>[
                    'msg'=>__('رمز عبور صحیح نمیباشد')
                ]
            ],201);


        }catch (\Exception $exception){
            return returnExceptionApiResponse();
        }
    }


    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json([
            'status'=>1000,
            'success'=>true,
            'data'=>[
                'user'=>auth()->user()
            ]
        ]);
    }


    /**
     * Get the authenticated User.
     *
     * @return Response
     */
    public function profile()
    {
        return response()->json(['user' => Auth::user()], 200);
    }




}
