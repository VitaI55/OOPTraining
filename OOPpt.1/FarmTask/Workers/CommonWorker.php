<?php

class CommonWorker extends Worker
{
    public function work(int $farmMoney, int $farmCorn): array
    {
        if ($farmMoney >= 1) {
            $params['payedSalary'] = $farmMoney - 1;
            $params['earnedCorn'] = $farmCorn + mt_rand(5, 10);
            return $params;
        }

        return ['payedSalary' => $farmMoney, 'earnedCorn' => $farmCorn];
    }
}