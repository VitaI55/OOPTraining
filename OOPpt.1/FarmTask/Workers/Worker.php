<?php

abstract class Worker
{
    abstract function work(int $farmMoney, int $farmCorn): array;
}