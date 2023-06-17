<?php

namespace Database\Seeders;

use App\Models\BookableSlot;
use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class BookableSlotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Get the necessary data from the database tables
        $services = Service::with(['openingHours', 'timeBreaks', 'plannedOffDays'])->get();

        // Calculate the start and end dates for the next 7 days
        $startDate = Carbon::now()->addDay(0)->startOfDay(); // Start from the third day starting from now
        $endDate = $startDate->copy()->addDays(6)->endOfDay();

        foreach ($services as $service) {
            $this->createBookableSlots($service, $startDate, $endDate);
        }
    }

    private function createBookableSlots($service, $startDate, $endDate)
    {
        $openingHours = $service->openingHours;
        $timeBreaks = $service->timeBreaks;
        $plannedOffDays = $service->plannedOffDays;

        $date = $startDate->copy();
        while ($date <= $endDate) {
            // Check if the date is a planned off day for the service
            $plannedOffDay = $plannedOffDays->where('date', $date->toDateString())->first();

            if ($plannedOffDay) {
                // Skip creating bookable slots for the planned off day
                $date->addDay();
                continue;
            }

            $dayOpeningHours = $openingHours->where('day_of_week', $date->englishDayOfWeek)->first();

            if ($dayOpeningHours) {
                $dayTimeBreaks = $timeBreaks->where('start_time', '<', $dayOpeningHours->end_time)
                    ->where('end_time', '>', $dayOpeningHours->start_time)
                    ->sortBy('start_time');

                $this->createSlotsForDay($service, $date, $dayOpeningHours, $dayTimeBreaks);
            }

            $date->addDay();
        }
    }

    private function createSlotsForDay($service, $date, $dayOpeningHours, $dayTimeBreaks)
    {
        $startTime = $date->copy()->setTimeFromTimeString($dayOpeningHours->start_time);
        $endTime = $date->copy()->setTimeFromTimeString($dayOpeningHours->end_time);

        $currentTime = $startTime->copy();
        foreach ($dayTimeBreaks as $timeBreak) {
            if (
                $currentTime >= $date->copy()->setTimeFromTimeString($timeBreak->start_time)
                && $currentTime < $date->copy()->setTimeFromTimeString($timeBreak->end_time)
            ) {
                $currentTime = $date->copy()->setTimeFromTimeString($timeBreak->end_time);
                break;
            }
        }

        while ($currentTime < $endTime) {
            $isDuringTimeBreak = $dayTimeBreaks->where('start_time', '<=', $currentTime->format('H:i:s'))
                ->where('end_time', '>', $currentTime->format('H:i:s'))->isNotEmpty();

            $isOverlapWithTimeBreak = $dayTimeBreaks
                ->where( 'start_time', '<=', $currentTime->copy()->addMinutes($service->duration)->format('H:i:s'))
                ->where('end_time', '>', $currentTime->copy()->addMinutes($service->duration) ->format('H:i:s'))
                ->isNotEmpty();

            $isOverlapWithDayEnd = $currentTime
                ->copy()
                ->addMinutes($service->duration)
                ->greaterThanOrEqualTo($endTime);

            if (!$isDuringTimeBreak && !$isOverlapWithTimeBreak && !$isOverlapWithDayEnd) {
                $this->createBookableSlot($service, $currentTime);
            }

            $currentTime->addMinutes($service->duration);
            $currentTime->addMinutes($service->break_duration);

            foreach ($dayTimeBreaks as $timeBreak) {
                if (
                    $currentTime >= $date->copy()->setTimeFromTimeString($timeBreak->start_time)
                    && $currentTime < $date->copy()->setTimeFromTimeString($timeBreak->end_time)
                ) {
                    $currentTime = $date->copy()->setTimeFromTimeString($timeBreak->end_time);
                    break;
                }
            }
        }
    }

    private function createBookableSlot($service, $currentTime)
    {
        $bookableSlot = new BookableSlot();
        $bookableSlot->service_id = $service->id;
        $bookableSlot->start_time = $currentTime;
        $bookableSlot->end_time = $currentTime->copy()->addMinutes($service->duration);
        $bookableSlot->save();
    }
}
