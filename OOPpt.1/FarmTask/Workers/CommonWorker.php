<?php

class CommonWorker extends Worker
{
    public function work(Farm $farm): void
    {
        if ($farm->moneyBalance >= 1) {
            $farm->moneyBalance -= 1;
            $farm->cornBalance += mt_rand(5, 10);
        }
    }
}