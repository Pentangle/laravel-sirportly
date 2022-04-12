<?php

namespace Pentangle\LaravelSirportly\Facades;

use Illuminate\Support\Facades\Facade;

/**
 *
 * @see \Pentangle\LaravelSirportly\LaravelSirportly
 */
class LaravelSirportly extends Facade
{
    protected static function getFacadeAccessor():string
    {
        return \Pentangle\LaravelSirportly\LaravelSirportly::class;
    }
}
