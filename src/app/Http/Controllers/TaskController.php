<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::paginate(10);
        return view('tasks.index', [
            'tasks' => $tasks
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:tasks|min:3|max:30'
        ]);

        Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'is_complete' => $request->is_complete ? true : false
        ]);

        return redirect()->route('tasks.index')->with('Task Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        return view('tasks.edit', [
            'task' => $task
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        $request->validate([
            'title' => 'required|min:3|max:30|unique:tasks,title,' . $task->id
        ]);

        $task->update([
            'title' => $request->title,
            'description' => $request->description,
            'is_complete' => $request->is_complete ? true : false
        ]);

        return redirect()->route('tasks.index')->with('Task Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('tasks.index')->with('Task Deleted Successfully');
    }

    public function toggle(Task $task){
        $task->is_complete = !$task->is_complete;
        $task->save();

        return response()->json(['is_complete' => $task->is_complete]);
    }
}
