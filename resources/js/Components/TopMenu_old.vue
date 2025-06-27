<script setup lang="ts">

</script>

<template>
    <!--Desktop Diseño para pantalla de 768 y mas-->
    <div class="hidden md:block md:bg-header h-5v p-1">

        <!-- Enlaces de texto -->
        <div class="flex gap-4 flex-row justify-end items-center  max-h-full p-1 text-white mr-40">
            <div
                class="flex flex-row space-x-1 hover:scale-105 hover:underline cursor-pointer transition-transform duration-200 items-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                     stroke="currentColor"
                     class="w-4 h-4 font-bold ">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75"/>
                </svg>
                <span class="">  Contacto    </span>
            </div>
            <div
                class="flex flex-row space-x-1 hover:scale-105 hover:underline cursor-pointer transition-transform duration-200 items-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                     stroke="currentColor"
                     class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 0 1-2.25 2.25M16.5 7.5V18a2.25 2.25 0 0 0 2.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 0 0 2.25 2.25h13.5M6 7.5h3v3H6v-3Z"/>
                </svg>


                <span>
                    Actualidad
                </span>
            </div>

            <!-- Iconos sociales -->
            <div
                class="flex flex-row space-x-1 hover:scale-105 hover:underline cursor-pointer transition-transform duration-200 items-center">

                <a href="https://es-es.facebook.com/cpilosenlaces/"
                   class="p-2 rounded border border-white hover:bg-white hover:text-orange-600 transition-all duration-200"
                   target="_blank" rel="noopener noreferrer" title="Facebook" aria-label="Facebook">
                    <!-- Facebook SVG -->
                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M22.675 0h-21.35C.6 0 0 .6 0 1.326v21.348C0 23.4.6 24
        1.326 24H12.82v-9.294H9.692v-3.622h3.128V8.413c0-3.1
        1.894-4.788 4.659-4.788 1.325 0 2.466.099 2.797.143v3.24l-1.92.001c-1.504
        0-1.796.715-1.796 1.763v2.31h3.587l-.467
        3.622h-3.12V24h6.116C23.4 24 24 23.4 24
        22.674V1.326C24 .6 23.4 0 22.675 0z"/>
                    </svg>
                </a>


                <a href="#"
                   class="p-2 rounded border border-white hover:bg-white hover:text-orange-600 transition-all duration-200">
                    <!-- Twitter SVG -->
                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M24 4.557a9.83 9.83 0 01-2.828.775
          4.932 4.932 0 002.165-2.724 9.864 9.864 0
          01-3.127 1.195 4.916 4.916 0 00-8.384
          4.482A13.94 13.94 0 011.671 3.149 4.917
          4.917 0 003.195 9.723a4.902 4.902 0
          01-2.229-.616v.06a4.918 4.918 0 003.946
          4.827 4.902 4.902 0 01-2.224.084 4.918
          4.918 0 004.588 3.417A9.867 9.867 0
          010 19.54a13.94 13.94 0 007.548 2.209c9.057
          0 14.01-7.513 14.01-14.01 0-.213-.005-.425-.014-.636A10.012
          10.012 0 0024 4.557z"/>
                    </svg>
                </a>

                <a href="#"
                   class="p-2 rounded border border-white hover:bg-white hover:text-orange-600 transition-all duration-200">
                    <!-- Vimeo SVG -->
                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M23.977 6.235c-.1 2.13-1.58 5.043-4.457
          8.738-2.973 3.853-5.487 5.78-7.54
          5.78-1.273 0-2.35-1.17-3.23-3.514-.59-2.168-1.18-4.335-1.77-6.503-.655-2.354-1.36-3.53-2.116-3.53-.162
          0-.73.342-1.704 1.027L1.032 7.046C2.06 6.087
          3.272 5.128 4.667 4.17 6.25 3.033 7.406 2.5
          8.135 2.5c1.31 0 2.118.78 2.423
          2.34.327 1.706.558 2.77.693 3.19.388
          1.77.812 2.654 1.27 2.654.36 0 .898-.564
          1.61-1.69.71-1.127 1.09-1.986
          1.137-2.58.103-.975-.28-1.464-1.144-1.464-.41
          0-.832.095-1.27.284.845-2.77 2.454-4.097
          4.83-3.983 1.756.104 2.58 1.21
          2.47 3.316z"/>
                    </svg>
                </a>
            </div>
        </div>
    </div>

    <!--Mobbile Diseño para pantalla menor de  768 -->
    <div class="block md:hidden  bg-header h-6v text-sm text-white ">

        <!-- Enlaces de texto -->
        <div class="flex gap-2 flex-row justify-center items-center text-white ">
            <!-- Iconos sociales -->
            <div
                class="flex flex-row space-x-1 hover:scale-105 hover:underline cursor-pointer transition-transform duration-200 items-center">

                <a href="https://es-es.facebook.com/cpilosenlaces/"
                   class="rounded border border-white hover:bg-white hover:text-orange-600 transition-all duration-200"
                   target="_blank" rel="noopener noreferrer" title="Facebook" aria-label="Facebook">
                    <!-- Facebook SVG -->
                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M22.675 0h-21.35C.6 0 0 .6 0 1.326v21.348C0 23.4.6 24
        1.326 24H12.82v-9.294H9.692v-3.622h3.128V8.413c0-3.1
        1.894-4.788 4.659-4.788 1.325 0 2.466.099 2.797.143v3.24l-1.92.001c-1.504
        0-1.796.715-1.796 1.763v2.31h3.587l-.467
        3.622h-3.12V24h6.116C23.4 24 24 23.4 24
        22.674V1.326C24 .6 23.4 0 22.675 0z"/>
                    </svg>
                </a>


                <a href="#"
                   class="p-2 rounded border border-white hover:bg-white hover:text-orange-600 transition-all duration-200">
                    <!-- Twitter SVG -->
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M24 4.557a9.83 9.83 0 01-2.828.775
          4.932 4.932 0 002.165-2.724 9.864 9.864 0
          01-3.127 1.195 4.916 4.916 0 00-8.384
          4.482A13.94 13.94 0 011.671 3.149 4.917
          4.917 0 003.195 9.723a4.902 4.902 0
          01-2.229-.616v.06a4.918 4.918 0 003.946
          4.827 4.902 4.902 0 01-2.224.084 4.918
          4.918 0 004.588 3.417A9.867 9.867 0
          010 19.54a13.94 13.94 0 007.548 2.209c9.057
          0 14.01-7.513 14.01-14.01 0-.213-.005-.425-.014-.636A10.012
          10.012 0 0024 4.557z"/>
                    </svg>
                </a>

                <a href="#"
                   class="p-2 rounded border border-white hover:bg-white hover:text-orange-600 transition-all duration-200">
                    <!-- Vimeo SVG -->
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M23.977 6.235c-.1 2.13-1.58 5.043-4.457
          8.738-2.973 3.853-5.487 5.78-7.54
          5.78-1.273 0-2.35-1.17-3.23-3.514-.59-2.168-1.18-4.335-1.77-6.503-.655-2.354-1.36-3.53-2.116-3.53-.162
          0-.73.342-1.704 1.027L1.032 7.046C2.06 6.087
          3.272 5.128 4.667 4.17 6.25 3.033 7.406 2.5
          8.135 2.5c1.31 0 2.118.78 2.423
          2.34.327 1.706.558 2.77.693 3.19.388
          1.77.812 2.654 1.27 2.654.36 0 .898-.564
          1.61-1.69.71-1.127 1.09-1.986
          1.137-2.58.103-.975-.28-1.464-1.144-1.464-.41
          0-.832.095-1.27.284.845-2.77 2.454-4.097
          4.83-3.983 1.756.104 2.58 1.21
          2.47 3.316z"/>
                    </svg>
                </a>
            </div>

            <div
                class="flex flex-row space-x-1 hover:scale-105 hover:underline cursor-pointer transition-transform duration-200 items-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                     stroke="currentColor"
                     class="w-4 h-4 font-bold ">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75"/>
                </svg>
                <span class="">
        Contacto
      </span>
            </div>
            <div
                class="flex flex-row space-x-1 hover:scale-105 hover:underline cursor-pointer transition-transform duration-200 items-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                     stroke="currentColor"
                     class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 0 1-2.25 2.25M16.5 7.5V18a2.25 2.25 0 0 0 2.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 0 0 2.25 2.25h13.5M6 7.5h3v3H6v-3Z"/>
                </svg>


                <span>
                    Actualidad
                </span>
            </div>

        </div>
    </div>

</template>
<style scoped>

</style>
