<?php

namespace App\Controller;

use App\Authenticator\Application\QueryBus;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\ContainerInterface;

abstract class BaseController extends AbstractController {
    protected QueryBus $bus;

    public function __construct(QueryBus $bus) {
        $this->bus = $bus;
    }

}
