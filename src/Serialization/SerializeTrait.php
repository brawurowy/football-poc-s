<?php

namespace App\Serialization;

use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

trait SerializeTrait
{
    protected $serializer;

    public function serialize()
    {
        return $this->resolveSerializer()->serialize($this, 'json');
    }

    public function unserialize($serialized)
    {
        return $this->resolveSerializer()->deserialize($serialized, static::class, 'json');
    }

    public function jsonSerialize()
    {
        return $this->resolveSerializer()->normalize($this);
    }

    protected function resolveSerializer()
    {
        $normalizers = $this->resolveNormalizers();
        $encoders = $this->resolveEncoders();

        if(!$this->serializer) {
            $this->serializer = new Serializer($normalizers, $encoders);
        }

        return $this->serializer;
    }

    protected function resolveNormalizers()
    {
        $normalizer = new ObjectNormalizer();

        if(!empty($this->getAttributesToSkip())){
            $normalizer->setIgnoredAttributes($this->getAttributesToSkip());
        }
        $normalizer->setCircularReferenceLimit(1);
        $normalizer->setCircularReferenceHandler(function ($object) {
            return $object->getId();
        });

        return [$normalizer];
    }

    protected function resolveEncoders()
    {
        return [new JsonEncoder()];
    }

    protected function getAttributesToSkip()
    {
        return isset($this->attributesToSkip) ? $this->attributesToSkip : [];
    }
}