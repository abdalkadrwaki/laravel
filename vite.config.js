import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';  // استخدام import

export default defineConfig({
  plugins: [
    laravel({
      input: ['resources/css/app.css', 'resources/js/app.js'],
    }),
  ],
});
