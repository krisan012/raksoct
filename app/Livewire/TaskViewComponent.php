<?php

namespace App\Livewire;

use App\Models\Task;
use Livewire\Component;

class TaskViewComponent extends Component
{
    public $title;
    public $description;
    public $status = 'To Do';
    public $user_id;
    public $task_id;
    public $user;
    public $attachment;
    public $attachment_name;
    public $attachment_type;

    public function mount($id)
    {

        $task                  = Task::with('user')->findOrFail($id);
        $this->title           = $task->title;
        $this->description     = $task->description;
        $this->status          = $task->status;
        $this->user_id         = $task->user_id;
        $this->task_id         = $task->id;
        $this->user            = $task->user;
        $this->attachment      = $task->attachment;
        $this->attachment_name = $task->attachment_name;
        $this->attachment_type = $task->attachment_type;
    }

    public function render()
    {
        return view('livewire.task-view-component');
    }

    public function delete($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();
        session()->flash('message', 'Task Deleted Successfully');
        return redirect()->route('tasks.list');
    }
}
