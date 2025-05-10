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
        host: '0.0.0.0',    // Gunakan 0.0.0.0 untuk memungkinkan akses dari perangkat lain jika perlu
        port: 5173,          // Pastikan port ini sesuai
        https: false,        // Matikan HTTPS untuk pengembangan lokal
    },
});
