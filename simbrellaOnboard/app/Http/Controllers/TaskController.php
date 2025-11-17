<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
     public function store(Request $request)
    {
        

        $task = Task::create([
            'title' => $request->title,
            'description' => $request->description
        ]);

    
        return response()->json([
            'message' => 'Task created successfully',
            'task' => $task
        ]);
    }
}
