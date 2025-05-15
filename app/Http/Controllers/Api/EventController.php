<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Models\Event;
use App\Traits\ApiResponseTrait;
use Exception;
use Illuminate\Support\Facades\Log;
use App\Services\EventServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
class EventController extends Controller implements HasMiddleware
{
    use ApiResponseTrait;


    protected $eventService;


     public static function middleware(): array
    {
        return [
            new Middleware('throttle:10,1', only: ['store','update']),
        ];
    }

    /**
     * Create a new controller instance.
     *
     * @param  \App\Services\EventServiceInterface  $eventService
     * @return void
     */
    public function __construct(EventServiceInterface $eventService)
    {
        $this->eventService = $eventService;
    }

    public function index(Request $request)
    {
        $events = $this->eventService->getEvents($request->all());
        return $this->successResponse($events, null, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEventRequest $request)
    {
        try {
            $event = $this->eventService->store($request->validated());
            return $this->successResponse($event, 'Success! The event has been created.', 201);
        } catch (Exception $e) {
            Log::error('Failed to create the event: ' . $e->getMessage(), ['exception' => $e]);
            return $this->errorResponse('Failed to create the event.', 500, ['exception' => $e->getMessage()]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEventRequest $request, Event $event)
    {
        try {
            $event = $this->eventService->update($event, $request->validated());
            return $this->successResponse($event, 'Success! The event has been updated.');
        } catch (Exception $e) {
            Log::error('Failed to update the event: ' . $e->getMessage(), ['exception' => $e]);
            return $this->errorResponse('Failed to update the event.', 500);
        }
    }

    public function show(Event $event)
    {
        try {
            $eventPrice = $this->eventService->calculateEventPrice($event);

            return $this->successResponse([
                "event" => $event,
                "event_price" => $eventPrice,
            ], null, 200);
        } catch (Exception $e) {
            Log::error('Failed to fetch the event: ' . $e->getMessage(), ['exception' => $e]);
            return $this->errorResponse('Failed to fetch the event.', 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        try {
            $this->eventService->destroy($event);
            return $this->successResponse([], 'Success! The event has been deleted.');
        } catch (Exception $e) {
            Log::error('Failed to delete the event: ' . $e->getMessage(), ['exception' => $e]);
            return $this->errorResponse('Failed to delete the event.', 500);
        }
    }

 

     
        
    
}
