import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js', 'resources/js/detailProducts.js', 'resources/js/category.js', 'resources/js/product.js', 'resources/js/katalog.js'],
            refresh: true,
        }),
        tailwindcss(),
    ],
});
