<?php

namespace BeeDelivery\ifood;


use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;


class Connection {

    public $http;
    public $base_url;
    public $client_id;
    public $client_secret;
    public $username;
    public $password;


    public function __construct($client_id, $client_secret, $username, $password) {

        $this->base_url = 'https://pos-api.ifood.com.br';
        $this->client_id = $client_id;
        $this->client_secret = $client_secret;
        $this->username =  $username;
        $this->password = $password;

        $this->http = new Client([
            'headers' => [
                'timeout'  => 2.0,
                'content-type' => 'multipart/form-data'
            ],
        ]);

        return $this->http;
    }

    public function auth(){
        try {
            $body = [
                'form_params' => [
                    'cliente_id' => $this->client_id,
                    'client_secret' => $this->client_secret,
                    'grant_type' => 'password',
                    'username' => $this->username,
                    'password' => $this->password
                ]
            ];

            $response =  $this->http->request('POST',$this->base_url.'/oauth/token', $body);

            $response_auth = $response->getBody();
            return $response_auth['access_token'];
        } catch (GuzzleException $e) {
            return $e;
        }
    }

    public function get($url)
    {

        try{
            $body = [
                'header' => [
                    'Authorization'  => 'Bearer '.$this->auth()
                ]
            ];
            $response = $this->http->get($this->base_url . $url, $body);
            return [
                'code'     => $response->getStatusCode(),
                'response' => json_decode($response->getBody()->getContents())
            ];
        }catch (\Exception $e){

            return [
                'code'     => $e->getCode(),
                'response' => $e->getMessage()
            ];
        } catch (GuzzleException $e) {
            return $e;
        }

    }

    public function post($url, $params)
    {
        $body = [
            'json' => $params,
            'header' => [
                'Authorization'  => 'Bearer '.$this->auth(),
                'Content-Type' => 'application/json',
                'Cache-Control' => 'no-cache'
            ]
        ];
        
        try{

            $response = $this->http->post($this->base_url . $url, $body);

            return [
                'code'     => $response->getStatusCode(),
                'response' => json_decode($response->getBody()->getContents())
            ];

        }catch (\Exception $e){

            return [
                'code'     => $e->getCode(),
                'response' => $e->getMessage()
            ];
            
        } catch (GuzzleException $e) {
            return $e;
        }
    }

    
}