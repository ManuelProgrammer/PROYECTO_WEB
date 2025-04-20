import React from 'react'
import ReactDOM from 'react-dom/client'

// Componentes principales
import App from './App'
import AdminPanel from './components/Admin/AdminPanel'
import Wishlist from './components/Wishlist'

// 👉 Detectar contenedor React desde HTML
const elAdmin = document.getElementById('admin-panel-root')
const elWishlist = document.getElementById('wishlist-root')
const elApp = document.getElementById('root')

// 🔄 Renderizado condicional según ID del contenedor
if (elAdmin) {
  ReactDOM.createRoot(elAdmin).render(<AdminPanel />)
} else if (elWishlist) {
  ReactDOM.createRoot(elWishlist).render(<Wishlist />)
} else if (elApp) {
  ReactDOM.createRoot(elApp).render(<App />)
} else {
  console.warn('⚠️ No se encontró un contenedor válido para montar React.')
}
