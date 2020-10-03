<?php
declare(strict_types=1);

namespace Authenticator\Application;

class CommandBus extends MessageBus
{
    public function handle($command): void
    {
        $handlerClass = get_class($command) . 'Handler';
        $handler = $this->container->get($handlerClass);
        $handler->handle($command);
    }
}
