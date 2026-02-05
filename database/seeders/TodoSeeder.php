<?php

namespace Database\Seeders;

use App\Models\Todo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TodoSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Todo::create([
            'title' => 'Aprender controladores en Laravel',
            'description' => 'Entender cómo los controladores manejan las peticiones y comunican con modelos y vistas.',
            'completed' => true,
        ]);

        Todo::create([
            'title' => 'Crear migraciones para las tablas',
            'description' => 'Usar migraciones para crear la estructura de la base de datos de forma versionada.',
            'completed' => true,
        ]);

        Todo::create([
            'title' => 'Implementar CRUD en la aplicación',
            'description' => 'Crear, leer, actualizar y eliminar tareas. Las 4 operaciones fundamentales.',
            'completed' => false,
        ]);

        Todo::create([
            'title' => 'Diseñar la interfaz de usuario',
            'description' => 'Crear vistas HTML y CSS para que la aplicación sea bonita e intuitiva.',
            'completed' => false,
        ]);

        Todo::create([
            'title' => 'Subir el proyecto a GitHub',
            'description' => 'Preparar el repositorio con README y documentación para compartir.',
            'completed' => false,
        ]);
    }
}
