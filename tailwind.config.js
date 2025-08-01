import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';
import preset from './vendor/filament/support/tailwind.config.preset';


/** @type {import('tailwindcss').Config} */
export default {
    // presets:[preset],

    content: [
        './app/Filament/**/*.php',
        './resources/views/filament/**/*.blade.php',
        './vendor/filament/**/*.blade.php',
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
                "header":"rgb(231, 117, 30)",
                "main":"rgba(207,201,223,1)"
            },
            height:{
              "2v": "2vh",
              "3v": "3vh",
              "4v": "4vh",
              "5v": "5vh",
              "10v": "10vh",
              "11v": "11vh",
              "12v": "12vh",
              "13v": "13vh",
              "14v": "14vh",
              "15v": "15vh",
              "20v": "20vh",
              "25v": "25vh",
              "30v": "30vh",
            },
            width:{
                "72v":"72"
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
