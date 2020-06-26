<?php

class PlaneShipImpl implements Deliver
{
    private const DELIVER_TIME = 5;
    private int $deliverTime = 0;
    private int $difference = 0;

    /**
     * @return int
     */
    public function getDeliverTime(): int
    {
        return $this->deliverTime;
    }

    /**
     * @return int
     */
    public function getDifference(): int
    {
        return $this->difference;
    }

    public function doShipping(Farm $farm): void
    {
        if ($farm->getCornBalance() < 5000) {
            $this->difference = $farm->getCornBalance();
            $farm->cornBalance -= $farm->getCornBalance();
        } else {
            $farm->cornBalance -= 5000;
        }
        $this->isDelivering($farm);
    }

    public function paymentForDeliverMin(Farm $farm): int
    {
        return $farm->moneyBalance += ($this->difference * 15) - 1000;
    }

    public function paymentForDeliverMax(Farm $farm): int
    {
        return $farm->moneyBalance += (5000 * 15) - 1000;
    }

    public function isDelivering(Farm $farm): void
    {
        $this->deliverTime++;
        if ($this->deliverTime === self::DELIVER_TIME) {
            if ($this->difference === 0) {
                $this->paymentForDeliverMax($farm);
            } else {
                $this->paymentForDeliverMin($farm);
            }
            $this->deliverTime = 0;
        }
    }
}