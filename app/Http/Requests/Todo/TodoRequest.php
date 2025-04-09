<?php

namespace App\Http\Requests\Todo;

use Illuminate\Foundation\Http\FormRequest;

class TodoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string'],
            'assignee' => ['nullable', 'string'],
            'due_date' => ['required', 'date', 'after_or_equal:today'],
            'time_tracked' => ['required', 'numeric'],
            'status' => ['required', 'string', 'in:pending,open,in_progress,completed'],
            'priority' => ['required', 'in:low,medium,high'],
        ];
    }
}
