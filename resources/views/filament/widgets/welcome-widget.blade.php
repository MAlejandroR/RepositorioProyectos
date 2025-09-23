@php
    $user = filament()->auth()->user();
    $rol = $user->roles->pluck('name')->first() ?? 'Usuario';

@endphp
<x-filament-widgets::widget>
    <x-filament::section class="space-y-6">

        {{-- Header --}}
        <div class="text-center space-y-2">
            <h2 class="text-3xl font-bold text-gray-800 dark:text-gray-100">
                👋 Hola, {{ $user->name }}
            </h2>
            <p class="text-sm text-gray-600 dark:text-gray-400">
                Rol: <span class="font-semibold">{{ $rol }}</span> <br>
                Último acceso: {{ $user->last_login_at?->format('d/m/Y H:i') ?? now()->format('d/m/Y H:i') }}
            </p>
        </div>

        {{-- Quick actions --}}
        <div class="flex justify-center gap-3">
            <x-filament::button tag="a" href="{{ route('filament.admin.resources.projects.index') }}" color="primary">
                Ver proyectos
            </x-filament::button>
            <x-filament::button tag="a" href="#" color="success">
                Generar informe
            </x-filament::button>
        </div>

        {{-- Roles & Actions --}}
        <div class="grid md:grid-cols-2 gap-6">
            <x-filament::section heading="Roles y permisos">
                <ul class="text-sm space-y-1">
                    <li>✅ Ver proyectos</li>
                    <li>✅ Generar informes</li>
                    <li>❌ Crear profesor <br>
                        <span class="text-xs text-gray-500">→ Solicitar al administrador</span>
                    </li>
                </ul>
            </x-filament::section>

            <x-filament::section heading="Acciones rápidas">
                <ul class="text-sm space-y-1">
                    <li><a href="#" class="text-primary-600 hover:underline">Mis Proyectos</a></li>
                    <li><a href="#" class="text-primary-600 hover:underline">Buscar proyectos</a></li>
                    <li><a href="#" class="text-primary-600 hover:underline">Subir documento</a></li>
                    <li><a href="#" class="text-primary-600 hover:underline">Ver informes</a></li>
                </ul>
            </x-filament::section>
        </div>

        {{-- Stats & Notifications --}}
        <div class="grid md:grid-cols-2 gap-6">
            <x-filament::section heading="Estadísticas">
                <ul class="text-sm space-y-1">
                    <li>• Proyectos activos: 8</li>
                    <li>• Entregas pendientes: 3</li>
                    <li>• Alumnos en ciclo: 24</li>
                </ul>
            </x-filament::section>

            <x-filament::section heading="Notificaciones">
                <ul class="text-sm space-y-1">
                    <li>- Alumno X subió archivo</li>
                    <li>- Solicitud de alta</li>
                    <li>- Proyecto Y pendiente</li>
                </ul>
            </x-filament::section>
        </div>

        {{-- Links --}}
        <x-filament::section heading="Enlaces útiles / Ayuda" class="text-center">
            <div class="flex flex-wrap justify-center gap-3">
                <x-filament::button tag="a" href="#" color="gray" size="sm">Manual de usuario</x-filament::button>
                <x-filament::button tag="a" href="#" color="gray" size="sm">FAQ</x-filament::button>
                <x-filament::button tag="a" href="#" color="gray" size="sm">Soporte</x-filament::button>
                <x-filament::button tag="a" href="#" color="gray" size="sm">Google Drive</x-filament::button>
            </div>
        </x-filament::section>

    </x-filament::section>
</x-filament-widgets::widget>
