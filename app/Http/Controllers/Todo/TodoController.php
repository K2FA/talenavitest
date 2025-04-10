<?php

namespace App\Http\Controllers\Todo;

use App\Enums\Enums\TodoPriority;
use App\Enums\TodoStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\Todo\TodoRequest;
use App\Models\Todo\Todo;
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
            'data' => $todo,
        ], 201);
    }

    public function chart(Request $request)
    {
        $type = $request->query('type');

        if ($type === "status") {
            $status_data = $this->todoService->chart_enum($type, TodoStatus::values());

            return response()->json([
                'status_summary' => $status_data,
            ], 200);
        }

        if ($type === "priority") {
            $priority_data = $this->todoService->chart_enum($type, TodoPriority::values());

            return response()->json([
                'priority_summary' => $priority_data,
            ], 200);
        }

        if($type === 'assignee') {
            $assignee_data = $this->todoService->chart_assignee('assignee');

            return response()->json([
                'assignee_summary' => $assignee_data,
            ],200);
        }

        return response()->json([
            'message' => "invalid chart type"
        ], 400);
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
