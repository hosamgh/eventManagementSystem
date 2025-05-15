<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBookingRequest;
use App\Services\BookingServiceInterface;
use Illuminate\Http\Request;
use App\Traits\ApiResponseTrait;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
class BookingController extends Controller implements HasMiddleware
{

      public static function middleware(): array
    {
        return [
            new Middleware('throttle:10,1', only: ['store']),
        ];
    }

    use ApiResponseTrait;
    protected $bookingService;
    /**
     * Display a listing of the resource.
     */

    public function __construct(BookingServiceInterface $bookingService)
    {
        $this->bookingService = $bookingService;
    }

    public function index(Request $request)
    {
        $bookingHistory = $this->bookingService->bookingHistory($request->all());
        return $this->successResponse($bookingHistory, null, 200);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookingRequest $request)
    {
        try {
            $booking = $this->bookingService->book($request->validated());
            return $this->successResponse($booking, 'Success! Your booking is now complete', 201);
        } catch (Exception $e) {
            Log::error('Unable to complete the booking: ' . $e->getMessage(), ['exception' => $e]);
            return $this->errorResponse('Unable to complete the booking.', 500, ['exception' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
