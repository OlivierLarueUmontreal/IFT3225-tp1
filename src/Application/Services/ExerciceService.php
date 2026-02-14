<?php

namespace src\Application\Services;

use Exception;
use src\Application\Repositories\IAccountRepository;
use src\Application\Repositories\IExerciceRepository;
use src\Domain\Entities\Exercice;

class ExerciceService
{
    private IExerciceRepository $exerciceRepository;
    private IAccountRepository $accountRepository;

    function __construct(IExerciceRepository $exerciceRepository, IAccountRepository $accountRepository)
    {
        $this->exerciceRepository = $exerciceRepository;
        $this->accountRepository = $accountRepository;
    }

    public function getAll(): array
    {
        return $this->exerciceRepository->retrieveAll();
    }

    public function create(string $title, string $description, array $bodyParts, int $creatorId): bool
    {
        $user_id = $_SESSION["user_id"];
        if ($user_id === null)
            throw new Exception("You must be logged in to create an exercice");

        $isAdmin = $this->accountRepository->IsAdmin($user_id);
        if ($user_id !== $creatorId && !$isAdmin)
            throw new Exception("You must be an admin to delete an exercice that you do not own.");

        $exercice = new Exercice(null, $title, $description, $bodyParts, $creatorId);
        return $this->exerciceRepository->create($exercice);
    }

    public function update(int $id, string $title, string $description, array $bodyParts, int $creatorId): bool
    {
        $user_id = $_SESSION["user_id"];
        if ($user_id === null)
            throw new Exception("You must be logged in to delete an exercice");

        if ($user_id !== $creatorId)
            throw new Exception("You can't update an exercice that you do not own.");

        $exercice = new Exercice($id, $title, $description, $bodyParts, $creatorId);
        return $this->exerciceRepository->update($exercice);
    }

    public function delete(int $id): bool
    {
        $user_id = $_SESSION["user_id"];
        if ($user_id === null)
            throw new Exception("You must be logged in to delete an exercice");

        $exercice = $this->exerciceRepository->retrieveById($id);
        if($exercice === null)
            throw new Exception("Exercice not found");

        $isAdmin = $this->accountRepository->IsAdmin($user_id);
        if ($user_id !== $exercice->getCreatorId() && !$isAdmin)
            throw new Exception("You must be the creator of the exercice or be an admin to delete.");

        return $this->exerciceRepository->delete($exercice);
    }
}