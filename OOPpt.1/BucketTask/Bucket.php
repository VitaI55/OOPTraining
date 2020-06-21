<?php

include_once('View/ConsoleViewImlp.php');
include_once('View/View.php');
include_once('View/HtmlViewImpl.php');


class Cart
{
    public array $products = [];
    public float $tax = 0.10;
    public array $check = [];
    public array $qtyProd = [];
    private View $interpreter;


    public function __construct(View $interpreter)
    {
        $this->interpreter = $interpreter;
    }

    public function addProduct(Product $product): bool
    {
        foreach ($this->products as $index => $prod) {
            if ($product === $prod) {
                $this->qtyProd[$index][$product->getId()] += 1;
                return true;
            }
        }
        $this->products[] = $product;
        $this->qtyProd[] = [$product->getId() => 1];
        return true;
    }

    public function removeProductById($id): void
    {
        foreach ($this->products as $index => $product) {
            if ($id === $product->getId()) {
                unset($this->products[$index]);
                unset($this->qtyProd[$index]);
                break;
            }
        }
    }

    public function changeQty(int $id, int $newCapacity): void
    {
        foreach ($this->products as $index => $product) {
            if ($id === $product->getId()) {
                $this->qtyProd[$index][$id] = $newCapacity;
            }
        }
    }

    public function calculateSum(): float
    {
        $sum = 0;
        foreach ($this->products as $index => $product) {
            $sum += $this->qtyProd[$index][$product->getId()] * $product->getPrice();
        }
        return $sum;
    }

    public function qtyAllProd(): array
    {
        $sum = 0;
        $this->products[] = ['Stop'];

        foreach ($this->products as $index => $product) {
            if (!$this->products[$index] instanceof Product) {
                return $this->check;
            }
            if ($this->products[$index] === $product) {
                $count = $this->qtyProd[$index][$product->getId()];
                $sum += $count * $product->getPrice();
                $prodName = $product->getName();
                if (next($this->products) !== $product) {
                    $this->check[] = [$prodName . ' x' . $count
                        . ' ' . (floatval($sum) + 0.01) . "$"];
                    $sum = 0;
                }

            }
        }
        return $this->check;
    }

    public function printCheck(): string
    {
        $str = '';
        if ($this->interpreter instanceof ConsoleViewImlp) {
            foreach ($this->qtyAllProd() as $prod) {
                $str .= $prod[0] . "\n";
            }
        } else if ($this->interpreter instanceof HtmlViewImpl) {
            foreach ($this->qtyAllProd() as $prod) {
                $str .= $prod[0] . "<br>";
            }
        }
        return $str;
    }

    public function payForProducts()
    {
        $dt = date('m.d.Y h:i:s ');
        $sum = floatval($this->calculateSum()) + 0.01;
        $tax = floatval($sum * $this->tax);
        $check = $this->printCheck();
        $fine = $sum - $tax;
        $parameters[] = ['date' => $dt,
            'total' => $sum,
            'tax' => $tax,
            'check' => $check,
            'toPay' => $fine];
        return $this->interpreter->print($parameters);
    }

}


class Product
{
    private string $name;
    private float $price;
    private int $id;

    public function getId(): int
    {
        return $this->id;
    }


    function __construct(int $id, string $name, float $price)
    {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
    }

    public function getName(): string
    {
        return $this->name;
    }


    public function getPrice(): float
    {
        return $this->price;
    }

}

$interpreter = new ConsoleViewImlp();
//$interpreter = new HtmlViewImpl();
$cart = new Cart($interpreter);
$milka = new Product(1, 'Milka', 4.50);
$chockolate = new Product(2, 'Chock', 5.50);
$mamaYuri = new Product(3, 'Tamara', 0.50);
$cart->addProduct($milka);
$cart->addProduct($chockolate);
$cart->addProduct($mamaYuri);
$cart->addProduct($milka);
$cart->changeQty(3, 7);
$cart->removeProductById(3);
echo $cart->payForProducts();
