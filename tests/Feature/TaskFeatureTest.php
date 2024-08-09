<?php

namespace Tests\Feature;


use App\Jobs\SendTaskNotification;
use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;
use PHPUnit\Util\Test;
use Tests\TestCase;

class TaskFeatureTest extends TestCase
{

    public function test_a_user_can_create_task(): void
    {
        $user = User::factory()->create();

        Livewire::actingAs($user)->test('create-task-component')
            ->set('title', 'Test')
            ->set('description', 'sample description')
            ->set('status', 'To Do')
            ->set('user_id', $user->id)
            ->call('save');

        $this->assertDatabaseHas('tasks', ['title' => 'Test']);
    }

    public function test_dispatches_tasks_notification_job(): void
    {
        Queue::fake();

        $user = User::factory()->create();

        Livewire::actingAs($user)
            ->test('create-task-component')
            ->set('title', 'Test')
            ->set('description', 'sample description')
            ->set('status', 'To Do')
            ->set('user_id', $user->id)
            ->call('save');

        Queue::assertPushed(SendTaskNotification::class);
    }

//    public function test_it_can_import_tasks_from_csv()
//    {
//        Storage::fake('local');
//
//        $csv = 'title,description,status,user\nTest Task,Test Description,To Do,1';
//        Storage::fake('local')->put('tasks.csv', $csv);
//
//        $file = UploadedFile::fake()->createWithContent('tasks.csv', 1, 'text/csv');
//
//        Livewire::test('task-list-component')
//            ->set('importFile', $file)
//            ->call('import');
//
//        $this->assertDatabaseHas('tasks', [
//            'Test Task'
//        ]);
//    }

    public function test_it_can_export_tasks_to_csv()
    {
        $user = User::factory()->create();

        Livewire::actingAs($user)
            ->test('task-list-component')
            ->call('export')
            ->assertFileDownloaded('tasks.xlsx');
    }

    public function test_it_can_upload_file_with_task()
    {
        Storage::fake('attachments');

        $attachmentName = substr(sha1(mt_rand()),17,6);

        $file = UploadedFile::fake()->image($attachmentName.'.jpg');

        $user = User::factory()->create();


        Livewire::actingAs($user)
            ->test('create-task-component')
            ->set('title', 'Test1')
            ->set('description', 'sample description')
            ->set('status', 'To Do')
            ->set('user_id', $user->id)
            ->set('attachment', $file)
            ->call('save');

        $task = Task::latest()->first();

        Storage::fake('attachments')->assertExists($task->attachment);
        $this->assertDatabaseHas('tasks', ['attachment_name' => $attachmentName]);
    }
}
