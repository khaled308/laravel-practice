@extends('layouts.main')

@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-auto shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <div class="flex justify-between mb-4">
                    <h2 class="text-lg font-semibold">Task List</h2>
                    <a href="{{ route('tasks.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Add Task
                    </a>
                </div>
                <table class="min-w-full divide-y divide-gray-200 overflow-auto">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                #
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Title
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Description
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Completed
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($tasks as $task)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ $loop->iteration }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ Str::limit($task->title, 20) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ Str::limit($task->description, 30) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <button id="task-{{$task->id}}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded toggle-task">
                                    {{ $task->is_complete ? 'Toggle Off' : 'Toggle On' }}
                                </button>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <a href="{{route("tasks.edit", $task->id)}}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                    Edit
                                </a>
                                <a href="#" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded"
                                onclick="event.preventDefault(); document.getElementById('delete-form-{{ $task->id }}').submit();">
                                Delete
                                </a>
                                <form id="delete-form-{{ $task->id }}" action="{{route('tasks.destroy', $task->id)}}" method="post" class="hidden">
                                    @csrf
                                    @method('delete')
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="p-10 flex items-center justify-center">
    {{ $tasks->links() }}
</div>
@push('scripts')
    <script>
        document.querySelectorAll('.toggle-task').forEach(t =>{
            t.addEventListener('click', ()=>{
                const id = t.id.split('-')[1]
                const url = `{{ route('tasks.toggle', ['task' => ':taskId']) }}`.replace(':taskId', id);
                
                fetch(url).then(res => res.json()).then(data => {
                    t.innerHTML = data.is_complete ? 'Toggle Off' : 'Toggle On'
                })
            })
        })
    </script>
@endpush
@endsection
