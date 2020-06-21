<?php
include_once('Bucket.php');

class ProductInCart
{
    private int $qty;
    private Product $product;

    public function increaseQty(): void
    {
        $this->qty += 1;
    }

    public function getProduct(): Product
    {
        return $this->product;
    }

    function __construct(Product $prod)
    {
        $this->product = $prod;
        $this->qty = 1;
    }

    public function setQty(int $qty): void
    {
        $this->qty = $qty;
    }

    public function getQty(): int
    {
        return $this->qty;
    }

    public function getRowPrice(): float
    {
        return $this->qty * $this->product->getPrice();
    }
}