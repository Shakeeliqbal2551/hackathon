<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class BookingTest extends TestCase
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

    public function test_saveBooking()
    {
        $params = [
            'bookable_slot_id' => 1,
            'people' => [
                [
                    'first_name' => 'John',
                    'last_name' => 'Doe',
                    'email' => 'john.doe@hackaton.com',
                ],
                [
                    'first_name' => 'Mickel',
                    'last_name' => 'James',
                    'email' => 'mickel.james@hackaton.com',
                ],
                [
                    'first_name' => 'Emma',
                    'last_name' => 'Harley',
                    'email' => 'emma.harley@hackaton.com',
                ],
            ],
        ];
        
        $client = new \GuzzleHttp\Client();
        $response = $client->request(
            'POST',
            env('base_url') . 'api/booking',
            [
                'form_params' => $params,
            ]
        );
        $this->assertEquals(200, $response->getStatusCode());
    }
}
