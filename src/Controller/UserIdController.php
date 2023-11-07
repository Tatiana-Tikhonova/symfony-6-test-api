<?php

namespace App\Controller;

use App\Repository\UserRepository;
use App\Service\RequestHandlerService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class UserIdController extends AbstractController
{
    public function __construct(
        public RequestHandlerService $service,
        public ValidatorInterface  $validator,
    )
    {

    }
    #[Route('/users/{id}', name: 'getOneUser', methods: ['GET'])]
    public function getOneUser($id, UserRepository $userRepository, Request $request): JsonResponse
    {
        $isValidId = $this->service->checkId($id);
        if(is_string($isValidId)){
            return $this->json([
                'message' => 'string '.$isValidId,
            ]);
        }
        return $this->json([
            'message' => $isValidId,
        ]);

    }
    #[Route('/users/{id}', name: 'updateUsers', methods: ['PUT'])]
    public function updateUsers($id): JsonResponse
    {
        $isValidId = $this->service->checkId($id);
        if(is_string($isValidId)){
            return $this->json([
                'message' => 'string '.$isValidId,
            ]);
        }
        return $this->json([
            'message' => $isValidId,
        ]);
    }

    #[Route('/users/{id}', name: 'deleteUsers', methods: ['DELETE'] )]

    public function deleteUsers($id): JsonResponse
    {
        $isValidId = $this->service->checkId($id);
        if(is_string($isValidId)){
            return $this->json([
                'message' => 'string '.$isValidId,
            ]);
        }
        return $this->json([
            'message' => $isValidId,
        ]);
    }
}
