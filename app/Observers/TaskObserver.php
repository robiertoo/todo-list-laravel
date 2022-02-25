<?php

namespace App\Observers;

use App\Models\Task;
use Illuminate\Support\Facades\Log;

class TaskObserver
{
    /**
     * Handle the Task "created" event.
     *
     * @param  \App\Models\Task  $task
     * @return void
     */
    public function created(Task $task)
    {
        //
        Log::info('Tarefa cadastrada.', [
            'user' => auth()->user(),
            'task' => $task
        ]);
    }

    /**
     * Handle the Task "updated" event.
     *
     * @param  \App\Models\Task  $task
     * @return void
     */
    public function updated(Task $task)
    {
        //
    }

    public function updating(Task $task)
    {
        $taskBefore = $task->getOriginal();
        Log::info("Tarefa atualizada.", [
            'user' => auth()->user(),
            'taskBefore' => $taskBefore,
            'taskAfter' => $task
        ]);
    }

    public function deleting(Task $task)
    {
        $taskBefore = $task->getOriginal();
        Log::info("Tarefa apagada.", [
            'user' => auth()->user(),
            'task' => $taskBefore
        ]);
    }

    /**
     * Handle the Task "deleted" event.
     *
     * @param  \App\Models\Task  $task
     * @return void
     */
    public function deleted(Task $task)
    {
        //
    }

    /**
     * Handle the Task "restored" event.
     *
     * @param  \App\Models\Task  $task
     * @return void
     */
    public function restored(Task $task)
    {
        //
    }

    /**
     * Handle the Task "force deleted" event.
     *
     * @param  \App\Models\Task  $task
     * @return void
     */
    public function forceDeleted(Task $task)
    {
        //
    }
}
