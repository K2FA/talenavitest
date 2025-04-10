<?php

namespace App\Http\Controllers\Todo;

use App\Enums\Enums\TodoPriority;
use App\Enums\TodoStatus;
use App\Exports\TodoExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Todo\TodoRequest;
use App\Services\Todo\TodoService;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class TodoController extends Controller
{
    // Inject the TodoService via constructor for handling business logic
    public function __construct(private TodoService $todoService) {}

    /**
     * Display a listing of the Todo resources.
     * Currently not implemented.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created Todo resource in storage.
     *
     * @param TodoRequest $todo_request - validated request data
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(TodoRequest $todo_request)
    {
        // Delegate creation logic to the TodoService
        $todo = $this->todoService->store($todo_request);

        // Return JSON response with newly created Todo and success message
        return response()->json([
            'message' => "Todo created successfully",
            'data' => $todo,
        ], 201);
    }

    /**
     * Generate chart data based on request query parameter 'type'.
     * Supports 'status', 'priority', and 'assignee' as chart types.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function chart(Request $request)
    {
        $type = $request->query('type');

        // Generate chart data based on Todo status (e.g., pending, completed)
        if ($type === "status") {
            $status_data = $this->todoService->chart_enum($type, TodoStatus::values());

            return response()->json([
                'status_summary' => $status_data,
            ], 200);
        }

        // Generate chart data based on Todo priority (e.g., high, medium, low)
        if ($type === "priority") {
            $priority_data = $this->todoService->chart_enum($type, TodoPriority::values());

            return response()->json([
                'priority_summary' => $priority_data,
            ], 200);
        }

        // Generate chart data showing how many todos are assigned to each user
        if ($type === 'assignee') {
            $assignee_data = $this->todoService->chart_assignee('assignee');

            return response()->json([
                'assignee_summary' => $assignee_data,
            ], 200);
        }

        // Return error response if an invalid chart type is requested
        return response()->json([
            'message' => "invalid chart type"
        ], 400);
    }

    /**
     * Export Todo data to an Excel file and download it.
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function export(Request $request)
    {
        // Get todos based on filters from request via service layer
        $todos = $this->todoService->exportExcel($request);

        // Prepare summary data to be included in the export
        $summary = [
            'total_todos' => $todos->count(),
            'total_time_tracked' => $todos->sum('time_tracked'),
        ];

        // Return Excel file for download
        return Excel::download(new TodoExport($todos, $summary), 'todo-report.xlsx');
    }
}
