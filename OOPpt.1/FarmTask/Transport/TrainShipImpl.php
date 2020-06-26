<?php

class TrainShipImpl implements Deliver
{
    private const DELIVER_TIME = 15;
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
        if ($farm->getCornBalance() < 1000) {
            $this->difference = $farm->getCornBalance();
            $farm->cornBalance -= $farm->getCornBalance();
        } else {
            $farm->cornBalance -= 1000;
        }
        $this->isDelivering($farm);
    }

    public function paymentForDeliverMin(Farm $farm): int
    {
        return $farm->moneyBalance += ($this->difference * 15) - 200;
    }

    public function paymentForDeliverMax(Farm $farm): int
    {
        return $farm->moneyBalance += (1000 * 15) - 200;
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