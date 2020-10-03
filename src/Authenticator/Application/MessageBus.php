<?php
declare(strict_types=1);

namespace Authenticator\Application;

use DI\ContainerBuilder;

abstract class MessageBus
{
    protected $container;

    public function __construct()
    {
        $builder = new ContainerBuilder();
        $builder->useAutowiring(true);
        $builder->useAnnotations(false);

        $this->container = $builder->build();

        $this->enableDI();
    }

    protected function enableDI(): void
    {
        /*$this->container->set(
            AdRepository::class,
            new InMemoryAdRepository()
        );*/
    }
}
