<?php

namespace App\Controller\MoneyTransfer;

use App\Infra\Http\Form\ValidateFormService;
use App\MoneyTransfer\Transfer\TransferFeature;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class Controller extends AbstractController
{
    /** @Route("/transfer/", methods={"POST"}) */
    public function __invoke(
        Request $request,
        TransferFeature $transferFeature,
    ): Response {
        $form = $this->createForm(FormType::class);
        $form->submit($request->request->all());
        ValidateFormService::validate($form);

        $transferFeature->execute($form->getData());
        return new Response();
    }
}
