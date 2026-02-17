<?php

namespace src\UI\Controllers;

use src\Application\Services\ExerciceService;
use Throwable;

class ExerciceController
{
    private ExerciceService $exerciceService;

    function __construct(ExerciceService $exerciceService)
    {
        $this->exerciceService = $exerciceService;
    }

    public function add(): void
    {
        $title = $_POST['title'];
        $description = $_POST['description'];
        $bodyParts = $_POST['bodyParts'] ?? [];
        $creatorId = $_SESSION['user_id'];
        if (empty($title) || empty($description) || empty($bodyParts) || empty($creatorId)) {
            header('Content-type: application/json');
            echo json_encode(["error" => true, "message" => "Given information in form is invalid."]);
        }

        try {
            $this->exerciceService->create($title, $description, $bodyParts, $creatorId);
        } catch (Throwable) {
            http_response_code(500);
            exit;
        }

        header('Location: ' . makeUrl());
    }

    public function update(): void
    {
        $id = $_POST['id'];
        $title = $_POST['title'];
        $description = $_POST['description'];
        $bodyParts = $_POST['bodyParts'] ?? [];
        $creatorId = $_POST['creatorId'];

        if (empty($id)) {
            header('Content-type: application/json');
            echo json_encode(["error" => true, "message" => "Exercice ID is required."]);
        }

        if (empty($title)) {
            header('Content-type: application/json');
            echo json_encode(["error" => true, "message" => "Exercice Title is required."]);
        }

        if (empty($description)) {
            header('Content-type: application/json');
            echo json_encode(["error" => true, "message" => "Exercice description is required."]);
        }

        if (empty($bodyParts)) {
            header('Content-type: application/json');
            echo json_encode(["error" => true, "message" => "Exercice body parts is required."]);
        }

        if (empty($creatorId)) {
            header('Content-type: application/json');
            echo json_encode(["error" => true, "message" => "Creator ID is required."]);
        }

        try {
            $result = $this->exerciceService->update($id, $title, $description, $bodyParts, $creatorId);
            header('Content-type: application/json');
            if (!$result) {
                echo json_encode(["error" => false, "message" => "An error occurred while updating the exercice"]);
            } else {
                echo json_encode(["success" => true, "message" => "Exercice successfully updated"]);
            }
            exit;
        } catch (Throwable $e) {
            header('Content-Type: application/json', true, 500);
            echo json_encode(["error" => true, "message" => $e->getMessage()]);
            exit;
        }
    }

    public function delete($id): void
    {
        if (!isset($id)) {
            header('Content-type: application/json');
            echo json_encode(["error" => true, "message" => "Exercice ID is required."]);
            exit;
        }

        try {
            $result = $this->exerciceService->delete($id);
            header('Content-type: application/json');
            if (!$result) {
                echo json_encode(["error" => false, "message" => `An error occurred while deleting the exercice with id : {$id}`]);
            } else {
                echo json_encode(["success" => true, "message" => "Exercice successfully deleted"]);
            }
            exit;
        } catch (Throwable $e) {
            header('Content-Type: application/json', true, 500);
            echo json_encode(["error" => true, "message" => $e->getMessage()]);
            exit;
        }
    }

    public function fetchAll(): void
    {
        try {
            // if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == true) {
            //     $raw = $this->exerciceService->getAll();
            // } else {
            //     $creatorId = $_SESSION['user_id'] ?? null;
            //     $raw = $this->exerciceService->getByCreatorId($creatorId);
            // }
            $raw = $this->exerciceService->getAll();


            $data = $this->exerciceService->formatForApi($raw);

            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($data);
            exit;
        } catch (Throwable $e) {
            header('Content-Type: application/json', true, 500);
            echo json_encode([
                "error" => $e->getMessage(),
                "file" => $e->getFile(),
                "line" => $e->getLine(),
            ]);
            exit;
        }
    }
}