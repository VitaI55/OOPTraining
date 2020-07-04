<?php

class Farm
{
    private int $moneyBalance;
    private int $cornBalance;
    private array $workers;
    private FarmProfit $profitCalculation;

    public function __construct(int $moneyBalance, int $cornBalance, FarmProfit $profitCalculation)
    {
        $this->moneyBalance = $moneyBalance;
        $this->cornBalance = $cornBalance;
        $this->profitCalculation = $profitCalculation;
    }

    public function getMoneyBalance(): int
    {
        return $this->moneyBalance;
    }

    public function getCornBalance(): int
    {
        return $this->cornBalance;
    }

    public function acceptWorker(Worker $worker): void
    {
        $this->workers[] = $worker;
    }

    public function payWorkers(): void
    {
        foreach ($this->workers as $worker) {
            $afterSalary = $this->moneyBalance - $worker->getSalary();

            if ($afterSalary >= 0) {
                $this->moneyBalance = $afterSalary;
                $this->cornBalance += $worker->earnCorn();
            }
        }
    }

    public function sellCorn(int $price, array $transport): void
    {
        $profTransport = $this->profitCalculation->ifProfitable($price, $transport, $this);

        if ($profTransport !== null) {
            $this->cornBalance = $profTransport->doShipping($this->moneyBalance, $this->cornBalance);
        }
    }

    public function checkDeliver(): void
    {
        foreach ($this->profitCalculation->getAcceptedTransport() as $index => $transport) {

            if ($transport->getDeliverTime() < 1) {
                continue;
            }

            $deliverMoney = $transport->isDelivering($this->moneyBalance);

            if (!empty($deliverMoney)) {
                $this->moneyBalance = $deliverMoney;
            }
        }
    }
}