<?php
include_once('View.php');

class ConsoleViewImlp implements View
{

    function print(array $params): string
    {
        $var = $params[0];
        $str = '';
        foreach ($var['check'] as $cartProd) {
            $str .= $cartProd->product->getName()
                . ' ' . $cartProd->getQty() . 'x'
                . ' ' . $cartProd->getRowPrice()
                . '$' . "\n";
        }
        return '-----Check-----' . "\n"
            . 'Data: ' . $var['date'] . "\n"
            . '----Products----' . "\n"
            . '' . $str . "\n"
            . 'Total:  ' . $var['total'] . "$" . "\n"
            . 'Tax:    ' . $var['tax'] . "$" . "\n"
            . 'To pay: ' . $var['toPay'] . "$";

    }
}