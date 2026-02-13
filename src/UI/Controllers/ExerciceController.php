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
        if(empty($title) || empty($description) || empty($bodyParts) || empty($creatorId)){
            http_response_code(400);
            exit;
        }

        $result = $this->exerciceService->create($title, $description, $bodyParts, $creatorId);
        if(!isset($result)){
            http_response_code(500);
        }

        header('Location: ' . makeUrl());
    }

    public function fetchAll(): void
    {
        try {
            $data = $this->exerciceService->getAll();
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