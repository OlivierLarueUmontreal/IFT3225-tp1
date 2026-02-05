<?php
namespace src\Domain\Entities\Base;
abstract class BaseEntity
{
    public ?int $id {
        get {
            return $this->id;
        }
    }

}