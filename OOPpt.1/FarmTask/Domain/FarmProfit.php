<?php

class FarmProfit
{
    private Farm $farm;
    private Exchange $exchange;

    public function __construct(Farm $farm, Exchange $exchange)
    {
        $this->farm = $farm;
        $this->exchange = $exchange;
        $this->garage = [];
    }

    public function ifProfitable(array $params)
    {
        if ($params['price'] === $this->exchange->getMaxPrice()) {
            if ($this->farm->getCornBalance() >= 100 && isset($params['transport']['plane'])) {
                $this->farm->sellCorn($params['transport']['plane']);

                return $params['transport']['plane'];

            } else if ($this->farm->getCornBalance() >= 20 && isset($params['transport']['train'])) {
                $this->farm->sellCorn($params['transport']['train']);

                return $params['transport']['train'];

            } else if ($this->farm->getCornBalance() >= 4 && isset($params['transport']['truck'])) {
                $this->farm->sellCorn($params['transport']['truck']);

                return $params['transport']['truck'];
            }
        }
    }

    public function cleanGarage(array $garage)
    {
        foreach ($garage as $index => $transport) {
            if ($transport->getDeliverTime() === 0) {

                return $index;
            }
        }
    }
}