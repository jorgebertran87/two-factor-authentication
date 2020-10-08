<?php

declare(strict_types=1);

namespace App\Authenticator\Application;

use ReflectionClass;
use Symfony\Component\DependencyInjection\ContainerInterface;

class QueryBus
{
    private ContainerInterface $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /** @return mixed*/
    public function handle($query)
    {
        $handlerClassName = (new ReflectionClass($query))->getShortName();
        $handlerClass = $handlerClassName.'Handler';
        $handler = $this->container->get($handlerClass);
        return $handler->handle($query);
    }
}
