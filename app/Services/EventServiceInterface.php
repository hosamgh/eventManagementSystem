<?php

namespace App\Services;

use App\Models\Event;
use Illuminate\Support\Collection;

interface EventServiceInterface
{
    public function getEvents(array $filter):Collection;

    public function store(array $attributes): Event;

    public function update(Event $event, array $attributes): Event;

    public function destroy(Event $event): void;

    public function calculateEventPrice(Event $event):array;
}
