<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Event extends Model
{

    protected $fillable = [
        'name',
        'description',
        'event_date',
        'price',
        'capacity',
        'status',
    ];

    public function eventDate(): Attribute
    {
        return Attribute::make(
            set: fn($value) => Carbon::createFromFormat('d-m-Y', $value)->format('Y-m-d'),
            get:fn($value) => Carbon::parse($value)->format('d/m/Y')
        );
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }




}
