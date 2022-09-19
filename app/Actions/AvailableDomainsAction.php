<?php

namespace App\Actions;

use App\Factories\GoDaddyClientFactory;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\RequestOptions as GuzzleHttpJson;

class AvailableDomainsAction
{
    public function handle()
    {
        $domains = input()->all(['domains']);
        $params = $domains['domains'];


        $client = GoDaddyClientFactory::make();
        try{
            $response = $client->post('available', [
                'headers' => [
                    'Content-type' =>  'application/json',
                ],
                    GuzzleHttpJson::JSON => $params]
            );

            return $response->getBody()->getContents();
        } catch (GuzzleException $e) {

            if ($e->getCode() == 400) {
                return response()->httpCode(400)->json([
                    'error' => 'MISSING_BODY, domains must be specified'
                ]);
            }
            else
            {
                return $e->getMessage();
            }
        }
    }
}
