<?php
namespace App\Http\Services;

use Illuminate\Support\Facades\Log;

/**
 * Created by Madzmar Ullang
 */
trait ParserService
{
    /**
     * Parse the response based from a specified format
     *
     * @param String $response
     * @param String format
     * @return Array
     */
    public function parse($response, $format)
    {
        $provider_type = $format;

        switch ($provider_type) {
            case 'application/xml':
                $encode_response = json_encode(simplexml_load_string($response));   

                $decode_response = json_decode($encode_response, TRUE);
                return $decode_response;
                break;            
            default: // Response json
                $encode_response = json_encode($response);   

                $decode_response = json_decode($encode_response, TRUE);
                return json_decode($decode_response, TRUE);                
                break;
        }
    }   
}