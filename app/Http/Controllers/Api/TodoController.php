<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TodoResource;
use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $todos = auth()->user()->todos;
        return response()->json([
            'status' => true,
            'message' => 'Successfully fetched todos',
            'data' => TodoResource::collection($todos),
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'description' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()
            ], 422);
        }

        $todo = new Todo([
            'name' => $request->name,
            'description' => $request->description,
        ]);
        auth()->user()->todos()->save($todo);

        return response()->json([
            'status' => true,
            'message' => 'Successfully created todo',
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $todo = auth()->user()->todos()->find($id);
        if (!$todo) {
            return response()->json([
                'status' => false,
                'message' => 'Todo not found',
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'Successfully fetched todo',
            'data' => TodoResource::make($todo),
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $todo = auth()->user()->todos()->find($id);
        if (!$todo) {
            return response()->json([
                'status' => false,
                'message' => 'Todo not found',
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'description' => 'required|string',
            'status' => 'required|string|in:On Progress,Done'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()
            ], 422);
        }

        $todo->name = $request->name;
        $todo->description = $request->description;
        $todo->status = $request->status;
        $todo->save();

        return response()->json([
            'status' => true,
            'message' => 'Successfully updated todo',
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $todo = auth()->user()->todos()->find($id);
        if (!$todo) {
            return response()->json([
                'status' => false,
                'message' => 'Todo not found',
            ], 404);
        }

        $todo->delete();

        return response()->json([
            'status' => true,
            'message' => 'Successfully deleted todo',
        ], 200);
    }

    // search by name or description or status
    public function search(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'search' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()
            ], 422);
        }

        $user = auth()->user();

        $todos = $user->todos()
            ->where(function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->search . '%')
                    ->orWhere('description', 'like', '%' . $request->search . '%')
                    ->orWhere('status', 'like', '%' . $request->search . '%');
            })
            ->get();

        return response()->json([
            'status' => true,
            'message' => 'Successfully fetched todos',
            'data' => TodoResource::collection($todos),
        ], 200);
    }
}
