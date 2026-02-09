<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Tareas</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-slate-950 text-slate-50 antialiased">
    <div class="relative isolate overflow-hidden">
        <div
            class="pointer-events-none fixed inset-0 bg-[radial-gradient(900px_circle_at_20%_-10%,rgba(59,130,246,0.18),transparent_55%),radial-gradient(700px_circle_at_90%_10%,rgba(16,185,129,0.18),transparent_50%),radial-gradient(1000px_circle_at_50%_120%,rgba(14,165,233,0.12),transparent_55%)]">
        </div>

        <main class="relative mx-auto w-full max-w-6xl px-6 py-14 sm:py-20">
            <section class="lg:grid lg:grid-cols-[320px_1fr] lg:gap-16">
                <aside class="lg:fixed lg:inset-y-0 lg:w-xs lg:py-20 flex flex-col">
                    <span
                        class="self-start rounded-lg border border-white/10 bg-white/3 px-3 py-1.5 text-xs tracking-wider font-mono text-slate-400">
                        Laravel
                    </span>
                    <h1 class="mt-8 text-2xl font-semibold tracking-tight text-slate-50">
                        Lista de tareas
                    </h1>
                    <p class="mt-2 text-sm text-slate-300">
                        Captura ideas y mantente enfocado. Todo se guarda en SQLite de manera local.
                    </p>

                    <div class="h-px bg-white/10 my-8"></div>

                    <h2 class="text-lg font-semibold text-slate-50">Nueva tarea</h2>
                    <p class="mt-2 text-sm text-slate-300">Describe lo que quieres completar hoy.</p>

                    <form action="{{ route('todos.store') }}" method="POST"
                        class="mt-8 grid gap-4 text-sm *:[label]:grid *:[label]:gap-2 **:[label>span]:text-slate-400">
                        @csrf
                        <label>
                            <span>Titulo</span>
                            <input type="text" name="title" placeholder="Ej. Preparar demo de Laravel" required
                                class="rounded-lg border border-white/10 hover:border-emerald-400/30 bg-white/3 hover:bg-white/7 px-4 py-3 text-slate-50 placeholder:text-slate-500 focus:border-emerald-400/60 focus:outline-none focus:ring-2 focus:ring-emerald-400/30 focus:bg-white/7 transition">
                        </label>
                        <label>
                            <span>Descripción</span>
                            <textarea name="description" rows="4" placeholder="Agrega detalles..."
                                class="resize-none rounded-lg border border-white/10 hover:border-emerald-400/30 bg-white/3 hover:bg-white/7 px-4 py-3 text-slate-50 placeholder:text-slate-500 focus:border-emerald-400/50 focus:outline-none focus:ring-2 focus:ring-emerald-400/30 focus:bg-white/7 transition"></textarea>
                        </label>
                        <button type="submit"
                            class="group flex items-center justify-center gap-2 rounded-lg bg-emerald-400/20 px-5 py-3 font-semibold text-emerald-300 transition hover:bg-emerald-400/25 cursor-pointer border border-emerald-400/30">
                            <span>Agregar tarea</span>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="size-4 transition translate-y-px group-hover:translate-x-0.5">
                                <path d="M18 8L22 12L18 16" />
                                <path d="M2 12H22" />
                            </svg>
                        </button>
                    </form>
                </aside>

                <div class="col-start-2 space-y-6">
                    <div>
                        <div class="flex items-center justify-between">
                            <h2 class="text-sm font-semibold uppercase tracking-widest text-slate-400">Pendientes</h2>
                            <p class="text-sm text-slate-400 px-2">{{ $todos->where('completed', false)->count() }}</p>
                        </div>

                        @php
                            $pendingTodos = $todos->where('completed', false);
                            $completedTodos = $todos->where('completed', true);
                        @endphp

                        <div class="mt-4 grid gap-4">
                            @forelse($pendingTodos as $todo)
                                <div
                                    class="group rounded-lg border border-white/10 bg-white/3 p-6 transition hover:border-emerald-400/30 hover:bg-white/7">
                                    <div class="flex flex-col gap-4 md:flex-row md:items-start md:justify-between">
                                        <div class="space-y-2">
                                            <div>
                                                <h3 class="text-lg font-semibold text-white">{{ $todo->title }}</h3>
                                                <p class="text-xs text-slate-400">Creada:
                                                    {{ $todo->created_at->format('d/m/Y H:i') }}</p>
                                            </div>
                                            @if ($todo->description)
                                                <p class="max-w-2xl text-sm text-slate-300">
                                                    {{ $todo->description }}
                                                </p>
                                            @endif
                                        </div>
                                        <div class="grid gap-2">
                                            <form action="{{ route('todos.update', $todo) }}" method="POST"
                                                class="inline-flex items-center justify-center">
                                                @csrf
                                                @method('PUT')
                                                <label class="inline-flex items-center cursor-pointer">
                                                    <input type="checkbox" name="completed" value="1"
                                                        class="sr-only peer" onchange="this.form.submit()">
                                                    <span
                                                        class="text-slate-300 transition group-hover:text-emerald-200 peer-checked:hidden">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                            height="24" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="2"
                                                            stroke-linecap="round" stroke-linejoin="round"
                                                            class="size-6">
                                                            <circle cx="12" cy="12" r="10" />
                                                        </svg>
                                                    </span>
                                                    <span
                                                        class="hidden text-emerald-300 transition peer-checked:inline-flex">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                            height="24" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="2"
                                                            stroke-linecap="round" stroke-linejoin="round"
                                                            class="size-6">
                                                            <path d="M21.801 10A10 10 0 1 1 17 3.335" />
                                                            <path d="m9 11 3 3L22 4" />
                                                        </svg>
                                                    </span>
                                                </label>
                                            </form>
                                            <form action="{{ route('todos.destroy', $todo) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="rounded-lg p-2 text-xs font-semibold uppercase tracking-widest opacity-0 group-hover:opacity-100 text-slate-400 hover:text-rose-300 transition cursor-pointer"
                                                    onclick="return confirm('¿Eliminar esta tarea?')">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round" class="size-6 transition">
                                                        <path d="M10 11v6" />
                                                        <path d="M14 11v6" />
                                                        <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6" />
                                                        <path d="M3 6h18" />
                                                        <path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                @if ($completedTodos->isEmpty())
                                    <div class="rounded-lg border border-white/10 bg-white/5 px-6 py-12 text-center">
                                        <p class="text-sm text-slate-300">No hay tareas aún. ¡Crea tu primera tarea
                                            arriba!
                                        </p>
                                    </div>
                                @endif
                            @endforelse

                            @if ($completedTodos->isNotEmpty())
                                <div class="h-px bg-white/10 my-8"></div>
                                <div class="flex items-center justify-between pt-2">
                                    <h3 class="text-sm font-semibold uppercase tracking-widest text-slate-400">
                                        Completadas
                                    </h3>
                                    <p class="text-sm text-slate-400 px-2">{{ $completedTodos->count() }}</p>
                                </div>

                                @foreach ($completedTodos as $todo)
                                    <div
                                        class="group rounded-lg border border-white/10 bg-white/3 p-5 transition hover:border-emerald-400/30 hover:bg-white/7">
                                        <div class="flex flex-col gap-4 md:flex-row md:items-start md:justify-between">
                                            <div class="space-y-2">
                                                <div>
                                                    <h3
                                                        class="text-lg font-semibold text-white line-through opacity-50">
                                                        {{ $todo->title }}
                                                    </h3>
                                                    <p class="text-xs text-slate-400">Creada:
                                                        {{ $todo->created_at->format('d/m/Y H:i') }}</p>
                                                </div>
                                                @if ($todo->description)
                                                    <p
                                                        class="max-w-2xl text-sm text-slate-300 line-through opacity-50">
                                                        {{ $todo->description }}
                                                    </p>
                                                @endif
                                            </div>
                                            <div class="grid gap-2">
                                                <form action="{{ route('todos.update', $todo) }}" method="POST"
                                                    class="inline-flex items-center">
                                                    @csrf
                                                    @method('PUT')
                                                    <label class="inline-flex items-center cursor-pointer">
                                                        <input type="checkbox" name="completed" value="1"
                                                            class="sr-only peer" onchange="this.form.submit()"
                                                            checked>
                                                        <span class="text-slate-300 transition peer-checked:hidden">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                height="24" viewBox="0 0 24 24" fill="none"
                                                                stroke="currentColor" stroke-width="2"
                                                                stroke-linecap="round" stroke-linejoin="round"
                                                                class="size-6">
                                                                <circle cx="12" cy="12" r="10" />
                                                            </svg>
                                                        </span>
                                                        <span
                                                            class="hidden text-emerald-300 transition peer-checked:inline-flex">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                height="24" viewBox="0 0 24 24" fill="none"
                                                                stroke="currentColor" stroke-width="2"
                                                                stroke-linecap="round" stroke-linejoin="round"
                                                                class="size-6">
                                                                <path d="M21.801 10A10 10 0 1 1 17 3.335" />
                                                                <path d="m9 11 3 3L22 4" />
                                                            </svg>
                                                        </span>
                                                    </label>
                                                </form>
                                                <form action="{{ route('todos.destroy', $todo) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="rounded-lg p-2 text-xs font-semibold uppercase tracking-widest opacity-0 group-hover:opacity-100 text-slate-400 hover:text-rose-300 transition cursor-pointer"
                                                        onclick="return confirm('¿Eliminar esta tarea?')">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                            height="24" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="2"
                                                            stroke-linecap="round" stroke-linejoin="round"
                                                            class="size-6 transition">
                                                            <path d="M10 11v6" />
                                                            <path d="M14 11v6" />
                                                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6" />
                                                            <path d="M3 6h18" />
                                                            <path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2" />
                                                        </svg>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>
</body>

</html>
