<?php

class CommonWorker extends Worker
{
    public function getSalary(int $farmMoney): int
    {
        if ($farmMoney >= 1) {
            return $farmMoney - 1;
        }

        return $farmMoney;
    }

    public function earnCorn(int $farmCorn): int
    {
        return $farmCorn + mt_rand(5, 10);
    }
}