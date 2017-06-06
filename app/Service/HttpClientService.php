<?php

namespace App\Service;

use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Psr7;

class HttpClientService
{
    const GET_METHOD    = 'GET';
    const POST_METHOD   = 'POST';
    const PUT_METHOD    = 'PUT';
    const DELETE_METHOD = 'DELETE';

    public function callApi($method, $endPoint, $datas = null)
    {
        $client = new \GuzzleHttp\Client();
        $response = null;

        switch ($method) {
            case self::GET_METHOD:

                try {
                    $response = $client->request($method, env('API'). $endPoint, [
                        'headers' => $this->getHeaderOptions(),
                    ]);
                } catch (ClientException $e) {
                    $response = $e->getResponse();
                }

                break;
            case self::POST_METHOD:
                try {
                    $response = $client->request($method, env('API'). $endPoint, [
                        'form_params' => $datas,
                        'headers' => $this->getHeaderOptions(),
                    ]);
                } catch (ClientException $e) {
                    $errors = $e->getResponse()->getBody()->getContents();
                    return json_decode($errors);
                }

                break;
            case self::PUT_METHOD:
                try {
                    $response = $client->request($method, env('API'). $endPoint, [
                        'form_params' => $datas,
                        'headers' => $this->getHeaderOptions(),
                    ]);
                } catch (ClientException $e) {
                    $errors = $e->getResponse()->getBody()->getContents();
                    return json_decode($errors);
                }
                break;
            case self::DELETE_METHOD:
                $response = $client->request($method, env('API'). $endPoint, [
                    'headers' => $this->getHeaderOptions(),
                ]);

                break;
        }

        $response = json_decode($response->getBody());

        return $response;
    }

    private function getHeaderOptions()
    {
        return [
            'Accept' => 'application/json',
            'Authorization' => session('accessToken'),
        ];
    }

}