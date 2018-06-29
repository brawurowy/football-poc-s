<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;


class ApiController extends AbstractController
{

    protected function serialize($data, array $options = []) : array
    {
        $encoder = new JsonEncoder();
        $normalizer = new ObjectNormalizer();

        if(!empty($options['normalizer_ignored_attributes'])){
            $normalizer->setIgnoredAttributes($options['normalizer_ignored_attributes']);
        }
        $normalizer->setCircularReferenceLimit(1);
        $normalizer->setCircularReferenceHandler(function ($object) {
            return $object->getId();
        });
        $serializer = new Serializer([$normalizer], [$encoder]);
        return json_decode($serializer->serialize($data, 'json'), true);
    }

    protected function responseTemplate(array $responseContent, string $responseMessage = 'OK',  bool $success = true, int $responseStatus = Response::HTTP_OK, string $contentType = 'application/json')
    {
//        $responseTemplate= [
//            'msg' => $responseMessage,
//            'success' => $success,
//            'data' => $responseContent
//        ];

        $responseTemplate = $responseContent;
        return new Response(json_encode($responseTemplate), $responseStatus, ['Content-Type' => $contentType]);
    }
}