@extends('layouts.app')

@section('content')

<a class="btn btn-primary float-end">
    Nova Tarefa
</a>

@if ($tasks->isEmpty())
    <h3>Nenhum registro encontrado!</h3>
@else
    <h1>Tarefas</h1>

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
                    <td>{{ $task->description }}</td>
                    <td></td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif

{{ $tasks->links() }}
    
@endsection