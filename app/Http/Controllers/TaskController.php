<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(){
        $tasks = Task::all();
        return response()->json($tasks);
    }

    public function store(Request $request){
        $request->validate([
            'title'=>'bail|required|unique:tasks|max:150',
            'description'=>'required',
        ]);

        $task = new Task();
        $task->title = $request->input('title');
        $task->description = $request->input('description');
        $task->done = false;

        $task->save;

    }

    public function update(){

    }

    public function delete($id){
        $task = Task::findOrFail($id);
        $task->delete();
    }

    public function show($id){
        $task = Task::findOrFail($id);

        return response()->json($task);
    }
}
