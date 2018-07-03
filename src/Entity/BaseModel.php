<?php

namespace App\Entity;

use App\Serialization\SerializeTrait;
use Doctrine\ORM\Mapping as ORM;
use Serializable;
use JsonSerializable;

abstract class BaseModel implements Serializable, JsonSerializable
{
    use SerializeTrait;

    /**
     * @ORM\Column(type="datetime", nullable=false)
     */
    private $updatedAt;

    /**
     * @ORM\Column(type="datetime", nullable=false)
     */
    private $createdAt;
    /**
     *
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function updatedTimestamps()
    {
        $this->setUpdatedAt(new \DateTime('now'));

        if ($this->getCreatedAt() == null) {
            $this->setCreatedAt(new \DateTime('now'));
        }
    }
}