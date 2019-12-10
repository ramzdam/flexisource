<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\PlayerRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Interfaces\ApiInterface;
use GuzzleHttp\Client;

class HomeController extends Controller
{
    public function __construct(ApiInterface $service, PlayerRepository $player_repository)
    {
    	Log::info("Inside interface homecontroller");
    	$this->service = $service;
    	$this->player_repository = $player_repository;
    }

    public function index() 
    {

   //  	$record = [
			// 'chance_of_playing_next_round'=> 100,
			// 'chance_of_playing_this_round'=> 100,
			// 'code'=> 69140,
			// 'cost_change_event'=> 0,
			// 'cost_change_event_fall'=> 0,
			// 'cost_change_start'=> -3,
			// 'cost_change_start_fall'=> 3,
			// 'dreamteam_count'=> 0,
			// 'element_type'=> 2,
			// 'ep_next'=> "0.3",
			// 'ep_this'=> "1.3",
			// 'event_points'=> 0,
			// 'first_name'=> "Shkodran",
			// 'form'=> "0.8",
			// 'id'=> 1,
			// 'in_dreamteam'=> false,
			// 'news'=> "",
			// 'news_added'=> "2019-11-28T23:00:21.541666Z",
			// 'now_cost'=> 52,
			// 'photo'=> "69140.jpg",
			// 'points_per_game'=> "4.0",
			// 'second_name'=> "Mustafi",
			// 'selected_by_percent'=> "0.3",
			// 'special'=> false,
			// 'squad_number'=> null,
			// 'status'=> "a",
			// 'team'=> 1,
			// 'team_code'=> 3,
			// 'total_points'=> 4,
			// 'transfers_in'=> 7650,
			// 'transfers_in_event'=> 55,
			// 'transfers_out'=> 31507,
			// 'transfers_out_event'=> 132,
			// 'value_form'=> "0.2",
			// 'value_season'=> "0.8",
			// 'web_name'=> "Mustafi",
			// 'minutes'=> 90,
			// 'goals_scored'=> 0,
			// 'assists'=> 1,
			// 'clean_sheets'=> 0,
			// 'goals_conceded'=> 2,
			// 'own_goals'=> 0,
			// 'penalties_saved'=> 0,
			// 'penalties_missed'=> 0,
			// 'yellow_cards'=> 0,
			// 'red_cards'=> 0,
			// 'saves'=> 0,
			// 'bonus'=> 0,
			// 'bps'=> 24,
			// 'influence'=> "19.8",
			// 'creativity'=> "0.8",
			// 'threat'=> "54.0",
			// 'ict_index'=> "7.5"
   //  	];
   //  	dd($this->player_repository->update($record, $record['code']));

  //   	$url = 'https://fantasy.premierleague.com/api/bootstrap-static/';
		// $client = new \GuzzleHttp\Client();

		// $response = $client->request('GET', $url, [
		//     'verify' => false,
		//     'headers' => [
		//         'User-Agent' => 'CUSTOM_AGENT_YOU_WANT' // THIS IS WHAT I ADDED TO MAKE IT WORK
		//     ]
		// ]);

		// dd(json_decode($response->getBody()->getContents(), true));
		$response = $this->service->send('GET', config('api.url'), config('api.format'));
		// $element_type = $response["data"]["element_types"];
		// $teams = $response["data"]["teams"];
		// dd($response,$element_type, $teams);
    }
}
