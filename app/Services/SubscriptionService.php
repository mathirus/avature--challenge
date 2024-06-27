<?php

namespace App\Services;

use App\Repositories\SubscriptionRepository;

class SubscriptionService
{
    protected $subscriptionRepository;

    public function __construct(SubscriptionRepository $subscriptionRepository)
    {
        $this->subscriptionRepository = $subscriptionRepository;
    }

    public function createOrUpdateSubscription(array $data)
    {
        return $this->subscriptionRepository->updateOrCreate(
            ['email' => $data['email']],
            $data
        );
    }
}
