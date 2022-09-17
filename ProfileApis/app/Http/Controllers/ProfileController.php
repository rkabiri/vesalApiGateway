<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use http\Client\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * php -S localhost:8000 -t public
     * php artisan db:seed
     */


    /**
     * @return mixed
     ** GET ALL PROFILES
     */
    public function index(){
        $profiles = Profile::all();
        return response()->json([
            'status'=>1000,
            'success'=>true,
            'data'=>[
                'profiles'=>$profiles
            ]
        ],200);
    }

    /**
     * @param $profile
     * @return mixed
     */
    public function show($profile){
        try {

            if ($profile = Profile::query()
                ->where('_id',$profile)
                ->first()){
                return response()->json([
                    'status'=>1000,
                    'success'=>true,
                    'data'=>[
                        'profile'=>$profile
                    ]
                ],200);
            }else{
                return response()->json([
                    'status'=>1004,// * CUSTOM ERROR FOR NOT FOUND
                    'success'=>false,
                    'data'=>[
                        'msg'=>__('کاربر یافت نشد')
                    ]
                ],200);
            }

        }catch (\Exception $exception){
            return $this->returnExceptionApiResponse();
        }
    }


    public function store(Request $request){
//        <input type="text" name="mobile" pattern="^(\+98|0)?9\d{9}$" title="mobile number">

        $validator = Validator::make($request->all(), [
            'first_name'=>'required|max:255|string',
            'last_name'=>'required|max:255|string',
            'age'=>'required|max:100|numeric',
            'mobile'=>'required|regex:/(09)[0-9]{9}/|digits:11|numeric|unique:profiles',
            'lat' => 'required|between:-90,90',
            'lng' => 'required|between:-180,180'
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
            $request = $request->all();
            unset($request['_token']);
            $profile = new Profile();
            $profile->fill($request);
            $profile['last_login_ip'] = $_SERVER['REMOTE_ADDR'] ?? '';
            $profile->save();

            return response()->json([
                'status'=>1000,
                'success'=>true,
                'data'=>[
                    'profile'=>$profile
                ]
            ],200);
        }catch (\Exception $exception){
            return returnExceptionApiResponse();
        }

    }

    public function update(Request $request, $profile){
        $validator = Validator::make($request->all(), [
            'first_name'=>'required|max:255|string',
            'last_name'=>'required|max:255|string',
            'age'=>'required|max:100|numeric',
            'mobile'=>'required|regex:/(09)[0-9]{9}/|digits:11|numeric',
            'lat' => 'required|between:-90,90',
            'lng' => 'required|between:-180,180'
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
            $request = $request->all();
            unset($request['_token']);
            $profile = Profile::find($profile);
            $profile->update($request);
            $profile['last_login_ip'] = $_SERVER['REMOTE_ADDR'] ?? '';
            $profile->save();

            return response()->json([
                'status'=>1000,
                'success'=>true,
                'data'=>[
                    'profile'=>$profile
                ]
            ],200);
        }catch (\Exception $exception){
            return returnExceptionApiResponse();
        }
    }

    public function destroy($profile){
        try {
            Profile::find($profile)->delete();
            return response()->json([
                'status'=>1000,
                'success'=>true,
                'data'=>[
                    'msg'=>__('کاربر با موفقیت حذف گردید')
                ]
            ],200);
        }catch (\Exception $exception){
            return returnExceptionApiResponse();
        }
    }
}
