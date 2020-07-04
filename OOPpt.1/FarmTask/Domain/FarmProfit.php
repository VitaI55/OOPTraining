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
            $profTransport = [];

            if ($farm->getCornBalance() <= 1000) {

                foreach ($transport as $index => $tr) {
                    $profTransport[$index] = $tr->paymentForDeliver($farm->getCornBalance());
                }

                $topTransport = array_search(max($profTransport), $profTransport);
                $this->acceptedTransport[] = $transport[$topTransport];

                return $transport[$topTransport];

            } else {

                foreach ($transport as $index => $tr) {
                    $profTransport[$index] = $tr->paymentForDeliverMax();
                }

                $topTransport = array_search(max($profTransport), $profTransport);
                $this->acceptedTransport[] = $transport[$topTransport];

                return $transport[$topTransport];
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