<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\TodoService;
use App\DTOs\TodoDTO;
use App\Http\Requests\TodoRequest;

class TodoController extends Controller
{
    protected $todoService;

    public function __construct(TodoService $todoService)
    {
        $this->todoService = $todoService;
    }

    public function index()
    {
        $todos = $this->todoService->getAllTodos();

        return response()->json([
            'success' => true,
            'data' => $todos
        ], 200);
    }

    public function show($id)
    {
        try {
            $todo = $this->todoService->getTodoById($id);

            return response()->json([
                'success' => true,
                'data' => $todo
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Todo not found'
            ], 404);
        }
    }

    public function store(TodoRequest $request)
    {
        $dto = new TodoDTO(
            $request->input('title'),
            $request->input('content'),
            $request->input('isFavorite', false),
            $request->input('color', '#FFF')
        );

        $todo = $this->todoService->createTodo($dto);

        return response()->json([
            'success' => true,
            'message' => 'Todo created successfully',
            'data' => $todo
        ], 201);
    }

    public function update(TodoRequest $request, $id)
    {
        $dto = new TodoDTO(
            $request->input('title', null),
            $request->input('content', null),
            $request->input('isFavorite', null),
            $request->input('color', null)
        );

        try {
            $todo = $this->todoService->updateTodo($id, $dto);

            return response()->json([
                'success' => true,
                'message' => 'Todo updated successfully',
                'data' => $todo
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Todo not found or update failed: '.$e
            ], 404);
        }
    }

    public function destroy($id)
    {
        try {
            $this->todoService->deleteTodo($id);

            return response()->json([
                'success' => true,
                'message' => 'Todo deleted successfully'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Todo not found or delete failed'
            ], 404);
        }
    }

    public function restore($id)
    {
        try {
            $todo = $this->todoService->restoreTodo($id);

            return response()->json([
                'success' => true,
                'message' => 'Todo restored successfully',
                'data' => $todo
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Todo not found or restore failed'
            ], 404);
        }
    }
}
