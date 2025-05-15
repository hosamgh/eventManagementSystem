<?php

namespace App\Services;

use App\Events\TicketUpdated;
use App\Models\Booking;
use App\Models\Event;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Exception;
use Illuminate\Support\Collection;

class BookingService implements BookingServiceInterface
{
    /**
     * Create a new booking for an event.
     *
     * @param array $data
     * @return \App\Models\Booking
     */
    public function book(array $attributes): Booking
    {

        try {


            DB::beginTransaction();

            // Validate  event exists
            $event = Event::find($attributes['event_id']);

            if (!$event) {
                throw new ModelNotFoundException('Event not found.');
            }

            if ($event->status == 'closed') {
                throw new ModelNotFoundException('Event closed now.');
            }


            // prevent concurrency
            $event->lockForUpdate();
            $ticketsCount = $event->bookings()->count() + 1;
            // check the  available tickets
            if ($ticketsCount > $event->capacity) {

                throw new Exception('Tickets are sold out for this event. Please check back later or choose a different event.');
            }

            // get price after discount
            $finalPrice = $this->calculateDiscount($event, $ticketsCount);

            // Create the booking
            $booking = Booking::create([
                'event_id' => $attributes['event_id'],
                'full_name' => $attributes['full_name'],
                'user_email' => $attributes['user_email'],
                'mobile_number' => $attributes['mobile_number'],
                'amount' => $event->price,
                'total_amount' => $finalPrice['price_after_discount'],
                'discount' => $finalPrice['discount_percentage'],
            ]);

            if ($event->bookings()->count() >= $event->capacity) {
                $event->update(['status' => 'closed']);
            }
            $options = array(
                'cluster' => 'ap2',
                'useTLS' => false
            );
            //server
            $pusher = new \Pusher\Pusher(
                '5fed855ca904de9194c1',
                'b3425b5e79caac9f9eda',
                '1742875',
                $options
            );


            $pusher->trigger('events', 'ticket-update', [
                "id"=>$event->id,
                'bookings_count' => $event->bookings()->count(),
                "capacity"=>$event->capacity
            ]);
            DB::commit();

            return $booking;
        } catch (Exception $e) {
            // Rollback  in case of an error
            DB::rollBack();
            Log::error('Booking creation failed: ' . $e->getMessage());
            throw $e;
        }
    }


    public function bookingHistory(array $attributes): Collection
    {
        $bookings = Booking::with('event')
            ->latest()
            ->get();

        return $bookings;
    }

    private function calculateDiscount(Event $event, $ticketsCount)
    {

        // percentage of booked tickets
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
