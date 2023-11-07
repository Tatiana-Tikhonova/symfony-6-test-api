<?php

namespace App\Service;

use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class ResponseHandlerService
{
    private $encoders;
    private $normalizers;
    private $serializer;
    public function __construct()
    {
        $this->encoders = [new JsonEncoder()];
        $this->normalizers = [new ObjectNormalizer()];
        $this->serializer = new Serializer( $this->normalizers, $this->encoders);

    }

    public function convertData($data):array
    {
        return (array)$data;
    }
    public function serialize($data): string
    {
        return $this->serializer->serialize($data, 'json');
    }

}
