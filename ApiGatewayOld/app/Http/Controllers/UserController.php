<?php

namespace App\Http\Controllers;

use App\Services\ProfileService;
use App\Services\UserService;
use Illuminate\Http\Request;
use function Symfony\Component\Translation\t;

class UserController extends Controller
{
    private $userService;
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function login(Request $request)
    {

        return $this->successResponse($this->userService->login($request->all()));
    }

    public function refresh(Request $request)
    {
        return $this->successResponse($this->userService->refresh($request->all()));
    }

    public function check(Request $request)
    {
        return $this->successResponse($this->userService->check($request->all()));
    }

    public function logout(Request $request)
    {
        return $this->successResponse($this->userService->logout($request->all()));
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response|\Laravel\Lumen\Http\ResponseFactory
     * CREATE PROFILE AND SEND DATA WITH PROFILE ID TO CREATE USER
     */
    public function register(Request $request)
    {
        $profileService = new ProfileService();
        $profileStoreService = $this->successResponse($profileService->createProfile($request->all()));
        $profileStoreService = json_decode($profileStoreService->getContent(), true);
        if ($profileStoreService['status']==1000){
            $profileId = $profileStoreService['data']['profile']['_id'];
            $request = $request->all() ;
            $request['profile_id'] = $profileId;
            $userRegisterService = $this->successResponse($this->userService->register($request));
//            $userRegisterService = json_decode($userRegisterService->getContent(), true);
            return $userRegisterService ;
        }else{
            return $this->errorResponse(__('خطا در سرور'),500);
        }
    }

    public function verifyPass(Request $request)
    {
        return $this->successResponse($this->userService->verifyPass($request->all()));
    }

    public function userProfile(Request $request)
    {
        return $this->successResponse($this->userService->userProfile($request->all()));
    }
}
