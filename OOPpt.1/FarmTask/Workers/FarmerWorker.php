<?php

class FarmerWorker extends Worker
{
    public function getSalary(): int
    {
        return $this->salary;
    }

    public function earnCorn(): int
    {
        return mt_rand(10, 30);
    }
}