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
        // Di production, sebaiknya tidak menggunakan host 127.0.0.1
        // Jika perlu akses dari berbagai perangkat, bisa menggunakan '0.0.0.0'
        // host: '0.0.0.0', // Atau kamu bisa menghapus ini jika tidak perlu akses khusus
        port: 5173, // Sesuaikan port sesuai kebutuhan
        https: true, // Sesuaikan apakah perlu HTTPS di server produksi
    },
    build: {
        outDir: 'public/build',  // Pastikan output build ditempatkan di folder yang sesuai
        manifest: true,           // Agar manifest dibuat untuk produksi
    }
});
