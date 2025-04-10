<?php

namespace App\Http\Controllers\Todo;

use App\Http\Controllers\Controller;
use App\Http\Requests\Todo\TodoRequest;
use App\Services\Todo\TodoService;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function __construct(private TodoService $todoService) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TodoRequest $todo_request)
    {
        // Validate the request using the TodoRequest class and send it to the service
        // to create a new Todo item.
        $todo = $this->todoService->store($todo_request);

        return response()->json([
            'message' => "Todo created successfully",
            'data' => $todo
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
