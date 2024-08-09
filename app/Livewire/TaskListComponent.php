<?php

namespace App\Livewire;

use App\Exports\TasksExport;
use App\Imports\TasksImport;
use App\Models\Task;
use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class TaskListComponent extends Component
{
    use WithPagination, WithFileUploads;

    public $title = '';
    public $description = '';
    public $status = 'To Do';
    public $user_id = '';
    public $task_id = '';
    public $importFile;

    public $rules = [
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'status' => 'required|in:To Do,In Progress,Done',
        'user_id' => 'required|exists:users,id'
    ];

    public function render()
    {
        $tasks = Task::with('user')->paginate(10);

        $users = User::all();

        return view('livewire.task-list-component', compact('tasks', 'users'));
    }

    public function deleteTask($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();
        session()->flash('message', 'Task Deleted Successfully');
    }

    public function import()
    {
        $this->validate([
            'importFile' => 'required|mimes:csv,xlsx|max:2048'
        ]);

        Excel::import(new TasksImport, $this->importFile->store('temp'));

    }

    public function export()
    {
        return Excel::download(new TasksExport, 'tasks.xlsx');
    }

}
