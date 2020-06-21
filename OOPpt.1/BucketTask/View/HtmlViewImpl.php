<?php

class HtmlViewImpl implements View
{

    function print(array $params)
    {
        $var = $params[0];
        $str = '';
        foreach ($var['check'] as $cartProd) {
            $str .= $cartProd->product->getName()
                . ' ' . $cartProd->getQty() . 'x'
                . ' ' . $cartProd->getRowPrice()
                . '$' . "<br>";
        }
        return "<div><div>-----Check-----</div> 
                <div>Date: ${var['date']}</div>
                <div>----Products----</div>
                <div>${str}</div> <br>
                <div>Total: ${var['total']}$</div>
                <div> Tax: ${var['tax']}$</div>
                <div> To pay: ${var['toPay']}$</div> </div>";
    }
}

