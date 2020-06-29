<?php
include_once('includes.php');

$sek = 0;
$workers = [new TractorWorker(), new FarmerWorker(), new CommonWorker()];
$transport = null;
$garage = [];
$farm = new Farm(300, 0);
$exc = new Exchange(1, 15);
$farmProfit = new FarmProfit($farm, $exc);

while (true) {
    sleep(1);
    if (!empty($garage)) {
        $farm->checkDeliver($garage);
        unset($garage[$farmProfit->cleanGarage($garage)]);
    }
    $farm->payWorker($workers);
    $params = $exc->generateAll();
    $transport = $farmProfit->ifProfitable($params);
    if ($transport !== null) {
        array_push($garage, $transport);
    }
    print_r($garage);
    $sek++;
    echo 'money:' . $farm->getMoneyBalance() . "\n";
    echo 'corn:' . $farm->getCornBalance() . "\n";
    echo 'Seconds:' . $sek . "\n";
}
