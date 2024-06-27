<?php

namespace App\Repositories;

use App\Models\Subscription;

class SubscriptionRepository
{

    public function updateOrCreate(array $attributes, array $values = [])
    {
        return Subscription::updateOrCreate($attributes, $values);
    }
}
