import { defineConfig } from 'vite'
import laravel from 'laravel-vite-plugin'

export default defineConfig({
  plugins: [
    laravel({
      input: ['resources/css/app.css', 'resources/js/app.js'],
      refresh: true,
    }),
  ],
  server: {
    host: '0.0.0.0',     // para escuchar dentro del contenedor
    port: 5173,
    strictPort: true,
    hmr: {
      host: 'localhost', // lo que usará el navegador
      port: 5173,
    },
    // en Windows/Docker a veces hace falta:
    watch: { usePolling: true },
  },
})
