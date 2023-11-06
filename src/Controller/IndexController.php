<?php

namespace App\Controller;


use App\Service\ErrorHandlerService;
use App\Service\RandomAmountService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
//    private RandomAmountService $service;
//
//    #[Required]
//    public function setRandomAmountService(RandomAmountService $service)
//    {
//        $this->service = $service;
//    }

    public function __construct(
        private readonly RandomAmountService $service,
        public ErrorHandlerService $errorHandlerService,

    )
    {

    }

    #[Route('/', name: 'homepage')]
    #[Route('/{endpoint}', name: 'incorrectEndpoint', condition: "context.getPathInfo() != '/users'" )]
        #[Route('/users/{endpoint}', name: 'usersIncorrectEndpoint', requirements: ['endpoint' => '.+'] )]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => $this->errorHandlerService->setRequestErrorMsg('endpoint'),
        ],
            status: 404
        );


    }


//    public function incorrectEndpoint(): JsonResponse
//    {
//        return $this->json([
//            'message' => 'Incorrect endpoint! Read documentation on https://github.com/Tatiana-Tikhonova/symfony-6-test-api'
//        ],
//            status: 404
//        );
//
//    }

}
