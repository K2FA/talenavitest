<?php

namespace App\Http\Requests\Todo;

use App\Enums\Enums\TodoPriority;
use App\Enums\TodoStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
        // Validation rules for creating Todo data
        return [
            'title' => ['required', 'string'],
            'assignee' => ['nullable', 'string'],
            'due_date' => ['required', 'date', 'after_or_equal:today'],
            'time_tracked' => ['required', 'numeric'],
            'status' => ['nullable', Rule::in(TodoStatus::values())],
            'priority' => ['required', Rule::in(TodoPriority::values())],
        ];
    }
}
