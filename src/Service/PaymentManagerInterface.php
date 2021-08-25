<?php

namespace App\Service;

use App\Entity\Subscription;
use Symfony\Component\HttpFoundation\Request;

interface PaymentManagerInterface
{
    /**
     * @param Subscription $subscription
     * @return string
     */
    public function link(Subscription $subscription): string;

    /**
     * @param Request $request
     * @return bool
     */
    public function proof(Request $request): bool;

    /**
     * @param Subscription $subscription
     * @return bool
     */
    public function unsubscribe(Subscription $subscription): bool;
}