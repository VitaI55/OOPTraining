<?php

class CommonWorker extends Worker
{
    public function getSalary(): int
    {
        return $this->salary;
    }

    public function earnCorn(): int
    {
        return mt_rand(5, 10);
    }
}