import { defineConfig } from 'vite'
import react from '@vitejs/plugin-react'
import { resolve } from 'path'

export default defineConfig({
  root: resolve(__dirname, 'src'), // 🧠 Tu código fuente está en /src
  base: '/mi_proyecto/public/react/', // 🌐 Ruta base para que funcione correctamente con PHP
  plugins: [react()],
  build: {
    outDir: resolve(__dirname, 'public/react'), // 📁 Salida para assets de producción
    emptyOutDir: true, // Limpia antes de compilar
    rollupOptions: {
      input: resolve(__dirname, 'src/main.jsx'), // 🟢 Entrada principal
    },
  },
  server: {
    port: 5173,
    open: true,
    proxy: {
      '/mi_proyecto/api': {
        target: 'http://localhost',
        changeOrigin: true,
        secure: false,
      }
    }
  }
})
