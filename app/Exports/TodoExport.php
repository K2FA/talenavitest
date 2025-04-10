<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class TodoExport implements FromView
{
    public function __construct(public $filteredTodos, public $summary){}

    /**
    * @return \Illuminate\Support\Collection
    */
    public function view():View
    {
        return view('exports.todos', [
            'todos' => $this->filteredTodos,
            'summary' => $this->summary,
        ]);
    }
}
