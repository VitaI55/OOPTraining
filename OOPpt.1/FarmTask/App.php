<?php
include_once('includes.php');

$sek = 0;
$transport = null;
$exc = new Exchange(1, 15);
$farmProfit = new FarmProfit($exc);
$farm = new Farm(300, 0, $farmProfit);
$common = new CommonWorker(1);
$traktor = new TractorWorker(200);
$farmer = new FarmerWorker(5);
$farm->acceptWorker($common);
$farm->acceptWorker($farmer);
$farm->acceptWorker($traktor);

while (true) {
    sleep(1);
    if (!empty($farmProfit->getAcceptedTransport())) {
        $farm->checkDeliver();
        $farmProfit->cleanGarage();
    }

    $farm->payWorkers();
    $price = $exc->generatePrice();
    $transport = $exc->generateTransport();

    $farm->sellCorn($price, $transport);


//for checking mistakes etc...
    print_r($farmProfit->getAcceptedTransport());
    $sek++;
    echo 'money:' . $farm->getMoneyBalance() . "\n";
    echo 'corn:' . $farm->getCornBalance() . "\n";
    echo 'Seconds:' . $sek . "\n";
}
