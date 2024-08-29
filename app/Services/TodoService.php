<?php

namespace App\Services;

use App\DTOs\TodoDTO;
use App\Repositories\TodoRepository;

class TodoService
{
    protected $todoRepository;

    public function __construct(TodoRepository $todoRepository)
    {
        $this->todoRepository = $todoRepository;
    }

    public function createTodo(TodoDTO $todoDTO)
    {
        return $this->todoRepository->create([
            'title' => $todoDTO->title,
            'content' => $todoDTO->content,
            'isFavorite' => $todoDTO->isFavorite,
            'color' => $todoDTO->color,
        ]);
    }

    // Outros métodos de serviço podem ser adicionados aqui
}
