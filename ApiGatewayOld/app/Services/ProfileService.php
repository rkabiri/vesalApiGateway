<?php


namespace App\Services;


use App\Traits\RequestService;
use Illuminate\Support\Facades\Request;

class ProfileService
{
    use RequestService;
    public $baseUri;
    public $secret;
    public function __construct()
    {
        $this->baseUri = config('services.profiles.base_uri');
        $this->secret = config('services.profiles.secret');
    }
    public function fetchProfiles($params=[])
    {
        return $this->request('GET', '/api/profiles',$params);
    }
    public function fetchProfile($profile,$params=[])
    {
        return $this->request('GET', "/api/profiles/show/{$profile}",$params);
    }
    public function createProfile($data)
    {
        return $this->request('POST', '/api/profiles/store', $data);
    }
    public function updateProfile($profile, $data)
    {
        return $this->request('PATCH', "/api/profiles/update/{$profile}", $data);
    }
    public function deleteProfile($profile)
    {
        return $this->request('DELETE', "/api/product/delete/{$profile}");
    }
}
