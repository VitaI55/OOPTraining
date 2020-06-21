<?php

class HtmlViewImpl implements View
{
    function print(array $params): string
    {
        $productPrice = '';
        foreach ($params['check'] as $cartProd) {
            $productPrice .= $cartProd->getProduct()->getName()
                . ' ' . $cartProd->getQty() . 'x'
                . ' ' . $cartProd->getRowPrice()
                . '$' . "<br>";
        }

        return "<div><div>-----Check-----</div> 
                <div>Date: ${params['date']}</div>
                <div>----Products----</div>
                <div>${productPrice}</div> <br>
                <div>Total: ${params['total']}$</div>
                <div> Tax: ${params['tax']}$</div>
                <div> To pay: ${params['toPay']}$</div> </div>";
    }
}

