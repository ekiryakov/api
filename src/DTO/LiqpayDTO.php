<?php

namespace App\DTO;

class LiqpayDTO
{
    /** @var float */
    private float $amount;

    /** @var string */
    private string $description;

    /** @var int */
    private int $order_id;

    /**
     * @param $order_id
     * @param $amount
     * @param $description
     */
    public function __construct($order_id, $amount, $description)
    {
        $this->order_id = $order_id;
        $this->amount = $amount;
        $this->description = $description;
    }

    /**
     * @return int
     */
    public function getVersion(): int
    {
        return 3;
    }

    /**
     * @return string
     */
    public function getAction(): string
    {
        return 'subscribe';
    }

    /**
     * @return string
     */
    public function getCurrency(): string
    {
        return 'UAH';
    }

    /**
     * @return float
     */
    public function getAmount(): float
    {
        return $this->amount;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return int
     */
    public function getOrderId(): int
    {
        return $this->order_id;
    }

    /**
     * @return string
     */
    public function getDateStart(): string
    {
        return date('Y-m-d H:i:s');
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'version' => $this->getVersion(),
            'action' => $this->getAction(),
            'amount' => $this->getAmount(),
            'currency' => $this->getCurrency(),
            'description' => $this->getDescription(),
            'order_id' => $this->getOrderId(),
            'subscribe_date_start' => $this->getDateStart(),
        ];
    }
}