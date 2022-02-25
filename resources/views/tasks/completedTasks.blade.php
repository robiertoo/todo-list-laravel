@extends('layouts.app')

@section('content')

<a class="btn btn-primary float-end" href="{{ route('tasks.create') }}" title='Nova tarefa'>
    <x-fas-plus class='icon' />
</a>

@if ($tasks->isEmpty())
    <h3>Nenhuma tarefa realizada!</h3>
@else
    <h1>
        Tarefas
        <x-fas-tasks class='icon ms-2' />
    </h1>

    @if (Session::has('message'))
        <div class="alert alert-success">
            {{ Session::get('message') }}
        </div>
    @endif

    <table class='table table-hover'>
        <thead class='table-dark'>
            <tr>
                <th>Tarefa</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tasks as $task)
                <tr>
                    <td>
                        <span class='text-muted text-decoration-line-through'>
                            {{ $task->description }}
                        </span>
                    </td>
                    <td>
                        <div class="d-flex align-items-center">
                            <span class='text-success'>
                                Feita em {{ date('d/m/Y H:i', strtotime($task->updated_at)) }}
                            </span>

                            <form action="{{ route('tasks.restore', $task) }}" method='post'>
                                @csrf
                                @method('patch')
                                <button class='btn' title='Restaurar'> 
                                    <x-fas-trash-restore class='text-info icon' />
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @endif
    
    <div class="w-100 d-flex justify-content-center">
        {{ $tasks->links() }}
    </div>
    
@endsection