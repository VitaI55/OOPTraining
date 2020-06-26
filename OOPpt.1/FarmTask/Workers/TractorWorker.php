<?php

class TractorWorker extends Worker
{
    public function work(Farm $farm): void
    {
        if ($farm->moneyBalance >= 200) {
            $farm->moneyBalance -= 200;
            $farm->cornBalance += mt_rand(350, 500);
        }
    }
}