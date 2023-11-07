<?php

namespace App\Controller;


use App\Entity\User;
use App\Repository\UserRepository;
use App\Service\ErrorHandlerService;
use App\Service\RequestHandlerService;
use App\Service\ResponseHandlerService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class UsersController extends AbstractController
{
    public function __construct(
        public RequestHandlerService $service,
        public ResponseHandlerService $responseHandlerService,
        public ValidatorInterface  $validator,
    )
    {

    }

    #[Route('/users', name: 'users')]
    public function handleUsers(UserRepository $userRepository, Request $request ): JsonResponse
    {
        $isValidHeader = $this->service->checkHeader($request->headers->get('accept'));
        if(true === $isValidHeader){
//            $jsonResponse = new JsonResponse;
            switch ($request->getMethod()){
                case 'GET':
                    $data = $userRepository->findAll();
                    $data = array_map($this->responseHandlerService->convertData(), $data);
//                    $data = $this->responseHandlerService->serialize($data);

                    return new JsonResponse($data);
                    break;
                case 'POST':
                    $isValidHeader = $this->service->checkHeader($request->headers->get('content-type'));
                    if(true === $isValidHeader){
                        return $this->json([
                            'message' => 'POST',
                        ]);
                    }
                    return $this->json([
                        'message' => $isValidHeader,
                    ]);
                    break;
                default:
                    return $this->json([
                        'message' => $this->service->errorHandlerService->setRequestErrorMsg('method'),
                    ]);
                    break;
            }
        }
        return $this->json([
            'message' => $isValidHeader,
        ]);
    }


//    #[Route('/users', name: 'addUsers', methods: ['POST'])]
//    public function addUsers(): JsonResponse
//    {
//        return $this->json([
//                'message' => 'POST'
//            ]
//        );
//    }

    public function test()
    {
        //        $user = (new User())
//            ->setEmail('woman@test.ru')
//            ->setName('Test Women')
//            ->setAge(30)
//            ->setSex(2)
//            ->setPhone('+79998889988')
//            ->setBirthday(new \DateTime('2000-07-07'))
//            ->setCreatedAt(new \DateTimeImmutable())
//            ->setUpdatedAt(new \DateTimeImmutable());

//        $userRepository->add($user, true);
//        $entityManager->flush();

//        return $this->json([
//            'message' => $userRepository->add($user, true),
//        ]);

//        return $response->setData(['a'=>1]);
    }

}
