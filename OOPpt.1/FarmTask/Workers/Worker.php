<?php

abstract class Worker
{
    abstract function getSalary(int $farmMoney): int;

    abstract function earnCorn(int $farmCorn): int;
}