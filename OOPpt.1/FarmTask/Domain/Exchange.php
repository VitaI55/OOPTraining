<?php

class Exchange
{
    private int $maxPrice;
    private int $minPrice;

    public function getMaxPrice(): int
    {
        return $this->maxPrice;
    }

    public function __construct(int $minPrice, int $maxPrice)
    {
        $this->minPrice = $minPrice;
        $this->maxPrice = $maxPrice;
    }

    public function generateAll(): array
    {
        return $params = [
            'price' => $this->generatePrice(),
            'transport' => $this->generateTransport()
        ];
    }

    public function generatePrice(): int
    {
        if (mt_rand(1, 10) > 5) {
            $price = $this->maxPrice;
        } else {
            $price = $this->minPrice;
        }

        return $price;
    }

    public function generateTransport(): array
    {
        $rand = mt_rand(1, 50);
        if ($rand > 25) {
            $transport['truck'] = new TruckDeliverImpl();
            if ($rand < 40) {
                $transport['plane'] = new PlaneDeliverImpl();
                if ($rand > 30) {
                    $transport['train'] = new TrainDeliverImpl();
                }
            }
        } else if ($rand <= 25) {
            $transport['train'] = new TrainDeliverImpl();
            if ($rand > 15) {
                $transport['truck'] = new TruckDeliverImpl();
                if ($rand > 20) {
                    $transport['plane'] = new PlaneDeliverImpl();
                }
            }
        }

        return $transport;
    }
}