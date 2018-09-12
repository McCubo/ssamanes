<?php

namespace App\EventListener;

use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpFoundation\RedirectResponse;

class RequestListener {
    private $router;
    private $container;

    public function __construct ($router, $container) {
        $this->router = $router;
        $this->container = $container;
    }

    public function onKernelRequest (GetResponseEvent $event) {
        $request = $event->getRequest()->getRequestUri();
        if ($request == '/' && $event->isMasterRequest() && $this->container->get(
                'security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            $url = $this->router->generate('homepage');
            $event->setResponse(new RedirectResponse($url));
        }
    }
}