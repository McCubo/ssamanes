<?php

namespace App\EventListener;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use App\Entity\ApplicationLog;

class ExceptionListener {

    private $doctrine;

    public function __construct (EntityManagerInterface $doctrine) {
        $this->doctrine = $doctrine;
    }

    public function onKernelException (GetResponseForExceptionEvent $event) {
        $exception = $event->getException();
        $appLog = new ApplicationLog();

        $appLog->setEventName("Exception Fatal Error")
            ->setEventMessage($exception->getMessage())
            ->setEventCode($exception->getCode())
            ->setEventIP($event->getRequest()->getClientIp())
            ->setEventPath($event->getRequest()->getPathInfo())
            ->setEventMethod($event->getRequest()->getMethod());
        $this->doctrine->persist($appLog);
        $this->doctrine->flush();
    }
}