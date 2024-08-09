

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <h1 class="text-2xl font-bold mb-6">create Task</h1>

                @if(session()->has('message'))
                    <div class="bg-green text-green-700 p-4 rounded mb-6">
                        {{ session('message') }}
                    </div>
                @endif

                <form wire:submit.prevent="save">
                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-2">Title</label>
                        <input type="text" wire:model="title" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @error('title') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-2">Description</label>
                        <textarea wire:model.live="description" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Description"></textarea>
                        @error('description')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-2">Status</label>
                        <select wire:model.live="status" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="To Do">To Do</option>
                            <option value="In Progress">In Progress</option>
                            <option value="Done">Done</option>
                        </select>
                        @error('status')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-2">User</label>
                        <select wire:model.live="user_id" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-300">
                            <option value="To Do">Choose User</option>
                            @foreach($users as $user)
                                <option value="{{$user->id}}">{{$user->name}}</option>
                            @endforeach
                        </select>
                        @error('user_id')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-2">Attachment</label>
                        <input type="file" wire:model="attachment" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-300">
                        @if($existingAttachment)
                            <div class="mt-2">
                                <a href="{{ Storage::url($existingAttachment) }}">View Current Attachment</a>
                            </div>
                        @endif
                        @error('attachment')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <x-primary-button class="mt-3">{{ $task_id ? 'Update' : 'Create New'}}</x-primary-button>
                </form>
            </div>
        </div>
    </div>
</div>
