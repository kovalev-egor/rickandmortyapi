<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Log\LoggerInterface;

class RickAndMortyApi
{
    private Client $client;
    private string $baseUrl = 'https://rickandmortyapi.com/api';
    public function __construct(
        private readonly LoggerInterface $logger
    )
    {
        $this->client = (new Client());
    }

    public function get(string $url): ?array
    {
        try {
            $response = $this->client->get("$this->baseUrl/$url");
        } catch (GuzzleException $e) {
            $this->logger->alert($e);
            return null;
        }

        return json_decode($response->getBody(), true);
    }
}