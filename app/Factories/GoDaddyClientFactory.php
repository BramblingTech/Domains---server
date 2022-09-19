<?php
namespace App\Factories;

use GuzzleHttp\Client as Client;

class GoDaddyClientFactory
{
    public static function make(){
        $client = new Client([
            'base_uri' => env('GODADDY_HOST').'v1/domains/',
            'headers' => [
                'Authorization' => "sso-key ".env('GODADDY_KEY').":".env('GODADDY_SECRET'),
                'Accept' => 'application/json'
            ]
        ]);
        return $client;
    }
}