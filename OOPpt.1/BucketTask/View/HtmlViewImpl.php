<?php

class HtmlViewImpl implements View
{
    function print(array $params): string
    {
        $productsContent = '';

        foreach ($params['products'] as $cartProd) {
            $productsContent .= $cartProd->getProduct()->getName()
                . ' ' . $cartProd->getQty() . 'x'
                . ' ' . $cartProd->getRowPrice()
                . '$' . "<br>";
        }

        return "<div>
                <div>-----Check-----</div> 
                <div>Date: ${params['date']}</div>
                <div>----Products----</div>
                <div>${productsContent}</div> <br>
                <div>Total: ${params['total']}$</div>
                <div> Tax: ${params['tax']}$</div>
                <div> To pay: ${params['toPay']}$</div>
                </div>";
    }
}

