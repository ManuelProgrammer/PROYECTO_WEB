import React from 'react'
import ReactDOM from 'react-dom/client'

import App from './App'
import AdminPanel from './components/Admin/AdminPanel'
import Wishlist from './components/Wishlist'
import Carrito from './components/Carrito' // ✅ Nuevo componente: Carrito

// 🧠 Detectar qué contenedor está presente en el DOM
const el =
  document.getElementById('admin-panel-root') ||
  document.getElementById('wishlist-root') ||
  document.getElementById('carrito-root') || // ✅ Carrito de compras
  document.getElementById('root')

// 🚀 Montar el componente React adecuado según el ID del contenedor
if (el?.id === 'admin-panel-root') {
  ReactDOM.createRoot(el).render(<AdminPanel />)
} else if (el?.id === 'wishlist-root') {
  ReactDOM.createRoot(el).render(<Wishlist />)
} else if (el?.id === 'carrito-root') {
  ReactDOM.createRoot(el).render(<Carrito />)
} else if (el?.id === 'root') {
  ReactDOM.createRoot(el).render(<App />)
} else {
  console.warn('⚠️ No se encontró un contenedor válido para montar React.')
}
