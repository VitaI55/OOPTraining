<?php
include_once('View.php');

class HtmlViewImpl implements View
{

    function print(array $params)
    {
        $var = $params[0];
        return "<div><div>-----Check-----</div><br> 
             <div>Date: ${var['date']}</div> <br>
        <div>----Products----</div> <br>
    <div><span>${var['check']}</span></div> <br>
       <div>Total: ${var['total']}$</div> <br>
        <div> Tax: ${var['tax']}$</div> <br>
     <div> To pay: ${var['toPay']}$</div> </div>";
    }
}

