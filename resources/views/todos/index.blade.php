<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Tareas</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-slate-950 text-slate-100 antialiased">
    <div class="relative isolate overflow-hidden">
        <div
            class="pointer-events-none fixed inset-0 bg-[radial-gradient(900px_circle_at_20%_-10%,rgba(59,130,246,0.18),transparent_55%),radial-gradient(700px_circle_at_90%_10%,rgba(16,185,129,0.18),transparent_50%),radial-gradient(1000px_circle_at_50%_120%,rgba(14,165,233,0.12),transparent_55%)]">
        </div>

        <main class="relative mx-auto w-full max-w-6xl px-6 py-14 sm:py-20">
            <section class="lg:grid lg:grid-cols-[384px_1fr] lg:gap-12">
                <aside class="lg:fixed lg:inset-y-0 lg:w-sm lg:py-20 flex flex-col gap-8">
                    <div>
                        <span
                            class="inline-flex items-center gap-2 rounded-full border border-white/10 bg-white/5 px-4 py-1 text-xs font-medium uppercase tracking-wider text-slate-300">
                            Demo Laravel
                        </span>
                        <h1 class="mt-4 text-3xl font-semibold tracking-tight text-slate-50 sm:text-4xl">
                            Mi lista de tareas
                        </h1>
                        <p class="mt-3 text-sm text-slate-300 sm:text-base">
                            Captura ideas y mantente enfocado. Todo se guarda en SQLite de manera local.
                        </p>
                    </div>

                    <div class="h-px w-full bg-linear-to-r from-white/10 via-white/6 to-white/3"></div>

                    <div>
                        <h2 class="text-lg font-semibold text-white">Nueva tarea</h2>
                        <p class="mt-1 text-sm text-slate-300">Describe lo que quieres completar hoy.</p>

                        <form action="{{ route('todos.store') }}" method="POST" class="mt-5 grid gap-4">
                            @csrf
                            <label class="grid gap-2">
                                <span
                                    class="text-xs font-semibold uppercase tracking-widest text-slate-400">Titulo</span>
                                <input type="text" name="title" placeholder="Ej. Preparar demo de Laravel" required
                                    class="w-full rounded-2xl border border-white/10 bg-slate-950/80 px-4 py-3 text-sm text-white placeholder:text-slate-500 shadow-inner shadow-black/20 focus:border-emerald-400/60 focus:outline-none focus:ring-2 focus:ring-emerald-400/30">
                            </label>
                            <label class="grid gap-2">
                                <span
                                    class="text-xs font-semibold uppercase tracking-widest text-slate-400">Descripcion</span>
                                <textarea name="description" rows="4" placeholder="Agrega detalles si quieres..."
                                    class="w-full resize-none rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-sm text-white placeholder:text-slate-500 shadow-inner shadow-black/20 focus:border-sky-400/60 focus:outline-none focus:ring-2 focus:ring-sky-400/30"></textarea>
                            </label>
                            <button type="submit"
                                class="group inline-flex items-center justify-center gap-2 rounded-lg bg-yellow-400/20 px-5 py-3 text-sm font-semibold text-yellow-200 transition hover:bg-yellow-400/30 cursor-pointer">
                                <span>Agregar tarea</span>
                                <span class="text-base transition group-hover:translate-x-0.5">→</span>
                            </button>
                        </form>
                    </div>
                </aside>

                <div class="col-start-2 space-y-6">
                    <div class="rounded-3xl border border-white/10 bg-white/5 p-6 sm:p-8">
                        <div class="flex items-center justify-between">
                            <h2 class="text-lg font-semibold text-white">Resumen</h2>
                            <span class="text-xs uppercase tracking-widest text-slate-400">{{ count($todos) }}
                                total</span>
                        </div>
                        <div class="mt-4 grid gap-3 sm:grid-cols-3">
                            <div class="rounded-2xl border border-white/10 bg-slate-900/60 px-4 py-3">
                                <p class="text-xs uppercase tracking-widest text-slate-400">Total</p>
                                <p class="mt-1 text-2xl font-semibold text-white">{{ count($todos) }}</p>
                            </div>
                            <div class="rounded-2xl border border-white/10 bg-slate-900/60 px-4 py-3">
                                <p class="text-xs uppercase tracking-widest text-slate-400">Completadas</p>
                                <p class="mt-1 text-2xl font-semibold text-white">
                                    {{ $todos->where('completed', true)->count() }}
                                </p>
                            </div>
                            <div class="rounded-2xl border border-white/10 bg-slate-900/60 px-4 py-3">
                                <p class="text-xs uppercase tracking-widest text-slate-400">Pendientes</p>
                                <p class="mt-1 text-2xl font-semibold text-white">
                                    {{ $todos->where('completed', false)->count() }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <div>
                        <div class="flex items-center justify-between">
                            <h2 class="text-xl font-semibold text-white">Tareas</h2>
                            <span class="text-sm text-slate-400">{{ count($todos) }} en total</span>
                        </div>

                        <div class="mt-5 grid gap-4">
                            @forelse($todos as $todo)
                                <div
                                    class="group rounded-3xl border border-white/10 bg-white/5 p-5 transition hover:-translate-y-0.5 hover:border-emerald-400/30 hover:bg-white/10">
                                    <div class="flex flex-col gap-4 md:flex-row md:items-start md:justify-between">
                                        <div class="space-y-2">
                                            <div class="flex items-center gap-3">
                                                <span
                                                    class="inline-flex h-10 w-10 items-center justify-center rounded-2xl bg-slate-900/60 text-lg">
                                                    {{ $todo->completed ? '✓' : '•' }}
                                                </span>
                                                <div>
                                                    <h3
                                                        class="text-lg font-semibold text-white {{ $todo->completed ? 'line-through opacity-70' : '' }}">
                                                        {{ $todo->title }}
                                                    </h3>
                                                    <p class="text-xs text-slate-400">Creada:
                                                        {{ $todo->created_at->format('d/m/Y H:i') }}</p>
                                                </div>
                                            </div>
                                            @if ($todo->description)
                                                <p
                                                    class="max-w-2xl text-sm text-slate-300 {{ $todo->completed ? 'line-through opacity-70' : '' }}">
                                                    {{ $todo->description }}
                                                </p>
                                            @endif
                                        </div>
                                        <div class="flex flex-wrap gap-2">
                                            <form action="{{ route('todos.update', $todo) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                @if (!$todo->completed)
                                                    <input type="hidden" name="completed" value="1">
                                                    <button type="submit"
                                                        class="rounded-2xl border border-emerald-400/30 bg-emerald-400/20 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-emerald-200 transition hover:bg-emerald-400/30">
                                                        Completar
                                                    </button>
                                                @else
                                                    <button type="submit"
                                                        class="rounded-2xl border border-sky-400/30 bg-sky-400/20 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-sky-200 transition hover:bg-sky-400/30">
                                                        Reabrir
                                                    </button>
                                                @endif
                                            </form>
                                            <form action="{{ route('todos.destroy', $todo) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="rounded-2xl border border-rose-400/30 bg-rose-400/20 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-rose-200 transition hover:bg-rose-400/30"
                                                    onclick="return confirm('¿Eliminar esta tarea?')">
                                                    Eliminar
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="rounded-3xl border border-white/10 bg-white/5 px-6 py-12 text-center">
                                    <p class="text-sm text-slate-300">No hay tareas aún. ¡Crea tu primera tarea arriba!
                                    </p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>
</body>

</html>
