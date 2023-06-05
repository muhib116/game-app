const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Arial'],
            },
            colors: {
                fave: {
                    '50': '#effaf3',
                    '100': '#d8f3e0',
                    '200': '#b4e6c5',
                    '300': '#83d2a4',
                    '400': '#5abb85',
                    '500': '#2e9b62',
                    '600': '#1f7c4d',
                    '700': '#18643f',
                    '800': '#164f34',
                    '900': '#13412c',
                    '950': '#092519',
                },
            }
        },
    },

    plugins: [require('@tailwindcss/forms')],
};
