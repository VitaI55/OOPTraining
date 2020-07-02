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
        $this->workers = [new CommonWorker(), new FarmerWorker(), new TractorWorker()];
    }

    public function getMoneyBalance(): int
    {
        return $this->moneyBalance;
    }

    public function getCornBalance(): int
    {
        return $this->cornBalance;
    }

    public function payWorkers(): void
    {
        foreach ($this->workers as $worker) {
            $afterSalary = $worker->getSalary($this->moneyBalance);
            if ($afterSalary !== $this->moneyBalance) {
                $this->moneyBalance = $afterSalary;
                $this->cornBalance = $worker->earnCorn($this->cornBalance);
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
            if ($transport->getDeliverTime() >= 1) {
                $deliverMoney = $transport->isDelivering($this->moneyBalance);
                if (!empty($deliverMoney)) {
                    $this->moneyBalance = $deliverMoney;
                }
            }
        }
    }
}