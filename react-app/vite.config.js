// vite.config.js
import { defineConfig } from 'vite'
import react from '@vitejs/plugin-react'
import { resolve } from 'path'

export default defineConfig({
  base: '/mi_proyecto/public/react/', // URL base para producción
  plugins: [react()],
  build: {
    outDir: resolve(__dirname, '../public/react'), // ⚠️ Cambiamos el directorio de salida
    emptyOutDir: true, // Limpia el destino antes del build
  }
})
