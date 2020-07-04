<?php

abstract class Worker
{
    protected int $salary;

    /**
     * Worker constructor.
     * @param int $salary
     */
    public function __construct(int $salary)
    {
        $this->salary = $salary;
    }

    abstract function getSalary(): int;

    abstract function earnCorn(): int;
}