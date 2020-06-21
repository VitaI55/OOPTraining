<?php
include_once('Bucket.php');

class ProductInCart
{
    public int $qty;
    public Product $product;

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

    public function getQty()
    {
        return $this->qty;
    }

    public function getRowPrice(): float
    {
        return $this->qty * $this->product->getPrice();
    }
}