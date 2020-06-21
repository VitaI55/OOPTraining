<?php
include_once('View.php');

class ConsoleViewImlp implements View
{
    function print(array $params): string
    {
        $productsContent = '';

        foreach ($params['check'] as $cartProd) {
            $productsContent .= $cartProd->getProduct()->getName()
                . ' ' . $cartProd->getQty() . 'x'
                . ' ' . $cartProd->getRowPrice()
                . '$' . "\n";
        }

        return '-----Check-----' . "\n"
            . 'Data: ' . $params['date'] . "\n"
            . '----Products----' . "\n"
            . '' . $productsContent . "\n"
            . 'Total:  ' . $params['total'] . "$" . "\n"
            . 'Tax:    ' . $params['tax'] . "$" . "\n"
            . 'To pay: ' . $params['toPay'] . "$";
    }
}