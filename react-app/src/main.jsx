import React from 'react'
import ReactDOM from 'react-dom/client'

// Componentes
import App from './App'
import AdminPanel from './components/Admin/AdminPanel'
import Wishlist from './components/Wishlist'

// Detectar en qué div vamos a renderizar
const el =
  document.getElementById('admin-panel-root') ||
  document.getElementById('wishlist-root') ||
  document.getElementById('root')

// Renderizar el componente correcto según el ID
if (el?.id === 'admin-panel-root') {
  ReactDOM.createRoot(el).render(<AdminPanel />)
} else if (el?.id === 'wishlist-root') {
  ReactDOM.createRoot(el).render(<Wishlist />)
} else if (el?.id === 'root') {
  ReactDOM.createRoot(el).render(<App />)
} else {
  console.warn('⚠️ No se encontró un contenedor válido para montar React.')
}
