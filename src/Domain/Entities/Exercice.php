<?php

namespace src\Domain\Entities;

use JsonSerializable;
use src\Domain\Entities\Base\BaseEntity;

class Exercice extends BaseEntity Implements JsonSerializable
{
    private string $title;
    private string $description;
    private array $bodyParts; // array of BodyParts enum
    private ?int $creatorId;
    private ?string $createdAt;

    function __construct(?int $id, string $title, string $description, array $bodyParts, $creatorId, ?string $createdAt = null)
    {
        parent::__construct($id);

        $this->title = $title;
        $this->description = $description;
        $this->bodyParts = $bodyParts;
        $this->creatorId = $creatorId;
        $this->createdAt = $createdAt;
    }

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

    public function getBodyParts(): array
    {
        return $this->bodyParts;
    }

    public function setBodyParts(array $bodyParts): void
    {
        $this->bodyParts = $bodyParts;
    }

    public function getCreatorId(): ?int
    {
        return $this->creatorId;
    }

    public function setCreatorId(?int $creatorId): void
    {
        $this->creatorId = $creatorId;
    }

    public function getCreatedAt(): ?string
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?string $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    public function jsonSerialize(): mixed
    {
        return [
            'id'          => $this->getId(),
            'title'       => $this->title,
            'description' => $this->description,
            'bodyParts'   => $this->bodyParts,
            'creatorId'   => $this->creatorId,
            'createdAt'   => $this->createdAt,
        ];
    }
}