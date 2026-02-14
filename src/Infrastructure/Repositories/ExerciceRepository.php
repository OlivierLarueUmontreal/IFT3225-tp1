<?php

namespace src\Infrastructure\Repositories;

use Exception;
use PDO;
use PDOException;
use src\Application\Repositories\IExerciceRepository;
use src\Domain\Entities\Exercice;

class ExerciceRepository implements IExerciceRepository
{
    private PDO $pdo;

    function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function retrieveAll(): array
    {
        $query = "SELECT * FROM exercices";

        try {
            $statement = $this->pdo->prepare($query);
            $statement->execute();
        } catch (PDOException $e) {
            throw new Exception("Could not retrieve exercices: " . $e->getMessage());
        }

        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return array_map(fn($e) => $this->map($e), $result);
    }

    public function retrieveAllOfCreator($creatorId): array
    {
        if (!isset($creatorId))
            throw new Exception("creatorId not set");

        $query = "SELECT * FROM exercices where creatorId = :creatorId";
        $values = ["creatorId" => $creatorId];
        try {
            $statement = $this->pdo->prepare($query);
            $statement->execute($values);
        } catch (PDOException $e) {
            throw new Exception("Could not retrieve exercices: " . $e->getMessage());
        }

        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return array_map(fn($e) => $this->map($e), $result);
    }

    public function retrieveById($id): ?Exercice
    {
        if (!isset($id))
            throw new Exception("Must provide valid id");

        $query = "SELECT * FROM exercices WHERE id = :id";
        $values = [":id" => $id];
        try {
            $statement = $this->pdo->prepare($query);
            $statement->execute($values);
        } catch (PDOException $e) {
            throw new Exception("Could not retrieve exercice with id: $id " . $e->getMessage());
        }
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        if (!isset($result)) return null;

        return $this->map($result);
    }

    public function create(Exercice $exercice): bool
    {
        if ($exercice->getId() !== null)
            throw new Exception("Exercice {$exercice->getTitle()} already exists");

        $rawBodyParts = $this->mapBodyPartsToRaw($exercice->getBodyParts());
        $query = "INSERT INTO exercices (title, description, bodyparts, creatorId) VALUES (:title, :description, :bodyparts, :creatorId);";
        $values = [
            'title' => $exercice->getTitle(),
            'description' => $exercice->getDescription(),
            'bodyparts' => $rawBodyParts,
            'creatorId' => $exercice->getCreatorId()
        ];

        try {
            $statement = $this->pdo->prepare($query);
            $statement->execute($values);
        } catch (PDOException $e) {
            throw new Exception("Could not store exercice {$exercice->getTitle()}: " . $e->getMessage());
        }

        return true;
    }

    public function update(Exercice $exercice): bool
    {
        $rawBodyParts = $this->mapBodyPartsToRaw($exercice->getBodyParts());
        $query = "UPDATE exercices SET title = :title, description = :description, bodyparts = :bodyparts WHERE id = :id";
        $values = ['id' => $exercice->getId(), 'title' => $exercice->getTitle(), 'description' => $exercice->getDescription(), 'bodyparts' => $rawBodyParts];
        try {
            $statement = $this->pdo->prepare($query);
            $statement->execute($values);
        } catch (PDOException $e) {
            throw new Exception("Could not update exercice {$exercice->getTitle()}: " . $e->getMessage());
        }

        return true;
    }

    public function delete(Exercice $exercice): bool
    {
        $query = "DELETE FROM exercices WHERE id = :id";
        $values = [":id" => $exercice->getId()];
        try {
            $statement = $this->pdo->prepare($query);
            return $statement->execute($values);
        } catch (PDOException $e) {
            throw new Exception("Could not delete exercice with id: " . $e->getMessage());
        }
    }

    private function map(array $data): Exercice
    {
        return new Exercice(
            $data['id'],
            $data['title'],
            $data['description'],
            $this->mapBodyParts($data["bodyparts"]),
            $data['creatorId'],
        );
    }

    private function mapBodyParts(string $rawBodyParts): array
    {
        $rawArray = explode(',', $rawBodyParts);
        $bodyParts = [];
        foreach ($rawArray as $bodyPart) {
            $bodyParts[] = $bodyPart;
        }

        return $bodyParts;
    }

    private function mapBodyPartsToRaw(array $bodyParts): string
    {
        return implode(',', array_map(fn($bp) => $bp, $bodyParts));
    }

}