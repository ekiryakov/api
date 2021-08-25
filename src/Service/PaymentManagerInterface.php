<?php

namespace App\Service;

use App\Entity\Subscription;

interface PaymentManagerInterface
{
    /**
     * @param Subscription $subscription
     * @return string
     */
    public function link(Subscription $subscription): string;
}