import tailwindcss from '@tailwindcss/vite';
import laravel from 'laravel-vite-plugin';
import { defineConfig } from 'vite';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        tailwindcss(),
    ],
    server: {
        host: 'localhost',
        cors: {
            origin: [
                'http://localhost:3000',
                'https://localhost:3000',
                'https://secret-silence-main-zwyhwc.laravel.cloud', // Cloud origin
            ]
        }
    },
});
