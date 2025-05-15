<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'event_id',
        'full_name',
        'user_email',
        'mobile_number',
        'amount',
        'total_amount',
        'discount',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }


}
