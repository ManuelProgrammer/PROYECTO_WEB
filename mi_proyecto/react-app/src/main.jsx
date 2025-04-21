// main.jsx

import React from 'react'
import ReactDOM from 'react-dom/client'

import App from './App'
import AdminPanel from './components/Admin/AdminPanel'
import Wishlist from './components/Wishlist'
import Carrito from './components/Carrito'
import ProductForm from './components/Admin/ProductForm'
import Destacados from './components/Destacados' // ✅ Nuevo componente importado

const el =
  document.getElementById('admin-panel-root') ||
  document.getElementById('wishlist-root') ||
  document.getElementById('carrito-root') ||
  document.getElementById('product-form-root') ||
  document.getElementById('destacados-root') || // ✅ Montaje para productos destacados
  document.getElementById('root')

if (el?.id === 'admin-panel-root') {
  ReactDOM.createRoot(el).render(<AdminPanel />)
} else if (el?.id === 'wishlist-root') {
  ReactDOM.createRoot(el).render(<Wishlist />)
} else if (el?.id === 'carrito-root') {
  ReactDOM.createRoot(el).render(<Carrito />)
} else if (el?.id === 'product-form-root') {
  ReactDOM.createRoot(el).render(
    <ProductForm
      producto={null}
      onClose={() => console.log('cerrar')}
      onSave={() => console.log('guardar')}
    />
  )
} else if (el?.id === 'destacados-root') {
  ReactDOM.createRoot(el).render(<Destacados />) // ✅ Renderizado de productos destacados
} else if (el?.id === 'root') {
  ReactDOM.createRoot(el).render(<App />)
} else {
  console.warn('⚠️ No se encontró un contenedor válido para montar React.')
}
