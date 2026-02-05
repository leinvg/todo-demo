<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Tareas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: #f5f5f5;
        }

        h1 {
            color: #333;
        }

        .form-container {
            background: white;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 30px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        input[type="text"],
        textarea {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

        .todo-item {
            background: white;
            padding: 15px;
            margin: 10px 0;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .todo-item.completed {
            opacity: 0.6;
            text-decoration: line-through;
        }

        .todo-info {
            flex: 1;
        }

        .todo-actions {
            display: flex;
            gap: 10px;
        }

        .delete-btn {
            background-color: #f44336;
        }

        .delete-btn:hover {
            background-color: #da190b;
        }

        .complete-btn {
            background-color: #008CBA;
        }

        .complete-btn:hover {
            background-color: #007399;
        }
    </style>
</head>

<body>
    <h1>📝 Mi Lista de Tareas</h1>

    <!-- Formulario para crear nueva tarea -->
    <div class="form-container">
        <h2>Nueva Tarea</h2>
        <form action="{{ route('todos.store') }}" method="POST">
            @csrf
            <input type="text" name="title" placeholder="Título de la tarea" required>
            <textarea name="description" placeholder="Descripción (opcional)" rows="3"></textarea>
            <button type="submit">Agregar Tarea</button>
        </form>
    </div>

    <!-- Lista de tareas -->
    <div>
        <h2>Tareas ({{ count($todos) }})</h2>
        @forelse($todos as $todo)
            <div class="todo-item {{ $todo->completed ? 'completed' : '' }}">
                <div class="todo-info">
                    <h3>{{ $todo->title }}</h3>
                    @if ($todo->description)
                        <p>{{ $todo->description }}</p>
                    @endif
                    <small>Creada: {{ $todo->created_at->format('d/m/Y H:i') }}</small>
                </div>
                <div class="todo-actions">
                    <!-- Botón para marcar como completada -->
                    <form action="{{ route('todos.update', $todo) }}" method="POST">
                        @csrf
                        @method('PUT')
                        @if (!$todo->completed)
                            <input type="hidden" name="completed" value="1">
                            <button type="submit" class="complete-btn">✓ Completar</button>
                        @else
                            <button type="submit" class="complete-btn">↻ Reabrir</button>
                        @endif
                    </form>

                    <!-- Botón para eliminar -->
                    <form action="{{ route('todos.destroy', $todo) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="delete-btn" onclick="return confirm('¿Eliminar esta tarea?')">🗑️
                            Eliminar</button>
                    </form>
                </div>
            </div>
        @empty
            <p style="text-align: center; color: #999;">No hay tareas aún. ¡Crea tu primera tarea arriba!</p>
        @endforelse
    </div>
</body>

</html>
