<?php


namespace App\Traits;



use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

trait RequestService
{
    public function request($method, $requestUrl, $formParams = [], $headers = [])
    {
//        $requestBearer = $request->bearerToken();
//        return 'login';
        try {
            $guzzle = new Client(['base_uri' => $this->baseUri]);
            $response = $guzzle->request($method, $requestUrl, [
//                'headers' => [ 'Authorization' => 'Bearer ' . $formParams['token'] ],
                'json' => $formParams,
            ]);
            return $response->getBody()->getContents();
        }catch (ClientException $e){
            if ($e){
                $response = $e->getResponse();
                $responseBodyAsString = $response->getBody()->getContents();
                return $responseBodyAsString;
            }
            return 'error';
        }
    }
}
