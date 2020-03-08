<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(){
        $tasks = Task::all();
        return view('todolist',compact('tasks'));
    }

    public function store(Request $request){

        $request->validate([
            'title'=>'required|max:150',
            'description'=>'required',
        ]);

        $task = new Task();
        $task->title = $request->input('title');
        $task->description = $request->input('description');
        $task->done = false;

        $task->save();

        return redirect()->route('home');
    }

    public function update(){

    }

    public function delete($id){
        $task = Task::findOrFail($id);
        $task->delete();
        return redirect()->route('home');
    }

    public function show($id){
        $task = Task::findOrFail($id);

        return view('todolist-edit',compat('task'));
    }

    public function updateState($id){
        $task = Task::findOrFail($id);
        ($task->done)?$task->update(['done'=>false]):$task->update(['done'=>true]);

        return redirect()->route('home');
    }
}
