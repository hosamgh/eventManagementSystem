<?php

namespace App\Services;

use App\Models\Booking;
use Illuminate\Support\Collection;

interface BookingServiceInterface
{
    public function book(array $attributes): Booking;
    public function bookingHistory(array $attributes): Collection;
}
