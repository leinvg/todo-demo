# Todo App - Demo en Laravel

Una aplicación simple de **lista de tareas** hecha con Laravel y SQLite para aprender cómo funciona el framework.

## ¿Qué puedes hacer?

✓ Crear nuevas tareas
✓ Ver todas tus tareas
✓ Marcar tareas como completadas
✓ Eliminar tareas

---

## Requisitos

Antes de empezar, necesitas tener instalado en tu computadora:

- **PHP 8.3+** ([descargar](https://www.php.net/downloads))
- **Composer** ([descargar](https://getcomposer.org/download/))
- **Node.js 18+** ([descargar](https://nodejs.org/))
- **Git** (opcional, solo si quieres clonar desde GitHub)

**Nota:** SQLite viene incluido con PHP, no necesitas instalarlo por separado.

---

## Instalación (5 pasos)

### 1. Clonar o descargar el proyecto

```bash
git clone https://github.com/tu-usuario/todo-demo.git
cd todo-demo
```

O si descargaste el ZIP, descomprímelo y abre la carpeta.

### 2. Instalar las dependencias de Laravel

```bash
composer install
```

Esto descarga todas las librerías que Laravel necesita.

### 3. Instalar dependencias de front-end (Tailwind/Vite)

```bash
npm install
```

Esto instala las librerías para compilar Tailwind.

### 4. Configurar la aplicación

```bash
cp .env.example .env
php artisan key:generate
```

La primera línea copia la configuración. La segunda genera una clave de seguridad.

### 5. Crear la base de datos y cargar datos de ejemplo

```bash
touch database/database.sqlite
php artisan migrate
php artisan db:seed
```

- `touch database/database.sqlite` - Crea el archivo de la base de datos
- `php artisan migrate` - Crea las tablas
- `php artisan db:seed` - Llena con 5 tareas de ejemplo

---

## Ejecutar la aplicación

Abre dos terminales:

**Terminal 1**
```bash
php artisan serve
```

**Terminal 2**
```bash
npm run dev
```

Luego abre tu navegador en: **http://localhost:8000/**

¡Listo! Ya puedes ver y usar la aplicación.

---

## Estructura del Proyecto

- **app/Models/Todo.php** - El modelo que representa una tarea
- **app/Http/Controllers/TodoController.php** - La lógica que maneja las tareas
- **resources/views/todos/index.blade.php** - La página que ves en el navegador
- **routes/web.php** - Las rutas (URLs) de la aplicación
- **database/migrations/** - "Recetas" para crear las tablas
- **database/seeders/** - Datos de ejemplo para la base de datos

---

## Licencia

Este es un proyecto de aprendizaje. Úsalo libremente.
