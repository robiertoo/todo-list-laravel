<div class="d-flex justify-content-center">
    <div class="card shadow p-4 col col-md-6">
        <form action="{{ $task->exists ? route('tasks.update', $task) : route('tasks.store') }}" method="POST">
            @csrf
            @if ($task->exists)
                @method('patch')
            @endif
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text">Descrição</div>
                </div>
                <input type="text" name='description' class='form-control' value='{{ old('description', $task->description) }}'>
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