<?php

namespace App\Infra\Exceptions;

trait ExceptionFormatTrait
{
    /** @return mixed[] */
    private function formatException(\Throwable $exception): array
    {
        $plus = [];
        if (!is_null($exception->getPrevious())) {
            $plus = [
                'previews' => $this->exceptionToArray(
                    $exception->getPrevious()
                )
            ];
        }

        $message = [
            'type' => $exception::class,
            'error' => $exception->getMessage(),
            'file' => $exception->getFile(),
            'line' => $exception->getLine(),
        ];

        return [...$message, ...$plus];
    }

    /** @return mixed[] */
    private function exceptionToArray(\Throwable $exception): array
    {
        return [
            'type' => $exception::class,
            'exception' => $exception,
            'message' => $exception->getMessage(),
        ];
    }
}
