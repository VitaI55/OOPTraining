<?php

include_once('View/ConsoleViewImlp.php');
include_once('View/View.php');
include_once('View/HtmlViewImpl.php');
include_once('ProductInCart.php');

class Cart
{
    /**
     * @var ProductInCart[]
     */
    private array $products = [];
    private float $tax = 0.10;
    private View $checkView;

    /**
     * @return ProductInCart[]
     */
    public function getProducts(): array
    {
        return $this->products;
    }

    public function __construct(View $checkView)
    {
        $this->checkView = $checkView;
    }

    public function addProduct(Product $product): void
    {
        if (isset($this->products[$product->getId()])) {
            $this->products[$product->getId()]->increaseQty();
        } else {
            $this->products[$product->getId()] = new ProductInCart($product);
        }
    }

    public function removeProductById($id): void
    {
        unset($this->products[$id]);
    }

    public function updateQtyByProductId(int $id, int $newQty): void
    {
        $this->products[$id]->setQty($newQty);
    }

    public function getTotalPrice(): float
    {
        $sum = 0;

        foreach ($this->products as $cartProd) {
            $sum += $cartProd->getRowPrice();
        }

        return $sum;
    }

    public function tax(): float
    {
        return $this->getTotalPrice() * $this->tax;
    }

    public function toPay(): float
    {
        return $this->getTotalPrice() - $this->tax();
    }

    public function payForProducts(): string
    {
        return $this->checkView->print([
            'date' => date('m.d.Y h:i:s '),
            'total' => $this->getTotalPrice(),
            'tax' => $this->tax(),
            'check' => $this->products,
            'toPay' => $this->toPay()
        ]);
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
$cart->addProduct($milka);
$cart->addProduct($milka);
$cart->addProduct($chockolate);
$cart->addProduct($mamaYuri);
$cart->updateQtyByProductId(1, 3);
echo $cart->payForProducts();
