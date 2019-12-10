<?php
/**
 * Class AdminMessageRepository
 *
 * @date      24 August 2016
 * @author    Karthikeyan Sundaravel
 * @copyright Copyright (c) Infostream Group
 */

namespace App\Repositories;

use App\Detail;
use App\Traits\ModelTrait;
use App\Http\Interfaces\RecordInterface;
use Illuminate\Support\Facades\Log;

/**
 * Class AdminMessageRepository
 */
class DetailRepository implements RecordInterface
{
    use ModelTrait;

    public function __construct(Detail $model)
    {
        $this->setModel($model);
    }

    /**
     * Check if code exist in Details Table
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
            $detail = $this->getModel();

            $record = $detail::where('player_id', '=', $code)->first();

            if ($record) {
                return true;
            }

            return false;

        } catch(\Exception $e) {
            Log::error("An error has occured is isExist: " . $e->getMessage());
            throw new \Exception('Failed to retrieve player detail');
        }
    }

    /**
     * Save the record in Detail table
     *
     * @param Array $records
     * @return Boolean
     */
    public function save($records)
    {
        try {
            $detail = $this->getModel();

            if (isset($records['code'])) {
                $detail->player_id = $records['code'];
            }

            if (isset($records['form'])) {
                $detail->form = $records['form'];
            }

            if (isset($records['total_points'])) {
                $detail->total_points = $records['total_points'];
            }

            if (isset($records['influence'])) {
                $detail->influence = $records['influence'];
            }

            if (isset($records['creativity'])) {
                $detail->creativity = $records['creativity'];
            }

            if (isset($records['threat'])) {
                $detail->threat = $records['threat'];
            }

            if (isset($records['ict_index'])) {
                $detail->ict = $records['ict_index'];
            }

            if (isset($records['chance_of_playing_next_round'])) {
                $detail->chance_of_playing_next_round = $records['chance_of_playing_next_round'];
            }

            if (isset($records['chance_of_playing_this_round'])) {
                $detail->chance_of_playing_this_round = $records['chance_of_playing_this_round'];
            }

            if (isset($records['cost_change_event'])) {
                $detail->cost_change_event = $records['cost_change_event'];
            }

            if (isset($records['cost_change_event_fall'])) {
                $detail->cost_change_event_fall = $records['cost_change_event_fall'];
            }

            if (isset($records['cost_change_start'])) {
                $detail->cost_change_start = $records['cost_change_start'];
            }

            if (isset($records['dreamteam_count'])) {
                $detail->dreamteam_count = $records['dreamteam_count'];
            }

            if (isset($records['ep_next'])) {
                $detail->ep_next = $records['ep_next'];
            }

            if (isset($records['ep_this'])) {
                $detail->ep_this = $records['ep_this'];
            }

            if (isset($records['event_points'])) {
                $detail->event_points = $records['event_points'];
            }

            if (isset($records['in_dreamteam'])) {
                $detail->in_dreamteam = $records['in_dreamteam'];
            }

            if (isset($records['now_cost'])) {
                $detail->now_cost = $records['now_cost'];
            }

            if (isset($records['photo'])) {
                $detail->photo = $records['photo'];
            }

            if (isset($records['points_per_game'])) {
                $detail->points_per_game = $records['points_per_game'];
            }

            if (isset($records['selected_by_percent'])) {
                $detail->selected_by_percent = $records['selected_by_percent'];
            }

            if (isset($records['squad_number']) && !is_null($records['squad_number'])) {
                $detail->squad_number = $records['squad_number'];
            }

            if (isset($records['team'])) {
                $detail->team = $records['team'];
            }

            if (isset($records['team_code'])) {
                $detail->team_code = $records['team_code'];
            }

            if (isset($records['status'])) {
                $detail->status = $records['status'];
            }

            if (isset($records['transfers_in'])) {
                $detail->transfers_in = $records['transfers_in'];
            }

            if (isset($records['transfers_in_event'])) {
                $detail->transfers_in_event = $records['transfers_in_event'];
            }

            if (isset($records['transfers_out'])) {
                $detail->transfers_out = $records['transfers_out'];
            }

            if (isset($records['transfers_out_event'])) {
                $detail->transfers_out_event = $records['transfers_out_event'];
            }

            if (isset($records['web_name'])) {
                $detail->web_name = $records['web_name'];
            }

            return $detail->save();
        } catch(\Exception $e) {
            Log::error("An error has occured in save: " . $e->getMessage());
            throw new $e;
        }
    }

    /**
     * Update Detail table based fromm code
     *
     * @param String $code
     * @param Array $record
     * @return Boolean
     */
    public function update($record, $code) 
    {
        try {
            $detailModel = $this->getModel();
            $detail = $this->getDetailByCode($code);
            
            $detail->form = $record['form'];
            $detail->total_points = $record['total_points'];
            $detail->influence = $record['influence'];
            $detail->creativity = $record['creativity'];
            $detail->threat = $record['threat'];
            $detail->ict = $record['ict_index'];
            $detail->chance_of_playing_next_round = $record['chance_of_playing_next_round'];         
            $detail->chance_of_playing_this_round = $record['chance_of_playing_this_round'];
            $detail->cost_change_event = $record['cost_change_event'];
            $detail->cost_change_event_fall = $record['cost_change_event_fall'];
            $detail->cost_change_start = $record['cost_change_start'];
            $detail->dreamteam_count = $record['dreamteam_count'];
            $detail->ep_next = $record['ep_next'];
            $detail->ep_this = $record['ep_this'];
            $detail->event_points = $record['event_points'];
            $detail->in_dreamteam = $record['in_dreamteam'];
            $detail->now_cost = $record['now_cost'];
            $detail->photo = $record['photo'];
            $detail->points_per_game = $record['points_per_game'];
            $detail->selected_by_percent = $record['selected_by_percent'];
            $detail->squad_number = $record['squad_number'];
            $detail->team = $record['team'];
            $detail->team_code = $record['team_code'];
            $detail->status = $record['status'];
            $detail->transfers_in = $record['transfers_in'];
            $detail->transfers_in_event = $record['transfers_in_event'];
            $detail->transfers_out = $record['transfers_out'];
            $detail->transfers_out_event = $record['transfers_out_event'];
            $detail->web_name = $record['web_name'];
            
            return $detail->save();

        } catch(\Exception $e) {
            Log::error("An error has occured in update: " . $e->getMessage());
            throw new $e;
        }
    }

    /**
     * Retrieve Detail by code
     *
     * @param String $code
     * @return Collection|null
     */
    public function getDetailByCode($code) 
    {
        try {
            if (!$code) {
                return null;
            }

            $detailModel = $this->getModel();
            $detail = $detailModel::where('player_id', '=', $code)->first();
           
            return $detail;

        } catch(\Exception $e) {
            Log::error("An error has occured: " . $e->getMessage());
            return null;
        }
    }
}