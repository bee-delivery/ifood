<?php

namespace BeeDelivery\ifood;


use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;


class Connection {

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

    }

    public function auth(){

        try {
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => $this->base_url."/oauth/token",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => array('client_id' => 'beedelivery','client_secret' => '59W5ajbz','grant_type' => 'password','username' => 'POS-328207445','password' => 'POS-328207445'),
                CURLOPT_HTTPHEADER => array(
                    "content-type: multipart/form-data",
                    "Cookie: JSESSIONID=9FB5ABBD1391D4EC6FE7F698B3B7B627"
                ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            $response = json_decode($response);
            return $response->access_token;
        }catch (\Exception $e){

            return $e;
        }


    }

    public function get($url)
    {
        $token = $this->auth();

        try{
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => $this->base_url.$url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_HTTPHEADER => array(
                    "Authorization: Bearer ".$token
                ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            $response = json_decode($response);
            return $response;
        }catch (\Exception $e){

            return $e;
        }

    }

    public function post($url, $params)
    {

        $token = $this->auth();
        try{

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => $this->base_url.$url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => $params,
                CURLOPT_HTTPHEADER => array(
                    "Authorization: Bearer ".$token
                ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            $response = json_decode($response);
            return $response;

        }catch (\Exception $e){

            return $e;
            
        }
    }

    
}