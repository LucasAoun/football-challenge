<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Services\FootballApiService;
use Illuminate\Http\Request;

class FootballController extends Controller{

    protected $football_api_service;

    public function __construct(){
        $this->football_api_service = app(FootballApiService::class);
    }

    public function index(Request $request){
        $matches = $this->football_api_service->getAllMatches();
        $competition_matches = [];
        if($request->search){
            $competition_matches = $this->football_api_service->searchTeamOrCompetition($request->search);
        }
        return view('football.index', ['matches' => $matches, 'competition_matches' => $competition_matches, 'search' => $request->search]);
    }

}