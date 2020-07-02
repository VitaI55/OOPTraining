<?php

class TrainDeliver implements Deliver
{
    private const DELIVER_TIME = 15;
    private int $deliverTime = 0;
    private int $difference = 0;
    private string $name = 'Train';
    private int $price;

    public function __construct(int $price)
    {
        $this->price = $price;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function doShipping(int $farmMoney, int $farmCorn): int
    {
        if ($farmCorn < 1000) {
            $this->difference = $farmCorn;
            $corn = 0;
        } else {
            $corn = $farmCorn - 1000;
        }
        $this->isDelivering($farmMoney);

        return $corn;
    }

    public function getDeliverTime(): int
    {
        return $this->deliverTime;
    }

    public function paymentForDeliver(): int
    {
        return ($this->difference * $this->price) - 200;
    }

    public function paymentForDeliverMax(): int
    {
        return (1000 * $this->price) - 200;
    }

    public function isDelivering(int $farmMoney)
    {
        $this->deliverTime++;
        if ($this->deliverTime === self::DELIVER_TIME) {
            if ($this->difference === 0) {
                $moneyFromDeliver = $this->paymentForDeliverMax();
            } else {
                $moneyFromDeliver = $this->paymentForDeliver();
            }
            $this->deliverTime = 0;

            return $farmMoney + $moneyFromDeliver;
        }
    }
}
