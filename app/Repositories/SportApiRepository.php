<?php

namespace App\Repositories;

use App\Repositories\Contracts\SportApiRepositoryInterface;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class SportApiRepository implements SportApiRepositoryInterface
{
    private Client $client;
    private string $baseUrl;
    private string $apiKey;

    public function __construct()
    {
        $this->baseUrl = 'https://sportscore1.p.rapidapi.com';
        $this->apiKey = env('RAPIDAPI_KEY');
        $this->client = new Client([
            'base_uri' => $this->baseUrl,
            'timeout'  => 30,
            'headers'  => [
                'x-rapidapi-host' => parse_url($this->baseUrl, PHP_URL_HOST),
                'x-rapidapi-key'  => $this->apiKey,
                'Accept'          => 'application/json',
            ],
        ]);
    }

    private function request(string $method, string $uri, array $query = []): array
    {
        try {
            $response = $this->client->request($method, $uri, ['query' => $query]);
            return json_decode($response->getBody()->getContents(), true);
        } catch (RequestException $e) {
            return ['error' => $e->getMessage(), 'status_code' => $e->getCode()];
        }
    }

    public function sportList(): array
    {
        return $this->request('GET', '/sports');
    }

    public function leagueList(int $page = 1): array
    {
        return $this->request('GET', '/leagues', ['page' => $page]);
    }

    public function eventListByDate($date, $page = 1): array
    {
        return $this->request('GET', "/events/date/{$date}", ['page' => $page]);
    }
}
