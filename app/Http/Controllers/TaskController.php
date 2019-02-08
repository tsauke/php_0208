<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;


class TaskController extends Controller
{
    //ユーザーの全タスクを表示
    public function index(Request $request)
    {
    $tasks = Task::orderBy('created_at', 'asc')->get();

    return view('tasks', [
    'tasks' => $tasks
    ]);
 }
    //新タスクの作成
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|max:255',
        ]);

        $task = new Task;
        $task->name = $request->name;
        $task->save();

        return redirect('/tasks');
    }
    //指定タスクの削除
    public function destroy(Request $request, Task $task)
    {
        $task->delete();

        return redirect('/tasks');
    }
}