<?php

namespace App\Events;

use App\Models\Subscription;
use Illuminate\Foundation\Events\Dispatchable;

class SubscriptionCreatedEvent
{
    use Dispatchable;

    public function __construct(
        public Subscription $subscription,
    ) {}
}
