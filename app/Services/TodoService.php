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

    public function getAllTodos()
    {
        return $this->todoRepository->getAll();
    }

    public function getTodoById($id)
    {
        return $this->todoRepository->find($id);
    }

    public function updateTodo($id, TodoDTO $todoDTO)
    {
        return $this->todoRepository->update($id, [
            'title' => $todoDTO->title,
            'content' => $todoDTO->content,
            'isFavorite' => $todoDTO->isFavorite,
            'color' => $todoDTO->color,
        ]);
    }

    public function deleteTodo($id)
    {
        $this->todoRepository->delete($id);
    }

    public function restoreTodo($id)
    {
        return $this->todoRepository->restore($id);
    }

    public function forceDeleteTodo($id)
    {
        $this->todoRepository->forceDelete($id);
    }
}
