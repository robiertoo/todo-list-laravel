<div class="d-flex justify-content-center">
    <div class="card shadow p-4 col col-md-6">
        @if ($task->exists)
            <form action="{{ route('tasks.update', $task) }}" method="POST">
                @method('patch')
        @else
            <form action="{{ route('tasks.store') }}" method="POST">
        @endif
            @csrf
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text">Descrição</div>
                </div>
                <input type="text" name='description' class='form-control' 
                    value='{{ old('description', $task->description) }}' required>
            </div>
            @error('description')
                <div class="text-danger">
                    {{ $message }}
                </div>
            @enderror
            <button class='btn btn-primary float-end mt-1'>
                {{ $task->exists ? "Editar" : "Cadastrar" }}
            </button>
        </form>
    </div>
</div>