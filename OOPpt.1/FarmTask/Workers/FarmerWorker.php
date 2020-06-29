<?php

class FarmerWorker extends Worker
{
    public function work(int $farmMoney, int $farmCorn): array
    {
        if ($farmMoney >= 5) {
            $params['payedSalary'] = $farmMoney - 5;
            $params['earnedCorn'] = $farmCorn + mt_rand(10, 30);
            return $params;
        }

        return ['payedSalary' => $farmMoney, 'earnedCorn' => $farmCorn];
    }
}