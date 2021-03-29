<?php

namespace App\Controller\MoneyTransfer;

use App\Infra\Http\Form\ValidateFormService;
use App\MoneyTransfer\Transfer\TransferFeature;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Annotations as OA;

/**
 * @OA\Post (
 *     path="/transfer/",
 *     description="rota de transferencia de dinheiro entre os usuarios.",
 *     @OA\RequestBody(ref="#/components/requestBodies/MoneyTransferDTO"),
 *     @OA\Response(
 *        response="200",
 *        description="dinheiro transferido"
 *     ),
 *     @OA\Response(
 *         response="400",
 *          description="Erro dinheiro insuficiente.",
 *         @OA\JsonContent(
 *              @OA\Property(type="string", property="type", default="App\\MoneyTransfer\\Wallet\\InsufficientMoneyTransferException"),
 *              @OA\Property(type="string", property="error", default="Dinheiro insuficiente para fazer a transferencia."),
 *              @OA\Property(type="string", property="file", default="/var/www/src/MoneyTransfer/Wallet/InsufficientMoneyTransferException.php"),
 *              @OA\Property(type="int", property="line", default=11),
 *         )
 *     )
 * )
 */
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
