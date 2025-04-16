<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Task;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class TaskIndex extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $search = '';
    public $sortColumn = 'id';
    public $sortOrder = 'asc';

    public function fetchData() {
        return Task::where('user_id', 'like', '%' . $this->search . '%')
            ->orWhere('name', 'like', '%' . $this->search . '%')
            ->orWhere('description', 'like', '%' . $this->search . '%')
            ->orWhere('status', 'like', '%' . $this->search . '%')
            ->orderBy($this->sortColumn, $this->sortOrder)
            ->paginate(10);
    }

    public function sortBy($columnName) {
        if($this->sortColumn === $columnName) {
            $this->sortOrder = $this->sortOrder === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortColumn = $columnName;
            $this->sortOrder = 'asc';
        }
    }

    public function render() {
        $tasks = $this->fetchData();
        return view('livewire.task-index', compact('tasks'));
    }
}
