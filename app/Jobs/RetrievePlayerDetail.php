<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use App\Http\Interfaces\ApiInterface;
use App\Repositories\PlayerRepository;
use App\Repositories\DetailRepository;


class RetrievePlayerDetail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->service = $service;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(ApiInterface $service, PlayerRepository $playerRepository, DetailRepository $detailRepository)
    {

        $records = $service->send('GET', config('api.url'), config('api.format'));
        $elements = isset($records['data']['elements']) ? $records['data']['elements'] : [];

        foreach ($elements as $value) {
            $code = $value['code'];

            if (!$code) {                
                continue;
            }
            
            $this->saveUpdatePlayer($code, $value, $playerRepository);
            $this->saveUpdateDetail($code, $value, $detailRepository);
        }

    }

    private function saveUpdatePlayer($code, $value, PlayerRepository $playerRepository)
    {
        if ($playerRepository->isExist($code)) {
            return $playerRepository->update($value, $code);
        }
        
        return $playerRepository->save($value, $code);        
    }

    private function saveUpdateDetail($code, $value, DetailRepository $detailRepository)
    {
        if ($detailRepository->isExist($code)) {
            return $detailRepository->update($value, $code);
        }

        return $detailRepository->save($value, $code);        
    }
}
