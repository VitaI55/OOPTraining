<?php
include_once('View.php');

class ConsoleViewImlp implements View
{
    function print(array $params): string
    {
        $productPrice = '';
        foreach ($params['check'] as $cartProd) {
            $productPrice .= $cartProd->getProduct()->getName()
                . ' ' . $cartProd->getQty() . 'x'
                . ' ' . $cartProd->getRowPrice()
                . '$' . "\n";
        }

        return '-----Check-----' . "\n"
            . 'Data: ' . $params['date'] . "\n"
            . '----Products----' . "\n"
            . '' . $productPrice . "\n"
            . 'Total:  ' . $params['total'] . "$" . "\n"
            . 'Tax:    ' . $params['tax'] . "$" . "\n"
            . 'To pay: ' . $params['toPay'] . "$";
    }
}