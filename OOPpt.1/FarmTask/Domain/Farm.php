<?php

class Farm
{
    public int $moneyBalance;
    public int $cornBalance;

    public function __construct(int $moneyBalance, int $cornBalance)
    {
        $this->moneyBalance = $moneyBalance;
        $this->cornBalance = $cornBalance;
    }

    public function setMoneyBalance(int $moneyBalance): void
    {
        $this->moneyBalance = $moneyBalance;
    }

    public function setCornBalance(int $cornBalance): void
    {
        $this->cornBalance = $cornBalance;
    }

    public function getMoneyBalance(): int
    {
        return $this->moneyBalance;
    }

    public function getCornBalance(): int
    {
        return $this->cornBalance;
    }

    public function payWorker(array $workers): void
    {
        foreach ($workers as $worker) {
            $worker->work($this);
        }
    }

    public function sellCorn(Deliver $transport): void
    {
        $transport->doShipping($this);
    }

    public function checkDeliver(array $garage): void
    {
        foreach ($garage as $index => $transport) {
            if ($transport->getDeliverTime() >= 1) {
                $transport->isDelivering($this);
            }
        }
    }
}