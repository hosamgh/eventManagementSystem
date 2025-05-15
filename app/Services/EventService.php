<?php

namespace App\Services;

use App\Models\Event;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

class EventService implements EventServiceInterface
{


    public function getEvents(array $filter): Collection
    {
        $events =  Event::withCount('bookings');
        if(isset($filter['status'])){
            $events->where('status',$filter['status']);
        }

       return  $events->latest()->get();
    }
    public function store(array $attributes): Event
    {
        try {
            return Event::create($attributes);
        } catch (Exception $e) {
            Log::error('Failed to create the event: ' . $e->getMessage(), ['exception' => $e]);
            throw new Exception('Failed to create the event.');
        }
    }


    public function update(Event $event, array $attributes): Event
    {
        try {
            $event->update($attributes);
            return $event;
        } catch (Exception $e) {
            Log::error('Failed to update the event: ' . $e->getMessage(), ['exception' => $e]);
            throw new Exception('Failed to update the event.');
        }
    }


    public function destroy(Event $event): void
    {
        try {
            $event->delete();
        } catch (Exception $e) {
            Log::error('Failed to delete the event: ' . $e->getMessage(), ['exception' => $e]);
            throw new Exception('Failed to delete the event.');
        }
    }

    public function calculateEventPrice(Event $event): array{
        $ticketsCount = $event->bookings()->count() + 1;
         $checkBooking = ($ticketsCount / $event->capacity) * 100;

        // Determine the discount based on the booking position
        if ($checkBooking < 30) {
            $discount = 0.10; // 10% discount on first 30% of tickets.
        } elseif ($checkBooking >= 90) {
            $discount = 0.20; // 20% discount on last 10%.
        } else {
            $discount = 0.00; // No discount for tickets
        }

        // calculate discount for user
        $price = $event->price;
        $discountAmount = $price * $discount;
        $priceAfterDiscount = $price - $discountAmount;

        return [
            'discount_percentage' => $discount * 100,
            'discount_amount' => $discountAmount,
            'price_after_discount' => $priceAfterDiscount
        ];
    }
}
