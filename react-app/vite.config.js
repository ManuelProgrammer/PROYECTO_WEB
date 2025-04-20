import { defineConfig } from 'vite'
import react from '@vitejs/plugin-react'
import { resolve } from 'path'

export default defineConfig({
  // 🧠 Directorio raíz donde están tus archivos fuente
  root: resolve(__dirname, 'src'),

  // 🌐 URL base para que los assets carguen correctamente desde PHP
  base: '/mi_proyecto/public/react/',

  // 📦 Plugin para soporte React JSX
  plugins: [react()],

  build: {
    // 📁 Carpeta donde Vite generará los assets
    outDir: resolve(__dirname, '../public/react'),

    emptyOutDir: true, // 🧹 Limpia antes del build para evitar archivos viejos

    // 🎯 Entrada del proyecto (si usas varios, aquí puedes agregar más)
    rollupOptions: {
      input: {
        main: resolve(__dirname, 'src/main.jsx'),
        // wishlist: resolve(__dirname, 'src/wishlist.jsx'), <-- si fuera otro entry separado
      }
    }
  },

  server: {
    port: 5173,
    open: true,

    // 🔁 Redirección de peticiones API al backend PHP
    proxy: {
      '/mi_proyecto/api': {
        target: 'http://localhost',
        changeOrigin: true,
        secure: false,
      }
    }
  }
})
