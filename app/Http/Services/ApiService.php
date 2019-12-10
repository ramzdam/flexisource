<?php
namespace App\Http\Services;

use App\Http\Interfaces\ApiInterface;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Facades\Log;
use App\Http\Services\ParserService;

/**
 * Created by Madzmar Ullang
 */
class ApiService implements ApiInterface
{
    use ParserService;
    private $method;

    public function __construct(Client $client)
    {        
        $this->client = $client;
    }

    /**
     * Send a request to API using the method passed
     *
     * @param $method - either get, post, put or delete
     * @param $url - the method function to processs
     * @param $params
     * @return array|null
     */
    public function send($method, $url, $format, $params = [])
    {
        $this->url = $url;

        if (empty($method)) {
            return null;
        }

        switch (strtoupper($method)) {
            case 'GET' :

                $param_data = [
                    'query' => $params,
                    'exceptions' => false,
                    'verify'     => false,
                    'headers' => [
                        'User-Agent' => "FLEXISOURCE",
                        'Accept' => $format,
                    ]
                ];
                break;

            default:

                $param_data = [
                    'body' => json_encode($params),
                    'headers' => [
                        'Content-Type' => 'application/json',
                        'User-Agent' => $_SERVER['HTTP_USER_AGENT'],
                        'Accept-Language' => isset($_SERVER['HTTP_ACCEPT_LANGUAGE']) ? $_SERVER['HTTP_ACCEPT_LANGUAGE'] : "en-US,en;q=0.8",
                    ],
                    'query' => [],
                    'exceptions' => false,
                    'verify'     => false,

                ];

                break;
        }

        try {            
            $response = $this->client->$method($this->url, $param_data);            
            $response = $response->getBody()->getContents();
            $response = $this->parse($response, $format);            
            
            return array(
                'success' => (isset($response->success)) ? $response->success : true,
                'data' => (isset($response->data)) ? $response->data : $response,
            );
        } catch (ClientException $e) {
            $client_error =  $e->getResponse()->getBody()->getContents();
            $response = json_decode($client_error, TRUE);
            Log::warning(__CLASS__ . ':' . __TRAIT__ . ':' . __FILE__ . ':' . __LINE__ . ':' . __FUNCTION__ . ':' .
                'Debug: Client error occured', [
                'code' => $e->getCode(),
                'client_message' => $e->getMessage(),
                'message' => $response['message'],
            ]);

            return array(
                'success' => $response['status'],
                'data' => $response,
                'message' => $response['message'],
            );

        } catch (\Exception $e) {
            Log::warning(__CLASS__ . ':' . __TRAIT__ . ':' . __FILE__ . ':' . __LINE__ . ':' . __FUNCTION__ . ':' .
                'Debug: An error occured', [
                'code' => $e->getCode(),
                'origmessage' => $e->getMessage(),
                'message' => 'Failed to fetch api',
            ]);

            return array(
                'success' => false,
                'data' => null,
                'message' => $e->getMessage()
            );
        }
    }
}