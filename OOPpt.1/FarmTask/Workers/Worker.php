<?php

abstract class Worker
{
    abstract function work(Farm $farm): void;
}