<?php

class TruckDeliverImpl implements Deliver
{
    private const DELIVER_TIME = 10;
    private int $deliverTime = 0;
    private int $difference = 0;

    public function doShipping(int $farmMoney, int $farmCorn): int
    {
        if ($farmCorn < 300) {
            $this->difference = $farmCorn;
            $corn = 0;
        } else {
            $corn = $farmCorn - 300;
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
        return ($this->difference * 15) - 50;
    }

    public function paymentForDeliverMax(): int
    {
        return (300 * 15) - 50;
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