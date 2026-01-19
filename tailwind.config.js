import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            colors: {
                brand: {
                    primary: '#7c3aed',
                    blue: '#2563eb',
                    cyan: '#06b6d4',
                    sky: '#7dd3fc',
                    orange: '#f97316',
                    amber: '#f59e0b',
                    danger: '#ef4444'
                }
            },
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            boxShadow: {
                'dashboard': '0 8px 24px rgba(31,41,55,0.08)',
            },
        },

    },

    plugins: [forms],
};
