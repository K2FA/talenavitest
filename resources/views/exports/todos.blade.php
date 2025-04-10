<table>
    <thead>
        <tr>
            <th>Title</th>
            <th>Assignee</th>
            <th>Due Date</th>
            <th>Time Tracked</th>
            <th>Status</th>
            <th>Priority</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($todos as $todo)
            <tr>
                <td>{{ $todo->title }}</td>
                <td>{{ $todo->assignee }}</td>
                <td>{{ $todo->due_date }}</td>
                <td>{{ $todo->time_tracked }}</td>
                <td>{{ $todo->status }}</td>
                <td>{{ $todo->priority }}</td>
            </tr>
        @endforeach

        {{-- Summary Row --}}
        <tr>
            <td><strong>Total Todos:</strong></td>
            <td colspan="2">{{ $summary['total_todos'] }}</td>
            <td><strong>Total Time Tracked:</strong></td>
            <td colspan="2">{{ $summary['total_time_tracked'] }}</td>
        </tr>
    </tbody>
</table>
