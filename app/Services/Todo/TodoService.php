<?php

namespace App\Services\Todo;

use App\Http\Requests\Todo\TodoRequest;
use App\Models\Todo\Todo;
use Exception;
use Illuminate\Support\Facades\Log;

class TodoService
{
    public function store(TodoRequest $todo_request): Todo
    {
        try {
            return Todo::create($todo_request->validated());
        } catch (Exception $e) {
            Log::error("Error creating todo: ", [
                'error' => $e->getMessage(),
                'request' => $todo_request,
            ]);
            throw new Exception("Failed to save todo, please try again later.");
        }
    }
}
