<?php

namespace src\Application\Repositories;

use src\Domain\Entities\Exercice;

interface IExerciceRepository
{
    public function retrieveAll(): array;
    public function retrieveAllOfCreator($creatorId): array;
    public function retrieveById($id): ?Exercice;
    public function create(Exercice $exercice): ?Exercice;
}