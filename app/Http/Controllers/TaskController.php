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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $tasks = $this->model->uncompleted()->paginate(10);
        return view('tasks.index', compact('tasks'));
    }

    public function showCompletedTasks()
    {
        $tasks = $this->model->completed()->paginate(10);
        return view('tasks.completedTasks', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $task = new Task;
        return view('tasks.create', compact('task'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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
        return redirect(route('home'), 201)
            ->with('message', 'Tarefa cadastrada com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        //
        $request->validate([
            'description' => "string|required"
        ]);
        
        $task->description = $request->description;
        $task->save();
        return redirect(route('home'), 201)
            ->with('message', 'Tarefa alterada com sucesso!');
    }

    public function completeTask(Task $task)
    {
        $task->completed = true;
        $task->save();
        return redirect(route('home'), 201)
            ->with('message', 'Tarefa salva como completa!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $task->delete();

        return redirect(route('home'), 201)
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
