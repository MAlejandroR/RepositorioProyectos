import { defineConfig } from 'vite';
import laravel,{refreshPaths} from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/filament/app.css',
                'resources/js/app.js',
                 'resources/js/filament-chart-js-plugins.js', // Include the new file in the `input` array so it is built
            ],
            refresh:
                true

                      }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
    ],
});
