<?php

namespace App\Http\Controllers;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function createTask(Request $request){
        $incomingFields = $request->validate([
            'title' => 'required',
            'description'=>'required',
            'deadline'=>'required'
        ]);

        $incomingFields['title'] = strip_tags($incomingFields['title']);
        $incomingFields['description'] = strip_tags($incomingFields['description']);
        $incomingFields['deadline'] = strip_tags($incomingFields['deadline']);
        $incomingFields['user_id'] = auth()->id();

        Task::create($incomingFields);
        return redirect('/');
    }

    public function showEditScreen(Task $task){

        if (auth()->user()->id !== $task['user_id']) {
            return redirect('/');
        }
        return view('edit-task', ['task' => $task]);
    }

    public function updateTask(Task $task, Request $request){
        if (auth()->user()->id !== $task['user_id']) {
            return redirect('/');
        }
        
        $incomingFields = $request->validate([
            'title'=>'required',
            'description'=>'required',
            'deadline'=>'required'
        ]);

        $incomingFields['title'] = strip_tags($incomingFields['title']);
        $incomingFields['description'] = strip_tags($incomingFields['description']);
        $incomingFields['deadline'] = strip_tags($incomingFields['deadline']);

        $task->update($incomingFields);
        return redirect('/');
    }

    public function deleteTask(Task $task) {
        if (auth()->user()->id == $task['user_id']) {
            $task->delete();
        }
        return redirect('/');
    }

    public function toggleCompleted(Task $task)
    {

    if (auth()->id() !== $task->user_id) {
        return redirect('/');
    }


    $task->completed = !$task->completed;
    $task->save();

    return redirect('/');
    }
}
