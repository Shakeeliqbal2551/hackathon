<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Booking extends Model
{
    use HasFactory, SoftDeletes;

    public function slot()
    {
        return $this->belongsTo(BookableSlot::class, 'bookable_slot_id');
    }

    public function clients()
    {
        return $this->hasMany(Client::class);
    }
    public function service()
    {
        return $this->belongsTo(service::class, 'service_id');
    }
}
