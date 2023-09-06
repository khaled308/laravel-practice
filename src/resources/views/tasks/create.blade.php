@extends('layouts.main')

@section('content')
<div class="py-6">
    <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <h2 class="text-2xl font-semibold mb-4">Add Task</h2>

                <form method="POST" action="{{ route('tasks.store') }}">
                    @csrf

                    <div class="mb-4">
                        <label for="title" class="block text-gray-700 font-semibold mb-2">Title</label>
                        <input type="text" name="title" id="title" class="w-full px-4 py-2 border rounded-lg @error('title') border-red-500 @enderror" required>
                        @error('title')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="description" class="block text-gray-700 font-semibold mb-2">Description</label>
                        <textarea name="description" id="description" class="w-full px-4 py-2 border rounded-lg @error('description') border-red-500 @enderror" rows="4"></textarea>
                        @error('description')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="completed" class="inline-flex items-center text-gray-700 font-semibold">
                            <input type="checkbox" name="is_complete" id="completed" class="form-checkbox">
                            <span class="ml-2">Completed</span>
                        </label>
                    </div>

                    <div class="mt-6">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">
                            Add Task
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
