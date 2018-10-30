<?php

namespace App\EventListener;

use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpFoundation\RedirectResponse;

class RequestListener {
    private $router;
    private $authChecker;

    public function __construct ($router, $authChecker) {
        $this->router = $router;
        $this->authChecker = $authChecker;
    }

    public function onKernelRequest (GetResponseEvent $event) {
        $request = $event->getRequest()->getRequestUri();
        if ($request == '/' && $event->isMasterRequest() && 
                ($this->authChecker->isGranted('IS_AUTHENTICATED_FULLY') || $this->authChecker->isGranted('IS_AUTHENTICATED_REMEMBERED'))
                ) {
            $url = $this->router->generate('homepage');
            $event->setResponse(new RedirectResponse($url));
        }
    }
}