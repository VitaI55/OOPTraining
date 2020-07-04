<?php

interface Deliver
{
    function doShipping(int $farmMoney, int $farmCorn): int;

    function paymentForDeliver(int $difference): int;

    function paymentForDeliverMax(): int;

    function isDelivering(int $farmMoney);

    function getDeliverTime(): int;
}