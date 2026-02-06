<?php

namespace src\Domain\Entities\Base;
abstract class BaseEntity
{
    private ?int $id;

    function __construct($id)
    {
        $this->id = $id;
    }
    public function getId(): ?int
    {
        return $this->id;
    }

}