<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class TaskChild extends Component
{
    public $item = [];
    public $showModal = false;
    public $isEditMode = false;
    public $showDel = false;

    protected $listeners = ['showAdd', 'showEdit', 'showDel'];

    protected $rules = [
        'item.name' => 'required|min:4',
        'item.description' => 'nullable|max:255',
        'item.status' => 'required',
        'item.due_date' => 'required|date|after_or_equal:today',
    ];

    protected $validationAttributes = [
        'item.name' => 'Name',
        'item.description' => 'Description',
        'item.status' => 'Status',
        'item.due_date' => 'Due Date',
    ];

    // public function updated($propertyName) {
    //     $this->validateOnly($propertyName);
    // }

    public function render() {
        return view('livewire.task-child');
    }

    public function showAdd() {
        $this->resetForm();
        $this->showModal = true;
    }

    public function resetForm() {
        $this->reset('item');
        $this->resetErrorBag();
    }

    public function saveTask() {
        $this->validate();

        Task::create([
            'user_id' => Auth::id(),
            'name' => $this->item['name'],
            'description' => $this->item['description'] ?? null,
            'status' => $this->item['status'] ?? 'pending',
            'due_date' => $this->item['due_date'] ?? null,
            'completion_date' => null,
        ]);

        session()->flash('success', 'Task created successfully');
        $this->showModal = false;
        return redirect()->route('tasks.index');
    }
}
