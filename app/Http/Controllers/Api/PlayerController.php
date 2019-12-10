<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\PlayerRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Interfaces\ApiInterface;
use GuzzleHttp\Client;
use App\Traits\PlayerTrait;


class PlayerController extends Controller
{
	use PlayerTrait;

    public function __construct(ApiInterface $service, PlayerRepository $player_repository)
    {    
    	$this->service = $service;
    	$this->player_repository = $player_repository;
    }

    public function index() 
    {
    	try {
	    	$data = $this->getAll($this->player_repository);

	    	return response()->json(['success' => true, 'data' => $data]);
	    } catch(\Exception $e) {
	    	return response()->json(['success' => false, 'data' => null]);
	    }
    }

    public function detail(Request $request, $code)
    {
        try {
            $data = $this->get($this->player_repository, $code);
            return response()->json(['success' => true, 'data' => $data]);
        } catch(\Exception $e) {
            throw new $e;
            
            return response()->json(['success' => false, 'data' => null]);   
        }        
    }
}
