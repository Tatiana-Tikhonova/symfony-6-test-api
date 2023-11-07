<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class RequestHandlerService
{
    public array $actions;
    public array $requestKeys;
    public array $userKeys;

    public function __construct(
        public ValidatorInterface  $validator,
        public ErrorHandlerService $errorHandlerService,
    )
    {
//        $this->actions = ['get', 'add', 'update', 'delete'];
//        $this->requestKeys = ['action', 'user'];
        $this->userKeys = ['id', 'email', 'name', 'sex', 'birthday'];
    }

    public function checkHeader($headerVal): string|bool
    {
        if ('application/json' != $headerVal) {
            return $this->errorHandlerService->setRequestErrorMsg('headers');
        }
        return true;
    }

    public function validateRequest(Request $request): string|array
    {
        $headers = $request->headers;
//        $method = $request->getMethod();
        if ('application/json' != $headers->get('accept')
            || 'application/json' != $headers->get('content-type')) {
            return $this->errorHandlerService->setRequestErrorMsg('headers');
        }
//        if ('POST' != $method) {
//            return $this->errorHandlerService->setRequestErrorMsg('method');
//        }

        return $request->toArray();
    }

    public function checkId(string $id): string|bool
    {
        $match = preg_match('/\D/', $id);
        if (0 === $match && (int)$id > 0) {
            return true;
        }
        return $this->errorHandlerService->setRequestErrorMsg('id');
    }

    public function checkFields(Request $request): string|array
    {
        $data = $this->validateRequest($request);
        if (is_array($data) && in_array('action', $data)) {
            if (in_array($data['action'], $this->actions)) {
                return $this->handler($data);
            }
            return $this->errorHandlerService->setFieldsErrorMsg('', 'action: ' . $data['action']);
        }
        return $data;

    }

    public function handler(array $data)
    {
//         && in_array('user', $data )
//        $user = $data['user'];
//
//        foreach ($user as $k => $v) {
//            if (!in_array($k, $this->userKeys)) {
//                return $this->errorHandlerService->setFieldsErrorMsg('keys', $k);
//            }
//
//        }

    }
}
