<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class Controller extends AbstractController
{
    /**
     * @Route("/teste/")
     */
    public function index(): JsonResponse
    {
        return $this->json([
            'casas'
        ]);
    }
}
