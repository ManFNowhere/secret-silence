import laravel from 'laravel-vite-plugin';
import { defineConfig } from 'vite';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
    server: {
        https: true,
        host: '0.0.0.0',
    },
    base: '/build/', // pastikan ini cocok dengan lokasi asset
});
