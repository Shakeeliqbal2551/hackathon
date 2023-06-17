<?php

namespace Database\Seeders;

use App\Models\OpeningHour;
use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class OpeningHourSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $daysOfWeek = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];

        $service = Service::where('name', 'Men Haircut')->first();
        $service2 = Service::where('name', 'Women Haircut')->first();

        foreach ($daysOfWeek as $day) {
            if ($day === 'Saturday') {
                $startTime = Carbon::createFromTime(10, 0, 0);
                $endTime = Carbon::createFromTime(22, 0, 0);
            } else {
                $startTime = Carbon::createFromTime(8, 0, 0);
                $endTime = Carbon::createFromTime(20, 0, 0);
            }

            OpeningHour::create([
                'day_of_week' => $day,
                'start_time' => $startTime,
                'end_time' => $endTime,
                'service_id' => $service->id,
            ]);

            OpeningHour::create([
                'day_of_week' => $day,
                'start_time' => $startTime,
                'end_time' => $endTime,
                'service_id' => $service2->id,
            ]);
        }
    }
}
