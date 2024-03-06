import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        "./node_modules/flowbite/**/*.js"
    ],

    theme: {
        colors: {
            transparent: 'transparent',
            current: 'currentColor',
            primary: {
                DEFAULT: '#0ea5e9',
                soft: '#7dd3fc'
            }
          },
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
        
    },

    plugins: [
        forms,
        require('flowbite/plugin')
    ],
};
