<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $todos = auth()->user()->todos()->latest()->get();

        return view('pages.todos.index', compact('todos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.todos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        Todo::create([
            'user_id' => auth()->id(),
            'name' => $request->name,
            'description' => $request->description,
        ]);

        $toastr = [
            'alert-type' => 'success',
            'message' => 'Todo created successfully!',
        ];

        return redirect()->route('todos.index')->with($toastr);
    }

    /**
     * Display the specified resource.
     */
    public function show(Todo $todo)
    {
        return view('pages.todos.show', compact('todo'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Todo $todo)
    {
        return view('pages.todos.edit', compact('todo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Todo $todo)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $todo->update([
            'name' => $request->name,
            'description' => $request->description,
            'status' => $request->status ?? 'DONE',
        ]);

        $toastr = [
            'alert-type' => 'success',
            'message' => 'Todo updated successfully!',
        ];

        return redirect()->route('todos.index')->with($toastr);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Todo $todo)
    {
        $todo->delete();

        $toastr = [
            'alert-type' => 'success',
            'message' => 'Todo deleted successfully!',
        ];

        return redirect()->route('todos.index')->with($toastr);
    }

    public function markAsDone(Todo $todo)
    {
        $todo->update([
            'status' => 'Done',
        ]);

        $toastr = [
            'alert-type' => 'success',
            'message' => 'Todo marked as done!',
        ];

        return redirect()->route('todos.index')->with($toastr);
    }
}
