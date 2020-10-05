<?php

namespace App\Command;

use App\Authenticator\Application\QueryBus;
use Symfony\Component\Console\Command\Command;


abstract class AbstractCommand extends Command
{
    protected QueryBus $bus;

    public function __construct(QueryBus $bus)
    {
        $this->bus = $bus;

        parent::__construct();
    }
}
