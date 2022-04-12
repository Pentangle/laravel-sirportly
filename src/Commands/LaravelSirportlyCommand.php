<?php

namespace Pentangle\LaravelSirportly\Commands;

use Illuminate\Console\Command;

class LaravelSirportlyCommand extends Command
{
    public $signature = 'laravel-sirportly';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
