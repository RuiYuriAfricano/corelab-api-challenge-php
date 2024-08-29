<?php

namespace App\Repositories;

use App\Models\Todo;

class TodoRepository
{
    public function getAll()
    {
        return Todo::all();
    }

    public function find($id)
    {
        return Todo::findOrFail($id);
    }

    public function create(array $data)
    {
        return Todo::create($data);
    }

    public function update($id, array $data)
    {
        $todo = $this->find($id);
        $todo->update($data);
        return $todo;
    }

    public function delete($id)
    {
        $todo = $this->find($id);
        $todo->delete();
    }
}
