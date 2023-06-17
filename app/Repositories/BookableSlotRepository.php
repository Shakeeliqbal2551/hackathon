<?php

namespace App\Repositories;

use App\Interfaces\BookableSlotInterface;
use App\Models\PlannedOffDay;
use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class BookableSlotRepository implements BookableSlotInterface
{
    public function getAvailableSlots()
    {
        try {
            // Retrieve the necessary data from the database tables
            $services = Service::with(['bookableSlots' => function ($query) {
                $query->where('is_booked', 0);
            }])->get();

            // Get the range of dates from today to the next 7 days
            $dates = Collection::times(7, function ($index) {
                return Carbon::today()->addDays($index - 1)->format('Y-m-d');
            });

            $data = $this->formatData($services, $dates);

            return response()->json([
                'code' => Response::HTTP_OK,
                'data' => $data,
            ]);
        } catch (\Throwable $e) {
            Log::info('Error: ' . ($e));
            return [
                'code' => Response::HTTP_BAD_REQUEST,
                'message' => $e->getMessage(),
            ];
        }
    }

    private function formatData($services, $dates)
    {
        // Organize and format the data by services, dates, and time slots
        return $services->map(function ($service) use ($dates) {
            $bookableSlots = $service->bookableSlots->groupBy(function ($slot) {
                $startTime = Carbon::parse($slot->start_time);
                return $startTime->format('Y-m-d');
            })->map(function ($slots, $date) {

                return [
                    'date' => $date,
                    'day_name' => Carbon::parse($slots->first()->start_time)->format('l'),
                    'time_slots' => $slots->map(function ($slot) {
                        return [
                            'start_time' => Carbon::parse($slot->start_time)->format('H:i:s'),
                            'end_time' => Carbon::parse($slot->end_time)->format('H:i:s'),

                        ];
                    })->all(),
                ];
            })->all();

            return [
                'id' => $service->id,
                'name' => $service->name,
                'duration' => $service->duration,
                'booking_days_limit' => $service->booking_days_limit,
                'bookable_slots' => $dates->map(function ($date) use ($bookableSlots) {
                    $plannedOffDay = PlannedOffDay::where('date', $date)->first();

                    return $bookableSlots[$date] ?? [
                        'date' => $date,
                        'day_name' => Carbon::parse($date)->format('l'),
                        'off_day_description' => $plannedOffDay ? $plannedOffDay->description : null,
                        'time_slots' => []
                    ];
                })->values()->all(),
            ];
        });
    }
}
