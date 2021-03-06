@extends('layouts.app')

@section('content')

<a class="btn btn-primary float-end" href="{{ route('tasks.create') }}" title='Nova tarefa'>
    <x-fas-plus class='icon' />
</a>

@if ($tasks->isEmpty())
    <h3>Nenhuma tarefa não realizada encontrada!</h3>
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
                                <a class='btn' href="{{ route('tasks.edit', $task) }}" title='Editar'>
                                    <x-fas-edit class='icon text-primary' />
                                </a>
                                <form action="{{ route('tasks.complete', $task) }}" method="POST">
                                    @csrf
                                    @method('patch')
                                    <button class='btn' title='Marcar como feito'>
                                        <x-fas-check class='icon text-success' />
                                    </button>
                                </form>
                                <form action="{{ route('tasks.delete', $task) }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button class='btn' title='Apagar'>
                                        <x-fas-trash class='icon text-danger' />
                                    </button>
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

<div class="d-flex justify-content-center">
    {{ $tasks->links() }}
</div>

@include('tasks.itemsPerPage')

<script>
    window.onload = () => {
        const dismissAlert = () => {
            let alert = document.querySelector('.alert');
            if(alert == null) return false;

            setTimeout(() => alert.classList.add('d-none'), 2000);
        }

        dismissAlert();
    }
</script>

@endsection