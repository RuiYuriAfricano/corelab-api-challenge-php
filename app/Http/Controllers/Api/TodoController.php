<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\TodoService;
use App\DTOs\TodoDTO;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    protected $todoService;

    public function __construct(TodoService $todoService)
    {
        $this->todoService = $todoService;
    }

    public function store(Request $request)
    {
        $dto = new TodoDTO(
            $request->input('title'),
            $request->input('content'),
            $request->input('isFavorite', false),
            $request->input('color', '#FFF')
        );

        $todo = $this->todoService->createTodo($dto);

        return response()->json($todo, 201);
    }

    // Outros métodos (index, show, update, delete) podem ser adicionados aqui
}
