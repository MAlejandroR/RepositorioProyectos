<template>
    <div class="drawer drawer-mobile">
        <input id="my-drawer" type="checkbox" class="drawer-toggle">
        <div class="drawer-content flex flex-col">
            <!-- Main content here -->
        </div>
        <div class="drawer-side">
            <label for="my-drawer" class="drawer-overlay"></label>
            <ul class="menu p-4 overflow-y-auto w-80 bg-base-200 text-base-content">
                <li><a>Dashboard</a></li>
                <li><a>Usuarios</a></li>
                <li><a>Pedidos</a></li>
                <li><a>Productos</a></li>
                <li><a>Ajustes</a></li>
                <li><a>Soporte</a></li>
            </ul>
        </div>
    </div>
</template>
<script setup lang="ts">
</script>
