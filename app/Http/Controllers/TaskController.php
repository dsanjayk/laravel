<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    public function index()
    {
        return Task::all();
    }

    public function store(Request $request)
    {
        $task = Task::create(
            [
                'title'=>$request->title,
                'completed'=>(boolean)$request->completed,
            ]
        );
        return response()->json($task, 201);
    }

    public function show($id)
    {
        return Task::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $task = Task::findOrFail($id);
        $task->update(
            [ 'title'=>$request->title,
                'completed'=>(boolean)$request->completed,
            ]
        );
        return response()->json($task, 200);
    }

    public function destroy($id)
    {
        Task::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
    
}
