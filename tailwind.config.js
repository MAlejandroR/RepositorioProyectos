import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            maxWidth: {
                'custom': '300px',
            },
            maxHeight: {
                'custom': '200px',
            },
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors:{
                "header":"rgb(231, 117, 30)"
            },
            height:{
              "10v": "10vh"
            },
            backgroundImage: {
                'hero-pattern': "url('/images/background_main.jpg')",
            },
            gradientColorStops: theme => ({
                ...theme('colors'),
                'end': '#ffffff', // Blanco
                'start': 'rgb(231, 117, 30)', // Nuestro naranja personalizado
                // 'end': '#ffffff', // Blanco
            }),
        },
    },

    plugins: [forms, typography, require("daisyui")],
};
