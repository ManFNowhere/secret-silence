import tailwindcss from '@tailwindcss/vite';
import laravel from 'laravel-vite-plugin';
import { defineConfig } from 'vite';

export default defineConfig({
    plugins: [
        laravel([
            'resources/js/app.js',
        ]),
        tailwindcss(),
    ],
    server: {
        host: '127.0.0.1', 
    },
});
