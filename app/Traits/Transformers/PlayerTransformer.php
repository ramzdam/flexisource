<?php

namespace App\Traits\Transformers;

/**
 * Trait PlayerTransformer
 *
 * This Trait will be responsible for transforming collection record
 * into a Prettier format to be presented as response
 */
trait PlayerTransformer
{
	/**
     * Transform record to a simplified format
     *
     * @param Collection $record
     * @return Array
     */
    public function transformSimpleRecord($record)
    {
    	$output = [
            'code' => $record->id,
            'first_name' => $record->first_name,
            'second_name' => $record->second_name,
            'form' => $record->detail->form,
            'total_points' => $record->detail->total_points,
            'influence' => $record->detail->influence,
            'creativity' => $record->detail->creativity,
            'threat' => $record->detail->threat,
            'ict_index' => $record->detail->ict,
            
        ];

        return $output;
    }

	/**
     * Transform record into more detailed response
     *
     * @param Collection $record
     * @return Array
     */
    public function transformRecord($record)
    {

    	$output = $this->transformSimpleRecord($record);
    	$output['chance_of_playing_next_round'] = $record->detail->chance_of_playing_next_round;
        $output['chance_of_playing_this_round'] = $record->detail->chance_of_playing_this_round;
        $output['cost_change_event'] = $record->detail->cost_change_event;
        $output['cost_change_event_fall'] = $record->detail->cost_change_event_fall;
        $output['cost_change_start'] = $record->detail->cost_change_start;
        $output['dreamteam_count'] = $record->detail->dreamteam_count;
        $output['ep_next'] = $record->detail->ep_next;
        $output['ep_this'] = $record->detail->ep_this;
        $output['event_points'] = $record->detail->event_points;
        $output['in_dreamteam'] = $record->detail->in_dreamteam;
        $output['now_cost'] = $record->detail->now_cost;
        $output['photo'] = $record->detail->photo;
        $output['points_per_game'] = $record->detail->points_per_game;
        $output['selected_by_percent'] = $record->detail->selected_by_percent;
        $output['squad_number'] = $record->detail->squad_number;
        $output['team'] = $record->detail->team;
        $output['team_code'] = $record->detail->team_code;
        $output['status'] = $record->detail->status;
        $output['transfers_in'] = $record->detail->transfers_in;
        $output['transfers_in_event'] = $record->detail->transfers_in_event;
        $output['transfers_out'] = $record->detail->transfers_out;
        $output['transfers_out_event'] = $record->detail->transfers_out_event;
        $output['web_name'] = $record->detail->web_name;

        return $output;
    }
}
