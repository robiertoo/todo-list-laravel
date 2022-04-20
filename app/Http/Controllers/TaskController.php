<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    private Task $model;

    public function __construct(Task $model)
    {
        $this->model = $model;
    }

    public function index(): View|Factory
    {
        //
        $itemsPerPage = auth()->user()->itemsPerPage;
        $tasks = $this->model->uncompleted()->paginate($itemsPerPage);
        return view('tasks.index', compact('tasks'));
    }

    public function showCompletedTasks(): View|Factory
    {
        $itemsPerPage = auth()->user()->itemsPerPage;
        $tasks = $this->model->completed()->paginate($itemsPerPage);
        return view('tasks.completedTasks', compact('tasks'));
    }

    public function create(): View|Factory
    {
        //
        $task = new Task;
        return view('tasks.create', compact('task'));
    }

    public function store(Request $request): RedirectResponse
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

    public function edit(Task $task): View|Factory
    {
        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, Task $task): RedirectResponse
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

    public function completeTask(Task $task): RedirectResponse
    {
        $task->completed = true;
        $task->save();
        return redirect()
            ->route('home')
            ->with('message', 'Tarefa salva como completa!');
    }

    public function destroy(Task $task): RedirectResponse
    {
        $task->delete();

        return redirect()
            ->route('home')
            ->with('message', 'Tarefa apagada com sucesso!');
    }

    public function restoreTask(Task $task): RedirectResponse
    {
        $task->completed = false;
        $task->save();

        return redirect()
            ->route("home")
            ->with('message', 'Tarefa restaurada com sucesso!');
    }
}
