<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 w-full">

                <h1 class="text-xl font-medium mb-6 text-gray-800">Task Details</h1>

                <div class="mb-4">
                    <h2 class="text-lg font-semibold text-gray-700">Title</h2>
                    <p class="text-gray-600">{{$title}}</p>
                </div>
                <div class="mb-4">
                    <h2 class="text-lg font-semibold text-gray-700">Description</h2>
                    <p class="text-gray-600">{{ $description }}</p>
                </div>
                <div class="mb-4">
                    <h2 class="text-lg font-semibold text-gray-700">Status</h2>
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $status === 'Done' ? 'bg-green-100 text-green-800' : ($status === 'In Progress' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                        {{ $status }}
                    </span>
                </div>

                <div class="mb-4">
                    <h2 class="text-lg font-semibold text-gray-700">Assigned To</h2>
                    <p class="text-gray-600">{{ $user->name }}</p>
                </div>

                <div class="mb-4">
                    <h2 class="text-lg font-semibold text-gray-700">Attachment</h2>
                    <a class="text-indigo-600" href="{{ Storage::url($attachment) }}">{{ $attachment_name }}.{{ $attachment_type }}</a>
                </div>

                <a href="{{ route('tasks.list') }}" class="text-indigo-600 hover:text-blue-800" wire:navigate>Back to Task List</a>

                <x-danger-button  wire:click="delete({{ $task_id }})">
                    Delete
                </x-danger-button>
            </div>
        </div>
    </div>
</div>
