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

    public function index()
    {
        return response()->json($this->todoService->getAllTodos(), 200);
    }

    public function show($id)
    {
        return response()->json($this->todoService->getTodoById($id), 200);
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

    public function update(Request $request, $id)
    {
        $dto = new TodoDTO(
            $request->input('title'),
            $request->input('content'),
            $request->input('isFavorite', false),
            $request->input('color', '#FFF')
        );

        $todo = $this->todoService->updateTodo($id, $dto);

        return response()->json($todo, 200);
    }

    public function destroy($id)
    {
        $this->todoService->deleteTodo($id);
        return response()->json(null, 204);
    }

    public function restore($id)
    {
        $todo = $this->todoService->restoreTodo($id);
        return response()->json($todo, 200);
    }
}
