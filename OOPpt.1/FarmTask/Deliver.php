<?php

interface Deliver
{
    function doShipping(Farm $farm): void;

    function paymentForDeliverMin(Farm $farm): int;

    function paymentForDeliverMax(Farm $farm): int;

    function isDelivering(Farm $farm): void;

    function getDeliverTime(): int;

    function getDifference(): int;
}