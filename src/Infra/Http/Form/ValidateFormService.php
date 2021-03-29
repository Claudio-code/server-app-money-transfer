<?php

namespace App\Infra\Http\Form;

use Symfony\Component\Form\FormInterface;

class ValidateFormService
{
    public static function validate(FormInterface $form): void
    {
        if ($form->isValid()) {
            return;
        }

        $message = '';
        $errors = $form->getErrors(true, true);
        foreach ($errors as $error) {
            if ($error->getOrigin() === null) {
                continue;
            }

            $message .= ', ' . sprintf(
                '%s: %s',
                $error->getOrigin()->getConfig()->getOption('label') ?:
                    $error->getOrigin()->getName(),
                $error->getMessage()
            );
        }

        throw FormException::jsonRequestContentError($message);
    }
}
