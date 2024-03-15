<?php

namespace App\Services\HttpClient;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;

class HttpClient
{
    private Client $client;

    public function __construct(array $config = [])
    {
        $this->client = new Client($config);
    }

    /**
     * @throws GuzzleException
     */
    public function get($uri, array $options = [])
    {
        $response = $this->client->get($uri, $options);

        return $this->parseResponse($response);
    }

    /**
     * @throws GuzzleException
     */
    public function post($uri, array $options = [])
    {
        $response = $this->client->post($uri, $options);

        return $this->parseResponse($response);
    }

    protected function parseResponse(ResponseInterface $response)
    {
        return json_decode($response->getBody()->getContents(), true);
    }
}
