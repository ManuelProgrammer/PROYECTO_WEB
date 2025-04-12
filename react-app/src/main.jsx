import React from 'react'
import ReactDOM from 'react-dom/client'
import App from './App'
import AdminPanel from './components/Admin/AdminPanel'

const el = document.getElementById('root') || document.getElementById('admin-panel-root')

if (el?.id === 'admin-panel-root') {
  ReactDOM.createRoot(el).render(<AdminPanel />)
} else if (el?.id === 'root') {
  ReactDOM.createRoot(el).render(<App />)
}
