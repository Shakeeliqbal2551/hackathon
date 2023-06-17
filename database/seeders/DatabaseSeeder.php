<?php

namespace Database\Seeders;

use App\Models\PlannedOffDay;
use App\Models\TimeBreak;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ServiceSeeder::class);
        $this->call(ClientSeeder::class);
        $this->call(OpeningHourSeeder::class);
        $this->call(TimeBreakSeeder::class);
        $this->call(PlannedOffDaySeeder::class);
        $this->call(BookingSeeder::class);
        $this->call(BookableSlotSeeder::class);
    }
}
