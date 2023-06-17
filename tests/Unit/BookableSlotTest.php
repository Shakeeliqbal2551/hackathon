<?php
namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class BookableSlotTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $this->assertTrue(true);
    }

    public function test_getCalender()
    {
        
        $client = new \GuzzleHttp\Client();
  
        $response = $client->request(
            'GET',
            env('base_url') . 'api/calendar'
        );
        $this->assertEquals(200, $response->getStatusCode());
    }
}
