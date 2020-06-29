<?php

class PlaneDeliverImpl implements Deliver
{
    private const DELIVER_TIME = 5;
    private int $deliverTime = 0;
    private int $difference = 0;

    public function doShipping(int $farmMoney, int $farmCorn): int
    {
        if ($farmCorn < 5000) {
            $this->difference = $farmCorn;
            $corn = 0;
        } else {
            $corn = $farmCorn - 5000;
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
        return ($this->difference * 15) - 1000;
    }

    public function paymentForDeliverMax(): int
    {
        return (5000 * 15) - 1000;
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

            return $moneyFromDeliver + $farmMoney;
        }
    }
}