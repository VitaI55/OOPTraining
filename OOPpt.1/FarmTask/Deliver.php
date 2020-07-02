<?php

interface Deliver
{
    function doShipping(int $farmMoney, int $farmCorn): int;

    function paymentForDeliver(): int;

    function paymentForDeliverMax(): int;

    function isDelivering(int $farmMoney);

    function getDeliverTime(): int;

    function getName(): string;
}