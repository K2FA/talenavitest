<?php

namespace App\Services\Todo;

use App\Http\Requests\Todo\TodoRequest;
use App\Models\Todo\Todo;
use Exception;
use Illuminate\Support\Facades\Log;

class TodoService
{
    /**
     * Store a newly created resource in storage.
     *
     * @param TodoRequest $todo_request
     * @return Todo
     * @throws Exception
     */
    public function store(TodoRequest $todo_request): Todo
    {
        // Helper function to create a new Todo item
        return Todo::create($todo_request->validated());
    }
}
