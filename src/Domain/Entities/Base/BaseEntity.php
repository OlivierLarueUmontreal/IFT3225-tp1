<?php

abstract class BaseEntity
{
    public ?int $id {
        get {
            return $this->id;
        }
    }

}