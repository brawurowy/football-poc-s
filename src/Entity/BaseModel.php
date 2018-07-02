<?php

namespace App\Entity;

use Serializable;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

abstract class BaseModel implements Serializable
{
    protected $serializer;

    protected function resolveSerializer()
    {
        if(!$this->serializer) {
            $this->serializer = new Serializer([new ObjectNormalizer()], [new JsonEncoder()]);
        }
        return $this->serializer;
    }

    public function serialize()
    {
        return $this->resolveSerializer()->serialize($this, 'json');
    }

    public function unserialize($serialized)
    {
        return $this->resolveSerializer()->deserialize($serialized, static::class, 'json');
    }
}