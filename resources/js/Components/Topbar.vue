<template>
    <div class="navbar bg-base-100">
        <div class="flex-1">
            <a class="btn btn-ghost normal-case text-xl">Admin Dashboard</a>
        </div>
        <div class="flex-none">
            <div class="dropdown dropdown-end">
                <label tabindex="0" class="btn btn-ghost btn-circle">
                    <div class="indicator">
                        <i class="fas fa-bell"></i>
                        <span class="badge badge-xs badge-primary indicator-item"></span>
                    </div>
                </label>
                <div tabindex="0" class="mt-3 card card-compact dropdown-content w-52 bg-base-100 shadow">
                    <div class="card-body">
                        <span class="font-bold text-lg">8 Notifications</span>
                        <span class="text-info">2 unread</span>
                        <div class="card-actions">
                            <button class="btn btn-primary btn-block">View all</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="dropdown dropdown-end">
                <label tabindex="0" class="btn btn-ghost btn-circle avatar">
                    <div class="w-10 rounded-full">
                        <img src="https://placeimg.com/80/80/people">
                    </div>
                </label>
                <ul tabindex="0"
                    class="mt-3 p-2 shadow menu menu-compact dropdown-content bg-base-100 rounded-box w-52">
                    <li>
                        <a class="justify-between">
                            Perfil
                            <span class="badge">Nuevo</span>
                        </a>
                    </li>
                    <li><a>Ajustes</a></li>
                    <li><a>Cerrar Sesión</a></li>
                </ul>
            </div>
        </div>
    </div>
</template>
<script setup lang="ts">
</script>
