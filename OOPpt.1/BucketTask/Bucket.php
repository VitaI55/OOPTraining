<?php

include_once('ConsoleViewImlp.php');
include_once('View.php');
include_once('HtmlViewImpl.php');


class Cart
{
    private array $products = [];
    public float $tax = 0.10;
    private array $check = [];
    private View $interpreter;

    public function __construct(View $interpreter)
    {
        $this->interpreter = $interpreter;
    }

    public function addProduct(Product $product): void
    {
        $this->products[] = $product;
    }

    public function removeProductById($id): void
    {
        foreach ($this->products as $index => $product) {
            if ($id === $product->getId()) {
                unset($this->products[$index]);
                break;
            }
        }
    }

    public function getProductById(int $id): Product
    {
        foreach ($this->products as $product) {
            if ($id === $product->getId()) {
                return $product;
                break;
            }
        }
    }

    public function changeQty(int $id, int $newCapacity): void
    {
        $count = 0;
        foreach ($this->products as $index => $product) {
            if ($id === $product->getId()) {
                $count++;
            }
        }

        if ($newCapacity > $count) {
            for ($i = $count; $i <= $newCapacity; $i++) {
                $this->addProduct($this->getProductById($id));
            }
            $this->removeProductById($id);
        } else if ($newCapacity < $count) {
            $cou = $count - $newCapacity;
            foreach ($this->products as $index => $product) {
                if ($cou === 0) {
                    break;
                }
                if ($id === $product->getId()) {
                    unset($this->products[$index]);
                    $cou--;
                }
            }
        }
    }

    public function calculateSum(): float
    {
        $sum = 0;
        foreach ($this->products as $item) {
            $sum += $item->getPrice();
        }
        return $sum;
    }

    public function qtyAllProd(): array
    {
        $count = 0;
        $sum = 0;
        $this->products[] = ['Stop'];

        foreach ($this->products as $index => $product) {
            if (!$this->products[$index] instanceof Product) {
                return $this->check;
            }
            if ($this->products[$index] === $product) {
                $count++;
                $sum += $product->getPrice();
                $prodName = $product->getName();
                if (next($this->products) !== $product) {
                    $this->check[] = [$prodName . ' x' . "$count" . ' ' . (floatval($sum) + 0.01) . "$"];
                    $count = 0;
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
        $check1 = $this->qtyAllProd();
        $parameters[] = ['date' => $dt,
            'total' => $sum,
            'tax' => $tax,
            'check' => $check,
            'toPay' => $fine,
            'check1' => $check1];
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
        $this->name = $name;
        $this->price = $price;
        $this->id = $id;
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

//  $interpreter = new ConsoleViewImlp();
$interpreter = new HtmlViewImpl();
$cart = new Cart($interpreter);
$milka = new Product(1, 'Milka', 4.50);
$chockolate = new Product(2, 'Chock', 5.50);
$mamaYuri = new Product(3, 'Tamara', 0.50);
$cart->addProduct($milka);
$cart->addProduct($milka);
$cart->addProduct($milka);
$cart->addProduct($chockolate);
$cart->addProduct($mamaYuri);
$cart->changeQty(1, 2);
$cart->changeQty(2, 4);
$cart->changeQty(3, 10);
$cart->changeQty(3, 3);
echo $cart->payForProducts();