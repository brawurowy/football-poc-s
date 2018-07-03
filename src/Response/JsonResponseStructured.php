<?php

namespace App\Response;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class JsonResponseStructured extends Response
{
    public function __construct($dataProperty, string $messageProperty = 'OK', bool $successProperty = true)
    {
        $content = [
            'data' => $dataProperty,
            'message' => $messageProperty,
            'success' => $successProperty
        ];

        parent::__construct(json_encode($content), Response::HTTP_OK, ['Content-Type' => 'application/json']);
    }
}