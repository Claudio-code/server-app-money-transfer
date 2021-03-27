<?php

namespace App\Controller\User\Create;

use App\Infra\Http\Form\ValidateFormService;
use App\MoneyTransfer\User\Create\CreateFeature;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/** @Route("/user/", methods={"POST"}) */
class Controller extends AbstractController
{
    public function __invoke(
        Request $request,
        CreateFeature $feature,
    ): JsonResponse {
        $form = $this->createForm(FormType::class);
        $form->submit($request->request->all());
        ValidateFormService::validate($form);

        return $this->json(
            $feature->execute($form->getData()),
            201
        );
    }
}
