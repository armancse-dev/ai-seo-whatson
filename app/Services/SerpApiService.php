<?php

namespace App\Services;

use GuzzleHttp\Client;

class SerpApiService
{
    protected $apiKey;

    public function __construct()
    {
        $this->apiKey = config('services.serpapi.key');
    }

    /**
     * Get top Google search results for a keyword using Guzzle
     */
    public function getCompetitors($keyword)
    {
        $client = new Client();

        $res = $client->get('https://serpapi.com/search.json', [
            'query' => [
                'q' => $keyword,
                'engine' => 'google',
                'api_key' => $this->apiKey,
                'num' => 10
            ]
        ]);

        $body = json_decode((string)$res->getBody(), true);
        $organic = $body['organic_results'] ?? [];

        $competitors = collect($organic)->map(function ($item) {
            return [
                'title' => $item['title'] ?? '',
                'link' => $item['link'] ?? '',
                'snippet' => $item['snippet'] ?? '',
            ];
        })->toArray();

        return $competitors;
    }
}
