<?php
include_once('View.php');

class ConsoleViewImlp implements View
{

    function print(array $params): string
    {
        $var = $params[0];
        return '-----Check-----' . "\n"
            . 'Data: ' . $var['date'] . "\n"
            . '----Products----' . "\n"
            . '' . $var['check'] . "\n"
            . 'Total:  ' . $var['total'] . "$" . "\n"
            . 'Tax:    ' . $var['tax'] . "$" . "\n"
            . 'To pay: ' . $var['toPay'] . "$";

    }
}