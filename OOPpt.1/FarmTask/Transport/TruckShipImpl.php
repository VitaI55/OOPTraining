<?php

class TruckShipImpl implements Deliver
{
    private const DELIVER_TIME = 10;
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
        if ($farm->getCornBalance() < 300) {
            $this->difference = $farm->getCornBalance();
            $farm->cornBalance -= $farm->getCornBalance();
        } else {
            $farm->cornBalance -= 300;
        }
        $this->isDelivering($farm);
    }

    public function paymentForDeliverMin(Farm $farm): int
    {
        return $farm->moneyBalance += ($this->difference * 15) - 50;
    }

    public function paymentForDeliverMax(Farm $farm): int
    {
        return $farm->moneyBalance += (300 * 15) - 50;
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