<?php

namespace App\Entity;

use App\Serialization\SerializeTrait;
use Doctrine\ORM\Mapping as ORM;
use JsonSerializable;
use Serializable;

abstract class BaseModel implements Serializable, JsonSerializable
{
    use SerializeTrait;

}