<template>
    <div class="drawer">
        <!--drawer, clase para tener un menú lateral que se  puede
mostrar u ocultar según el valor del input checkbox (checked o nada)-->
        <input id="my-drawer" type="checkbox"
               class="md:checked drawer-toggle"/>
        <div class="drawer-content">
            <!-- Page content here -->
            <label for="my-drawer" class="btn btn-primary
            drawer-button">> </label>
        </div>
        <div class="drawer-side">
            <label for="my-drawer" aria-label="close sidebar"
                   class="drawer-overlay">

            </label>
            <ul class="menu bg-base-200 text-base-content
             min-h-full w-80 p-4">
                <!-- Sidebar content here -->
                <li><a>Sidebar Item 1</a></li>
                <li><a>Sidebar Item 2</a></li>
            </ul>
        </div>
    </div>
</template>
<script setup lang="ts">
</script>
