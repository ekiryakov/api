<?php

namespace App\Service;

use App\Entity\Subscription;

class Calculator
{
    private const INTEREST_RATE = 10;

    /**
     * @param Subscription $subscription
     * @param float|int $commission
     * @return float
     */
    public static function execute(Subscription $subscription, float $commission = 0): float
    {
        $amount = 0;
        foreach ($subscription->getOffer() as $offer) {
            $amount += $offer->getCost() ?? 0;
        }

        return round($amount / (100 - self::INTEREST_RATE - $commission) * 100, 2);
    }
}