<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    private Task $model;

    public function __construct(Task $model)
    {
        $this->model = $model;
    }

    public function index()
    {
        //
        $itemsPerPage = auth()->user()->itemsPerPage;
        $tasks = $this->model->uncompleted()->paginate($itemsPerPage);
        return view('tasks.index', compact('tasks'));
    }

    public function showCompletedTasks()
    {
        $itemsPerPage = auth()->user()->itemsPerPage;
        $tasks = $this->model->completed()->paginate($itemsPerPage);
        return view('tasks.completedTasks', compact('tasks'));
    }

    public function create()
    {
        //
        $task = new Task;
        return view('tasks.create', compact('task'));
    }

    public function store(Request $request)
    {
        //
        $request->validate([
            'description' => 'required|string'
        ]);

        $task = new Task([
            'description' => $request->description,
            'user_id' => auth()->user()->id,
        ]);

        $task->save();
        return redirect()
            ->route('home')
            ->with('message', 'Tarefa cadastrada com sucesso!');
    }

    public function show(Task $task)
    {
        //
    }

    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, Task $task)
    {
        //
        $request->validate([
            'description' => "string|required"
        ]);
        
        $task->description = $request->description;
        $task->save();
        return redirect()
            ->route('home')
            ->with('message', 'Tarefa alterada com sucesso!');
    }

    public function completeTask(Task $task)
    {
        $task->completed = true;
        $task->save();
        return redirect()
            ->route('home')
            ->with('message', 'Tarefa salva como completa!');
    }

    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()
            ->route('home')
            ->with('message', 'Tarefa apagada com sucesso!');
    }

    public function restoreTask(Task $task)
    {
        $task->completed = false;
        $task->save();

        return redirect(route("home"), 201)
            ->with('message', 'Tarefa restaurada com sucesso!');
    }
}
