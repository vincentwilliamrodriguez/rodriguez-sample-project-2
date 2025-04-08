<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index() {
        $tasks = Task::where('user_id', auth()->id())
                    ->latest()
                    ->paginate(10);
        return view('tasks.index', compact('tasks'));
    }

    public function create() {
        return view('tasks.create');
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required',
            'due_date' => 'required|date',
            'completion_date' => 'nullable|date',
        ]);

        $validated['user_id'] = auth()->id();

        Task::create($validated);
        return redirect()->route('tasks.index')
            ->with('message', 'Task created successfully.');
    }

    public function edit(Task $task) {
        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, Task $task) {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required',
            'due_date' => 'required|date',
            'completion_date' => 'nullable|date',
        ]);


        $task->update($validated);
        return redirect()->route('tasks.index')
            ->with('message', 'Task updated successfully.');
    }

    public function destroy(Task $task) {
        $task->delete();
        return redirect()->route('tasks.index')
            ->with('message', 'Task deleted successfully.');
    }

    public function show(Task $task) {
        return view('tasks.show', compact('task'));
    }
}
