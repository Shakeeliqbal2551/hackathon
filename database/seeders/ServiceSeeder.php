<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Service::create([
            'name' => 'Men Haircut',
            'duration' => 10,
            'max_clients' => 3,
            'break_duration' => 5,
            'booking_days_limit' => 7,
        ]);

        Service::create([
            'name' => 'Women Haircut',
            'duration' => 60,
            'max_clients' => 3,
            'break_duration' => 10,
            'booking_days_limit' => 7,
        ]);
    }
}
