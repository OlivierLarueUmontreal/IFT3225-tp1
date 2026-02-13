<?php

namespace src\Application\Services;

use src\Application\Repositories\IExerciceRepository;
use src\Domain\Entities\Exercice;

class ExerciceService
{
    private IExerciceRepository $exerciceRepository;

    function __construct(IExerciceRepository $exerciceRepository)
    {
        $this->exerciceRepository = $exerciceRepository;
    }

    public function getAll(): array
    {
        return $this->exerciceRepository->retrieveAll();
    }

    public function create(string $title, string $description, array $bodyParts, int $creatorId) : ?Exercice
    {
        $exercice = new Exercice(null, $title, $description, $bodyParts, $creatorId);
        return $this->exerciceRepository->create($exercice);
    }
}