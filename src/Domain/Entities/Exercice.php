<?php
namespace src\Domain\Entities\Base;

class Exercice extends BaseEntity
{
    private string $title;
    private string $description;
    private string $bodyParts;
    private ?int $ownerId;

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getBodyParts(): string
    {
        return $this->bodyParts;
    }

    public function setBodyParts(string $bodyParts): void
    {
        $this->bodyParts = $bodyParts;
    }

    public function getOwnerId(): ?int
    {
        return $this->ownerId;
    }

    public function setOwnerId(?int $ownerId): void
    {
        $this->ownerId = $ownerId;
    }
}