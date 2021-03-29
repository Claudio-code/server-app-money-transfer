<?php

namespace App\Infra\EventSubscriber;

use App\Infra\Exceptions\ExceptionFormatTrait;
use App\Infra\Exceptions\MoneyTransferException;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\Security\Core\Exception\AuthenticationException;

class ExceptionSubscriber implements EventSubscriberInterface
{
    use ExceptionFormatTrait;

    private UrlGeneratorInterface $urlGenerator;
    private FlashBagInterface $flashBag;

    public function __construct(UrlGeneratorInterface $urlGenerator)
    {
        $this->urlGenerator = $urlGenerator;
    }

    /** @return array<string, array<string, int>> */
    public static function getSubscribedEvents(): array
    {
        return ['kernel.exception' => ['onKernelException', 255]];
    }

    public function onKernelException(ExceptionEvent $event): void
    {
        if (preg_match('/^\/(_(profiler|wdt)|css|images|js|assets)/', $event->getRequest()->getPathInfo())) {
            return;
        }

        $exception = $event->getThrowable();
        if (!$this->verifyAsJson($event->getRequest())) {
            return;
        }

        $event->setResponse($this->formatAndReturJson($exception));
    }

    private function verifyAsJson(Request $request): bool
    {
        return (
            str_contains($request->headers->get('accept', ''), 'application/json') ||
            $request->getRequestFormat() == 'json' ||
            str_starts_with($request->getRequestUri(), '/api/doc')
        );
    }

    private function formatAndReturJson(
        \Throwable $exception,
        int $status = JsonResponse::HTTP_BAD_REQUEST
    ): JsonResponse {
        $headers = [];
        $genericError = [];
        if ($exception instanceof HttpExceptionInterface) {
            $headers = $exception->getHeaders();
            $status = $exception->getStatusCode();
            $genericError = [
                'status' => $exception->getStatusCode(),
                'error' => $exception->getMessage(),
            ];
        }

        if ($exception instanceof MoneyTransferException) {
            return new JsonResponse([
                'type' => $exception::class,
                'error' => $exception->getMessage(),
                'file' => $exception->getFile(),
                'line' => $exception->getLine(),
            ], $status, $headers);
        }

        if (!($exception instanceof HttpExceptionInterface)) {
            $genericError = [
                'status' => JsonResponse::HTTP_INTERNAL_SERVER_ERROR,
                'error' => 'Aconteceu um erro inesperado.',
                'error' => $exception->getMessage(),
                'type' => $exception::class,
                'file' => $exception->getFile(),
                'line' => $exception->getLine(),
            ];
        }

        if ($exception instanceof AuthenticationException) {
            $genericError = [
                'status' => JsonResponse::HTTP_UNAUTHORIZED,
                'error' => strtr($exception->getMessageKey(), $exception->getMessageData()),
                'type' => $exception::class,
                'file' => $exception->getFile(),
                'line' => $exception->getLine(),
            ];
        }

        return new JsonResponse($genericError, $genericError['status'], $headers);
    }
}
