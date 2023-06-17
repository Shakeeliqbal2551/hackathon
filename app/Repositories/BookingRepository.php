<?php

namespace App\Repositories;

use App\Interfaces\BookingInterface;
use App\Models\{BookableSlot, Booking, Client};
use Illuminate\Support\Facades\{DB, Log};
use Symfony\Component\HttpFoundation\Response;

class BookingRepository implements BookingInterface
{

    public function createBooking($request)
    {
        DB::beginTransaction();
        try {
            $bookableSlot = BookableSlot::findOrFail($request['bookable_slot_id']);

            $service = $bookableSlot->service;
            $currentEntries = $bookableSlot->total_entries;
            $maxClients = $service->max_clients;
            $numberOfClients = count($request['people']);
            $seatsLeft = $maxClients - $currentEntries;

            $validationError = $this->handleBookingValidation($bookableSlot, $numberOfClients, $seatsLeft);
            if ($validationError) {
                return response()->json($validationError);
            }

            $booking = $this->createBookingEntry($bookableSlot);
            $clients = $this->createClients($request['people'], $booking);
            $this->updateBookableSlot($bookableSlot, count($request['people']));

            DB::commit();

            return response()->json([
                'code' => Response::HTTP_OK,
                'message' => 'Booking created successfully',
                'booking' => $booking,
                'clients' => $clients,
            ]);
        } catch (\Throwable $e) {
            DB::rollback();
            Log::info('Error: ' . ($e));
            return response()->json([
                'code' => Response::HTTP_BAD_REQUEST,
                'message' => $e->getMessage(),
            ]);
        }
    }

    private function handleBookingValidation($bookableSlot, $numberOfClients, $seatsLeft)
    {
        if (!$bookableSlot->is_booked && ($numberOfClients > $seatsLeft)) {
            return [
                'code' => Response::HTTP_UNPROCESSABLE_ENTITY,
                'message' => 'Only ' . $seatsLeft . ' seat' . ($seatsLeft === 1 ? '' : 's') . ' left for this slot',
            ];
        } elseif ($bookableSlot->is_booked) {
            return [
                'code' => Response::HTTP_UNPROCESSABLE_ENTITY,
                'message' => 'The maximum number of clients for this time slot has been reached',
            ];
        }

        return null;
    }

    private function createBookingEntry($bookableSlot)
    {
        $booking = new Booking();
        $booking->bookable_slot_id = $bookableSlot->id;
        $booking->save();

        return $booking;
    }

    private function createClients($people, $booking)
    {
        $clients = [];

        foreach ($people as $person) {
            $client = new Client();
            $client->first_name = $person['first_name'];
            $client->last_name = $person['last_name'];
            $client->email = $person['email'];
            $client->booking_id = $booking->id;
            $client->save();
            $clients[] = $client;
        }

        return $clients;
    }

    private function updateBookableSlot($bookableSlot, $numberOfClients)
    {
        $bookableSlot->total_entries += $numberOfClients;
        if ($bookableSlot->total_entries == 3) {
            $bookableSlot->is_booked = 1;
        }
        $bookableSlot->save();
    }

}
