<?php

namespace App\Http\Controllers;

use App\Services\ProfileService;
use \Illuminate\Http\Request;

class ProfileController extends Controller
{
    private $profileService;
    public function __construct(ProfileService $profileService)
    {
        $this->profileService = $profileService;
    }
    public function index(Request $request)
    {
        return $this->successResponse($this->profileService->fetchProfiles($request->all()));
    }
    public function show(Request $request,$profile)
    {
        return $this->successResponse($this->profileService->fetchProfile($profile,$request->all()));
    }
    public function store(Request $request)
    {
        return $this->successResponse($this->profileService->createProfile($request->all()));
    }
    public function update(Request $request, $profile)
    {
        return $this->successResponse($this->profileService->updateProfile($profile, $request->all()));
    }
    public function destroy($profile)
    {
        return $this->successResponse($this->profileService->deleteProfile($profile));
    }
}
