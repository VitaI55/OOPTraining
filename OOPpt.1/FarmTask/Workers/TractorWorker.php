<?php

class TractorWorker extends Worker
{
    public function work(int $farmMoney, int $farmCorn): array
    {
        if ($farmMoney >= 200) {
            $params['payedSalary'] = $farmMoney - 200;
            $params['earnedCorn'] = $farmCorn + mt_rand(350, 500);
            return $params;
        }

        return ['payedSalary' => $farmMoney, 'earnedCorn' => $farmCorn];
    }
}