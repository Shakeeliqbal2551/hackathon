<?php

namespace Database\Seeders;

use App\Models\Service;
use App\Models\TimeBreak;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class TimeBreakSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $service = Service::where('name', 'Men Haircut')->first();
        $service2 = Service::where('name', 'Women Haircut')->first();

        TimeBreak::create([
            'start_time' => Carbon::createFromTime(12, 0, 0),
            'end_time' => Carbon::createFromTime(13, 0, 0),
            'service_id' => $service->id,
        ]);

        TimeBreak::create([
            'start_time' => Carbon::createFromTime(12, 0, 0),
            'end_time' => Carbon::createFromTime(13, 0, 0),
            'service_id' => $service2->id,
        ]);

        TimeBreak::create([
            'start_time' => Carbon::createFromTime(15, 0, 0),
            'end_time' => Carbon::createFromTime(16, 0, 0),
            'service_id' => $service->id,
        ]);

        TimeBreak::create([
            'start_time' => Carbon::createFromTime(15, 0, 0),
            'end_time' => Carbon::createFromTime(16, 0, 0),
            'service_id' => $service2->id,
        ]);
    }

}
