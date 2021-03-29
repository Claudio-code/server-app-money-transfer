<?php

namespace App\Infra\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class RequestSubscriber implements EventSubscriberInterface
{
    public function onRequestEvent(RequestEvent $event): void
    {
        if ($event->isMasterRequest() === false) {
            return;
        }

        $request = $event->getRequest();
        if ($request->getContentType() !== 'json') {
            return;
        }

        $json = json_decode($request->getContent(), true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new BadRequestHttpException('Falha ao interpretar JSON: ' . json_last_error_msg());
        }

        $request->request->add($json);
    }

    public static function getSubscribedEvents()
    {
        return [
            RequestEvent::class => 'onRequestEvent',
        ];
    }
}
