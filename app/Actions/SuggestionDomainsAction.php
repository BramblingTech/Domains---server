<?php

namespace App\Actions;

use App\Factories\GoDaddyClientFactory;
use GuzzleHttp\Exception\GuzzleException;

class SuggestionDomainsAction
{
    public function handle()
    {
        $params = [
            'query' => url()->getParam('query'),
            'tlds' => url()->getParam('tlds'),
            'limit' => url()->getParam('limit'),
            'waitMs' => url()->getParam('waitMs')
        ];

        $client = GoDaddyClientFactory::make();
        try{
            $response = $client->get('suggest', ['query' => $params]);
            return $response->getBody();
        } catch (GuzzleException $e) {
            return $e->getMessage();
        }

    }
}
