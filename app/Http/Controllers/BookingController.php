<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookingRequest;
use App\Interfaces\BookingInterface;

class BookingController extends Controller
{
    private $bookingRepository;

    public function __construct(
        BookingInterface $bookingRepository
    ) {
        $this->bookingRepository = $bookingRepository;
    }

    public function store(StoreBookingRequest $request)
    {
        return $this->bookingRepository->createBooking($request);
    }
}
