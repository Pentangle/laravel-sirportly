<?php

// register the helper called sirportly
if (! function_exists('sirportly')) {
    function sirportly(): Pentangle\LaravelSirportly\LaravelSirportly
    {
        return app('sirportly');
    }
}