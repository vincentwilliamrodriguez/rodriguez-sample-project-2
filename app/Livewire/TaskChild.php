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
    public $isComplete = false;
    public $primaryKey;

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

    public function updatedItemStatus($value) {
        $this->isComplete = $value === 'Complete';
    }

    public function render() {
        return view('livewire.task-child');
    }

    public function showAdd() {
        $this->resetForm();
        $this->showModal = true;
    }

    public function showEdit(int $id) {
        $this->resetForm();
        $data = Task::findOrFail($id);

        $this->item = [
            'id'        => $data->id,
            'user_id'   => $data->user_id,
            'name'      => $data->name,
            'description'      => $data->description,
            'status'                => $data->status,
            'due_date'              => $data->due_date,
            'completion_date'=> $data->completion_date,
        ];

        $this->isEditMode = true;
        $this->showModal = true;
    }


    public function showDel($id) {
        $this->resetForm();
        $this->showDel = true;
        $this->primaryKey = $id;
    }

    public function resetForm() {
        $this->reset('item');
        $this->resetErrorBag();
    }

    public function saveTask() {
        $this->validate();

        try {

            if ($this->isEditMode) {
                $data = Task::findOrFail($this->item['id']);
                $data->update([
                    'user_id' => Auth::id(),
                    'name' => $this->item['name'],
                    'description' => $this->item['description'] ?? null,
                    'status' => $this->item['status'] ?? 'pending',
                    'due_date' => $this->item['due_date'] ?? null,
                    'completion_date' => null,
                ]);

                session()->flash('success', 'Task created successfully');

            } else {

                Task::create([
                    'user_id' => Auth::id(),
                    'name' => $this->item['name'],
                    'description' => $this->item['description'] ?? null,
                    'status' => $this->item['status'] ?? 'pending',
                    'due_date' => $this->item['due_date'] ?? null,
                    'completion_date' => null,
                ]);

                session()->flash('success', 'Task updated successfully');
            }

        } catch (\Exception $e) {
            session()->flash('success', 'An error has occurred:'. $e);
        }



        $this->showModal = false;
        return redirect()->route('tasks.index');
    }

    public function deleteTask() {
        try {
            $data = Task::findOrFail($this->primaryKey);
            $data->delete();
            session()->flash('success', 'Task deleted successfully');
        } catch (\Throwable $th) {
            session()->flash('success', 'An error has occurred:'. $e);
        }

        return redirect()->route('tasks.index');
    }
}
