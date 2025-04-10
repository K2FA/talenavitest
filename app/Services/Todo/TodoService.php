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

    public function chart_enum($type, $all_enum)
    {
        $summary  = Todo::select($type)
            ->selectRaw('count(*) as total')
            ->groupby($type)
            ->pluck('total', $type);

        $all_data = [];
        foreach ($all_enum as $enum) {
            $all_data[$enum] = $summary[$enum] ?? 0;
        }

        return $all_data;
    }


    public function chart_assignee($type)
    {
        $todos = Todo::select($type, 'status', 'time_tracked')
            ->whereNotNull('assignee')
            ->get()
            ->groupBy($type);

        $summary = [];

        foreach($todos as $assignee => $tasks) {
            $summary[$assignee] = [
                'total_todos' => $tasks->count(),
                'total_pending_todos' => $tasks->where('status', 'pending')->count(),
                'total_timetracked_completed_todos' => $tasks->where('status', 'completed')->sum('time_tracked'),
            ];
        }

        return $summary;
    }
}
