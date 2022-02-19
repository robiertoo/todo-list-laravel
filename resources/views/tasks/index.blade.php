@extends('layouts.app')

@section('content')

<a class="btn btn-primary float-end" href="{{ route('tasks.create') }}">
    Nova Tarefa
</a>

@if ($tasks->isEmpty())
    <h3>Nenhuma tarefa cadastrada!</h3>
@else
    <h1>Tarefas</h1>

    @if (Session::has('message'))
        <div class="alert alert-success">
            {{ Session::get('message') }}
        </div>
    @endif

    <table class='table table-hover'>
        <thead class='table-dark'>
            <tr>
                <th>Tarefa</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tasks as $task)
                <tr>
                    <td>
                        @if (!$task->completed)
                            {{ $task->description }}
                        @else
                            <span class='text-muted text-decoration-line-through'>
                                {{ $task->description }}
                            </span>
                        @endif
                    </td>
                    <td>
                        <div class="d-flex">
                            @if (!$task->completed)
                                <a class='btn btn-primary btn-sm' href="{{ route('tasks.edit', $task) }}">Editar</a>
                                <form action="{{ route('tasks.complete', $task) }}" method="POST">
                                    @csrf
                                    @method('patch')
                                    <button class='btn btn-success btn-sm ms-1'>Marcar como feito</button>
                                </form>
                                <form action="{{ route('tasks.delete', $task) }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button class='btn btn-danger btn-sm ms-1'>Apagar</button>
                                </form>
                            @else
                                <span class='text-success'>
                                    Feita em {{ date('d/m/Y H:i', strtotime($task->updated_at)) }}
                                </span>
                            @endif
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif

{{-- {{ $tasks->links() }} --}}
    
@endsection