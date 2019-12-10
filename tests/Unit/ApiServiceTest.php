<?php 

use App\Http\Services\ApiService;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Exception\RequestException;


class ApiServiceTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;
    
    // tests
    public function testShouldReturnNullOnEmptyMethod()
    {       

        $api_service = $this->make(ApiService::class);
        
        $method = null;
        $url = "";
        $format = "";
        $params = [];

        $this->assertEquals(null, $api_service->send($method, $url, $format, $params));
    }

    public function testShouldReturnSuccessTrueOnValidEndpoint()
    {
        $method = "GET";
        $url = "/test";
        $format = "application/json";
        $params = [];

        $mock = new MockHandler([
                        new Response(200, [], 'Response Success')
                    ]);
        $handler = HandlerStack::create($mock);
        $client = new Client(['handler' => $handler]);

        $api_service = new ApiService($client);
        $response = $api_service->send($method, $url, $format, $params);
        $this->assertTrue($response['success']);
    }
}