<?php

class FarmerWorker extends Worker
{
    public function work(Farm $farm): void
    {
        if ($farm->moneyBalance >= 5) {
            $farm->moneyBalance -= 5;
            $farm->cornBalance += mt_rand(10, 30);
        }
    }
}