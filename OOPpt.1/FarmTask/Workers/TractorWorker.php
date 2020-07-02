<?php

class TractorWorker extends Worker
{
    public function getSalary(int $farmMoney): int
    {
        if ($farmMoney >= 200) {
            return $farmMoney - 200;
        }

        return $farmMoney;
    }

    public function earnCorn(int $farmCorn): int
    {
        return $farmCorn + mt_rand(350, 500);
    }
}