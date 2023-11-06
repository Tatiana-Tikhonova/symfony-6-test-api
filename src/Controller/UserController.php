<?php

namespace App\Controller;


use App\Entity\User;
use App\Repository\UserRepository;
use App\Service\ErrorHandlerService;
use App\Service\RequestHandlerService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    public function __construct(
        public RequestHandlerService $service,
    )
    {

    }
    #[Route('/users', name: 'users')]
    public function index(UserRepository $userRepository, Request $request): JsonResponse
    {
        $user = (new User())
            ->setEmail('woman@test.ru')
            ->setName('Test Women')
            ->setAge(30)
            ->setSex(2)
            ->setPhone('+79998889988')
            ->setBirthday(new \DateTime('2000-07-07'))
            ->setCreatedAt(new \DateTimeImmutable())
            ->setUpdatedAt(new \DateTimeImmutable());

//        $userRepository->add($user, true);
//        $entityManager->flush();

//        return $this->json([
//            'message' => $userRepository->add($user, true),
//        ]);
        return $this->json([
            'message' => $this->service->checkFields($request),
        ]);
//        return $response->setData(['a'=>1]);
    }

//    #[Route('/users', name: 'incorrectMethod', condition: "context.getMethod() not in ['POST']")]
//    public function incorrectMethod(): JsonResponse
//    {
//        return $this->json([
//            'message' => 'Incorrect request method! Read documentation on https://github.com/Tatiana-Tikhonova/symfony-6-test-api'
//        ],
//            status: 403
//        );
//    }
//    #[Route('/users/{endpoint}',
//        name: 'users_incorrect',
//        requirements: ['endpoint' => '.+']
//    )]
//    public function users_incorrect(): JsonResponse
//    {
//        return $this->json([
//            'message' => 'users_incorrect! Read documentation on https://github.com/Tatiana-Tikhonova/symfony-6-test-api'
//        ],
//            status: 403
//        );
//    }

}
