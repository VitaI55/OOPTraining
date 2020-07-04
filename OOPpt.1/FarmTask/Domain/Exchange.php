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

    public function generatePrice(): int
    {
        if (mt_rand(1, 10) > 5) {
            $price = $this->minPrice;
        } else {
            $price = $this->maxPrice;
        }

        return $price;
    }

    public function generateTransport(): array
    {
        $transport = [
            new TruckDeliver($this->maxPrice),
            new PlaneDeliver($this->maxPrice),
            new TrainDeliver($this->maxPrice)
        ];
        shuffle($transport);
        $rand = mt_rand(1, count($transport));

        return array_slice($transport, 0, $rand);
    }
}