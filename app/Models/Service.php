<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    use HasFactory, SoftDeletes;

    public function openingHours()
    {
        return $this->hasMany(OpeningHour::class);
    }

    public function timeBreaks()
    {
        return $this->hasMany(TimeBreak::class);
    }

    public function plannedOffDays()
    {
        return $this->hasMany(PlannedOffDay::class);
    }

    public function bookableSlots()
    {
        return $this->hasMany(BookableSlot::class);
    }
}
