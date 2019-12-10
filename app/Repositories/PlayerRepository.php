<?php
/**
 * Class AdminMessageRepository
 */

namespace App\Repositories;

use App\Player;
use App\Traits\ModelTrait;
use App\Traits\Transformers\PlayerTransformer;
use App\Http\Interfaces\RecordInterface;
use Illuminate\Support\Facades\Log;

/**
 * Class PlayerRepository
 */
class PlayerRepository implements RecordInterface
{
    use ModelTrait, PlayerTransformer;

    public function __construct(Player $model)
    {
        $this->setModel($model);
    }

    /**
     * Check the code if existing in the DB
     *
     * @param String $code
     * @return Boolean
     */
    public function isExist($code)
    {
        if (!$code) {
            return false;
        }

        try {
            $player = $this->getModel();

            $record = $player::where('id', '=', $code)->first();

            if ($record) {
                return true;
            }

            return false;

        } catch(\Exception $e) {
            Log::error("An error has occured: " . $e->getMessage());
            throw new Exception('Failed to retrieve player detail');
        }
    }

    /**
     * Save the records based from the detail received from API
     *
     * @param Array $records
     * @return Boolean
     */
    public function save($records)
    {
        try {
            $player = $this->getModel();

            if (isset($records['code'])) {
                $player->id = $records['code'];
            }

            if (isset($records['first_name'])) {
                $player->first_name = $records['first_name'];
            }

            if (isset($records['second_name'])) {
                $player->second_name = $records['second_name'];
            }

            return $player->save();
        } catch(\Exception $e) {
            Log::error("An error has occured: " . $e->getMessage());
            throw new Exception('Failed to save player detail');
        }
    }

    /**
     * Update DB record based from given code and details
     *
     * @param Array $record
     * @param String $code
     * @return Boolean
     */
    public function update($record, $code) 
    {
        try {
            $playerModel = $this->getModel();
            $player = $this->getDetailByCode($code);
            $player->first_name = $record['first_name'];
            $player->second_name = $record['second_name'];
            return $player->save();

        } catch(\Exception $e) {
            Log::error("An error has occured: " . $e->getMessage());
            throw new Exception('Failed to update player detail');
        }
    }

    /**
     * Get record by code
     *
     * @param String $code
     * @return Collection
     */
    public function getDetailByCode($code) 
    {
        try {
            if (!$code) {
                return null;
            }

            $playerModel = $this->getModel();
            $player = $playerModel::find($code);
           
            return $player;

        } catch(\Exception $e) {
            Log::error("An error has occured: " . $e->getMessage());
            return null;
        }
    }

    /**
     * Retrieve all player records
     *
     * @return Array[Collection]
     */
    public function getAll()
    {
        try {
            $playerModel = $this->getModel();
            $players = $playerModel::with(['detail'])->get();
            $records = [];
                        
            foreach ($players as $player) {
                $records[] = $this->transformRecord($player);
            }

            return $records;
        } catch (\Exception $e) {
            Log::error("An error has occured: " . $e->getMessage());
            return null;
        }
    }

    /**
     * Get player record by code
     *
     * @param String $code
     * @return Collection
     */
    public function get($code)
    {
        try {
            $playerModel = $this->getModel();
            $player = $playerModel::find($code);
            
            $record = $this->transformRecord($player);
            return $record;
        } catch(\Exception $e) {
            Log::error("An error has occured: " . $e->getMessage());
            return null;
        }
    }
}