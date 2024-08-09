<?php

namespace App\Livewire;

use App\Jobs\SendTaskNotification;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateTaskComponent extends Component
{
    use WithFileUploads;

    public $title = '';
    public $description = '';
    public $status = 'To Do';
    public $user_id = '';
    public $task_id;
    public $attachment;
    public $existingAttachment;
    public $rules = [
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'status' => 'required|in:To Do,In Progress,Done',
        'user_id' => 'required|exists:users,id',
        'attachment' => 'nullable|file|max:1024' //1mb
    ];

    public function mount($id = null)
    {
        if($id)
        {
            $task = Task::findOrFail($id);
            $this->title = $task->title;
            $this->description = $task->description;
            $this->status = $task->status;
            $this->user_id = $task->user_id;
            $this->task_id = $task->id;
            $this->existingAttachment = $task->attachment;
        }

        info($id);
    }
    public function save()
    {
        $this->validate();

        $data = [
            'title' => $this->title,
            'description' => $this->description,
            'status' => $this->status,
            'user_id' => $this->user_id
        ];

        if($this->attachment)
        {
           $data['attachment'] = $this->attachment->store('attachments');
           $file = $this->attachment->getClientOriginalName();
           $data['attachment_name'] = pathinfo($file, PATHINFO_FILENAME);
           $data['attachment_type'] = pathinfo($file, PATHINFO_EXTENSION);
           if($this->task_id && $this->existingAttachment)
           {
               Storage::delete($this->existingAttachment);
           }
        }

        $task = Task::updateOrCreate(['id' => $this->task_id], $data);

        //        dispatch the email notification

        SendTaskNotification::dispatch($task->load('user'));
        session()->flash('message', 'Task Updated Successfully');

        return redirect()->route('tasks.list');
    }

    public function render()
    {
        $users = User::all();
        return view('livewire.create-task-component', compact('users'));
    }
}
