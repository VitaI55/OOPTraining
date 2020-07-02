<?php

class FarmerWorker extends Worker
{
    public function getSalary(int $farmMoney): int
    {
        if ($farmMoney >= 5) {
            return $farmMoney - 5;
        }

        return $farmMoney;
    }

    public function earnCorn(int $farmCorn): int
    {
        return $farmCorn + mt_rand(10, 30);
    }
}