<?php

namespace App\Services\Todo;

use App\Http\Requests\Todo\TodoRequest;
use App\Models\Todo\Todo;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TodoService
{
    /**
     * Store a newly created Todo resource in the database.
     *
     * @param TodoRequest $todo_request - Validated input data for the Todo
     * @return Todo - The created Todo instance
     * @throws Exception
     */
    public function store(TodoRequest $todo_request): Todo
    {
        // Creates a new Todo record using validated request data
        return Todo::create($todo_request->validated());
    }

    /**
     * Generate summary data for a given enum type (e.g. status, priority).
     *
     * @param string $type - Column name in the todos table (e.g. 'status', 'priority')
     * @param array $all_enum - Array of all possible enum values for the type
     * @return array - Summary with count of todos per enum value
     */
    public function chart_enum($type, $all_enum)
    {
        // Group todos by the enum type and count the occurrences
        $summary  = Todo::select($type)
            ->selectRaw('count(*) as total')
            ->groupBy($type)
            ->pluck('total', $type); // Returns key-value pairs (enum => count)

        $all_data = [];

        // Fill in summary data with 0 for any missing enum values
        foreach ($all_enum as $enum) {
            $all_data[$enum] = $summary[$enum] ?? 0;
        }

        return $all_data;
    }

    /**
     * Generate summary data grouped by assignee.
     * Includes total tasks, pending tasks, and time tracked for completed tasks.
     *
     * @param string $type - The column name used for grouping (typically 'assignee')
     * @return array - Summary data grouped by assignee
     */
    public function chart_assignee($type)
    {
        // Get todos that are assigned to someone
        $todos = Todo::select($type, 'status', 'time_tracked')
            ->whereNotNull('assignee')
            ->get()
            ->groupBy($type); // Group todos by assignee

        $summary = [];

        // Loop through each assignee group to build summary statistics
        foreach($todos as $assignee => $tasks) {
            $summary[$assignee] = [
                'total_todos' => $tasks->count(),
                'total_pending_todos' => $tasks->where('status', 'pending')->count(),
                'total_timetracked_completed_todos' => $tasks->where('status', 'completed')->sum('time_tracked'),
            ];
        }

        return $summary;
    }

    /**
     * Filter and retrieve todos based on request parameters for Excel export.
     *
     * Supported filters:
     * - title (partial match)
     * - assignee (comma-separated list)
     * - due_date (start and end range)
     * - time_tracked (min and max)
     * - status (comma-separated list)
     * - priority (comma-separated list)
     *
     * @param Request $request - Contains filter parameters
     * @return \Illuminate\Support\Collection - Filtered list of todos
     */
    public function exportExcel(Request $request)
    {
        $query = Todo::query(); // Start a new query on the Todo model

        // Apply title filter (like search)
        if($request->filled('title')) {
            $query->where('title', 'like', '%'. $request->title . "%");
        }

        // Filter by one or more assignees
        if ($request->filled('assignee')){
            $query->whereIn('assignee', explode(",", $request->assignee));
        }

        // Filter by due date range
        if($request->filled('start') && $request->filled('end')){
            $query->whereBetween('due_date', [$request->start, $request->end]);
        }

        // Filter by time tracked range
        if($request->filled('min') && $request->filled('max')){
            $query->whereBetween('time_tracked', [$request->min, $request->max]);
        }

        // Filter by status values
        if($request->filled('status')){
            $query->whereIn('status', explode(',', $request->status));
        }

        // Filter by priority values
        if($request->filled('priority')){
            $query->whereIn('priority', explode(',', $request->priority));
        }

        // Execute the query and return the results
        return $query->get();
    }
}
