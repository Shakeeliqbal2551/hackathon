<?php

namespace Database\Seeders;

use App\Models\PlannedOffDay;
use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class PlannedOffDaySeeder extends Seeder
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

        PlannedOffDay::create([
            'service_id' => $service->id,
            'description' => 'Public Holiday',
            'date' => Carbon::now()->addDays(2)->format('Y-m-d'),
            'is_full_day' => true,
        ]);

        PlannedOffDay::create([
            'service_id' => $service2->id,
            'description' => 'Public Holiday',
            'date' => Carbon::now()->addDays(2)->format('Y-m-d'),
            'is_full_day' => true,
        ]);
    }
}
