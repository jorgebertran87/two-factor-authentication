<?php
declare(strict_types=1);

namespace Authenticator\Application;

class QueryBus extends MessageBus
{
    /** @return mixed */
    public function handle($query)
    {
        $handlerClass = get_class($query) . 'Handler';
        $handler = $this->container->get($handlerClass);
        return $handler->handle($query);
    }
}
