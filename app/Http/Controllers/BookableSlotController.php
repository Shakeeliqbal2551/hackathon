<?php

namespace App\Http\Controllers;

use App\Interfaces\BookableSlotInterface;

class BookableSlotController extends Controller
{
    private $bookableSlotRepository;

    public function __construct(
        BookableSlotInterface $bookableSlotRepository
    ) {
        $this->bookableSlotRepository = $bookableSlotRepository;
    }


    public function calendar()
    {
        return $this->bookableSlotRepository->getAvailableSlots();
    }


    



}
