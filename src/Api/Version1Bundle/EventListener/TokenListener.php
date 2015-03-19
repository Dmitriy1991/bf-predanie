<?php

namespace Api\Version1Bundle\EventListener;

use Api\Version1Bundle\Controller\TokenAuthenticatedController;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\DependencyInjection\ContainerInterface;

class TokenListener
{
    protected $container;

    public function __construct(ContainerInterface $container) // this is @service_container
    {
        $this->container = $container;
    }

    public function onKernelController(FilterControllerEvent $event) {
        $controller = $event->getController();

        if (!is_array($controller)) {
            return;
        }

        if ($controller[0] instanceof TokenAuthenticatedController) {
            $request = Request::createFromGlobals();

            $sPHPSESSID = $request->cookies->get('PHPSESSID');

            $sAuthToken = $this->container->get('session')->get('auth_token');

            if ( empty( $sAuthToken ) ) {
                throw new HttpException(400, 'This action needs a valid token');
            }

            if ( $sAuthToken != md5( $sPHPSESSID ) ) {
                throw new HttpException(400, 'This action needs a valid token');
            }
        }
    }
}