<?php

declare(strict_types=1);

namespace App\Search\Application;

interface QueryHandler
{
    /**
     * @param mixed $query
     * @return mixed
     */
    public function handle($query);
}
