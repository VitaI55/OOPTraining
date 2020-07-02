<?php

class FarmProfit
{
    private Exchange $exchange;
    private array $acceptedTransport;

    /**
     * @return array
     */
    public function getAcceptedTransport(): array
    {
        return $this->acceptedTransport;
    }

    public function __construct(Exchange $exchange)
    {
        $this->exchange = $exchange;
        $this->acceptedTransport = [];
    }

    public function ifProfitable(int $price, array $transport, Farm $farm)
    {
        if ($price === $this->exchange->getMaxPrice()) {

            foreach ($transport as $tran) {
                if ($tran->getName() === 'Plane' && $farm->getCornBalance() >= 80) {
                    array_push($this->acceptedTransport, $tran);

                    return $tran;
                } else if ($tran->getName() === 'Truck' && $farm->getCornBalance() >= 5) {
                    array_push($this->acceptedTransport, $tran);

                    return $tran;
                } else if ($tran->getName() === 'Train' && $farm->getCornBalance() >= 15) {
                    array_push($this->acceptedTransport, $tran);

                    return $tran;
                }
            }
        }
    }

    public function cleanGarage(): void
    {
        foreach ($this->acceptedTransport as $index => $transport) {
            if ($transport->getDeliverTime() === 0) {
                unset($this->acceptedTransport[$index]);
            }
        }
    }
}