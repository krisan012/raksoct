
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                @if(session()->has('message'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">{{ session('message') }}</div>
                @endif

                <div class="flex justify-between mb-4">
                    <div></div>
                    <div class="flex space-x-8">
                        <form wire:submit.prevent="import" enctype="multipart/form-data">
                            <input type="file" wire:model="importFile" class="mb-4">
                            @error('importFile') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                            <x-primary-button type="submit">
                                Import Tasks
                            </x-primary-button>
                        </form>
                        <form wire:submit.prevent="export">
                            <x-primary-button type="submit">
                                Export Tasks
                            </x-primary-button>
                        </form>
                    </div>

                </div>

                {{--    Task List--}}
                <table class="w-full">
                    <thead>
                    <tr>
                        <th class="w-1/3 px-6 py-3 border-b-2 border-gray-300 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-600 uppercase tracking-wider">Title</th>
                        <th class="w-1/3 px-6 py-3 border-b-2 border-gray-300 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-600 uppercase tracking-wider">Description</th>
                        <th class="w-1/3 px-6 py-3 border-b-2 border-gray-300 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-600 uppercase tracking-wider">Status</th>
                        <th class="w-1/3 px-6 py-3 border-b-2 border-gray-300 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-600 uppercase tracking-wider">User</th>
                        <th class="w-1/3 px-6 py-3 border-b-2 border-gray-300 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-600 uppercase tracking-wider">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($tasks as $task)
                        <tr>
                            <td>{{$task->title}}</td>
                            <td>{{$task->description}}</td>
                            <td>{{$task->status}}</td>
                            <td>{{$task->user->name}}</td>
                            <td>
                                <a href="{{ route('tasks.create', ['id' => $task->id]) }}" wire:navigate class="text-indigo-600 hover:text-blue-900">
                                    Edit
                                </a>
                                <a href="{{ route('tasks.view', ['id' => $task->id]) }}" wire:navigate class="text-indigo-700 hover:text-blue-900">
                                    View
                                </a>
                                <x-danger-button  wire:click="deleteTask({{ $task->id }})">
                                    Delete
                                </x-danger-button>
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>

                <a href="{{ route('tasks.create') }}" wire:navigate class="text-indigo-600 hover:text-blue-900">
                    Create New
                </a>
            </div>
        </div>
    </div>
</div>
