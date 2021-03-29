<?php

namespace App\Controller\User\Create;

use App\Infra\Http\Form\ValidateFormService;
use App\MoneyTransfer\User\Create\CreateFeature;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Annotations as OA;

/**
 * @OA\Post (
 *     path="/user/",
 *     description="Cadastro de novos usuarios.",
 *     @OA\RequestBody(ref="#/components/requestBodies/CreateUserDTO"),
 *     @OA\Response(
 *        response="201",
 *        description="criação de usuario",
 *        @OA\JsonContent(
 *           type="array",
 *           @OA\Items(ref="#/components/schemas/User")
 *        ),
 *     ),
 *     @OA\Response(
 *         response="400",
 *          description="Erro de usuario já existente na base.",
 *         @OA\JsonContent(
 *              @OA\Property(type="string", property="type", default="App\\MoneyTransfer\\User\\Create\\UserAlreadyExistsException"),
 *              @OA\Property(type="string", property="error", default="o usuario do cpf 02305232924 já existe no sistema."),
 *              @OA\Property(type="string", property="file", default="/var/www/src/MoneyTransfer/User/Create/UserAlreadyExistsException.php"),
 *              @OA\Property(type="int", property="line", default=1),
 *         )
 *     )
 * )
 */
class Controller extends AbstractController
{
    /** @Route("/user/", methods={"POST"}) */
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
