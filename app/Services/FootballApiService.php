<?php

namespace App\Services;

use Carbon\Carbon;
use GuzzleHttp\Client;

class FootballApiService
{

    protected $client;
    protected $apiKey;
    protected $base_url = "https://api.football-data.org/v4/";

    public function __construct()
    {
        $this->client = new Client();
        $this->apiKey = env('API_TOKEN_FOOTBALL');
    }

    public function getAllMatches()
    {
        $current_date = Carbon::now();
        $date_from = $current_date->format('Y-m-d');
        $date_to = $current_date->addDays(10)->format('Y-m-d');
        $endpoint = $this->base_url . "matches?dateFrom=" . $date_from . "&dateTo=" . $date_to;
        $response = $this->makeRequest($endpoint);
        $data = json_decode($response->getBody(), true);
        if (isset($data['matches'])) {
            $data['matches'] = array_slice($data['matches'], 0, 10);
        }
        return $data;
    }

    public function makeRequest($endpoint)
    {
        $response = $this->client->get($endpoint, [
            'headers' => [
                'X-Auth-Token' => $this->apiKey,
            ],
        ]);
        return $response;
    }

    public function searchTeamOrCompetition($search)
    {
        $competitionId = $this->getCompetitionIdByNameOrAcronym($search);
        if ($competitionId) {
            return $this->getCompetitionMatches($competitionId);
        }

        return ['error' => 'Competição não encontrada.'];
    }

    protected function getCompetitionIdByNameOrAcronym($competitionNameOrAcronym)
    {
        $endpoint = $this->base_url . 'competitions';
        $response = $this->makeRequest($endpoint);
        $data = json_decode($response->getBody(), true);
        $competitions = $data['competitions'] ?? [];

        $filteredTeam = current(array_filter($competitions, function ($competition) use ($competitionNameOrAcronym) {
            return strtolower($competition['name']) === strtolower($competitionNameOrAcronym) || strtolower($competition['code']) === strtolower($competitionNameOrAcronym);;
        }));
    
        return $filteredTeam['id'] ?? null;
    }


    public function getCompetitionMatches($competitionId)
    {
        $endpoint = $this->base_url . 'competitions/' . $competitionId . '/matches';
        $response = $this->makeRequest($endpoint);
        $data = json_decode($response->getBody(), true);

        return [
            'last_matches' => $this->filterLastMatches($data['matches']),
            'next_matches' => $this->filterNextMatches($data['matches']),
        ];
    }

    protected function filterLastMatches($matches)
    {
        $finishedMatches = array_filter($matches, function ($match) {
            return $match['status'] === 'FINISHED';
        });

        return array_slice($finishedMatches, -10, 10);
    }

    protected function filterNextMatches($matches)
    {
        $scheduledMatches = array_filter($matches, function ($match) {
            return $match['status'] === 'SCHEDULED' || $match['status'] === 'TIMED';
        });

        return array_slice($scheduledMatches, 0, 10);
    }
}
