import React from 'react'
import ReactDOM from 'react-dom/client'
import App from './App'
import AdminPanel from './components/Admin/AdminPanel'
import Wishlist from './components/Wishlist' // ✅ Importamos el nuevo componente

// Detectamos qué componente montar
const el =
  document.getElementById('admin-panel-root') ||
  document.getElementById('wishlist-root') ||
  document.getElementById('root')

// Renderizado según ID
if (el?.id === 'admin-panel-root') {
  ReactDOM.createRoot(el).render(<AdminPanel />)
} else if (el?.id === 'wishlist-root') {
  ReactDOM.createRoot(el).render(<Wishlist />)
} else if (el?.id === 'root') {
  ReactDOM.createRoot(el).render(<App />)
}
