<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    // Mostrar todas las tareas
    public function index()
    {
        $todos = Todo::all();
        return view('todos.index', compact('todos'));
    }

    // Guardar una nueva tarea
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
        ]);

        Todo::create([
            'title' => $request->title,
            'description' => $request->description,
            'completed' => false,
        ]);

        return redirect()->route('todos.index');
    }

    // Actualizar una tarea (marcar como completada o no)
    public function update(Request $request, Todo $todo)
    {
        $todo->update([
            'completed' => $request->has('completed'),
        ]);

        return redirect()->route('todos.index');
    }

    // Eliminar una tarea
    public function destroy(Todo $todo)
    {
        $todo->delete();
        return redirect()->route('todos.index');
    }
}
