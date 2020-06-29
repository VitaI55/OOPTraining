<?php

class Farm
{
    private int $moneyBalance;
    private int $cornBalance;

    public function __construct(int $moneyBalance, int $cornBalance)
    {
        $this->moneyBalance = $moneyBalance;
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
            $params = $worker->work($this->moneyBalance, $this->cornBalance);
            $this->moneyBalance = $params['payedSalary'];
            $this->cornBalance = $params['earnedCorn'];
        }
    }

    public function sellCorn(Deliver $transport): void
    {
        $this->cornBalance = $transport->doShipping($this->moneyBalance, $this->cornBalance);
    }

    public function checkDeliver(array $garage): void
    {
        foreach ($garage as $index => $transport) {
            if ($transport->getDeliverTime() >= 1) {
                $deliverMoney = $transport->isDelivering($this->moneyBalance);
                if (!empty($deliverMoney)) {
                    $this->moneyBalance = $deliverMoney;
                }
            }
        }
    }
}