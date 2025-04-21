import React from 'react'

export default function Sidebar({ onNavigate }) {
  return (
    <div className="bg-dark text-white p-3" style={{ minWidth: '200px', height: '100vh' }}>
      <h5>🛠 Admin</h5>
      <ul className="nav flex-column">
        <li><button className="btn btn-link text-white" onClick={() => onNavigate('dashboard')}>📊 Dashboard</button></li>
        <li><button className="btn btn-link text-white" onClick={() => onNavigate('usuarios')}>👥 Usuarios</button></li>
        <li><button className="btn btn-link text-white" onClick={() => onNavigate('productos')}>🛒 Productos</button></li>
        <li><button className="btn btn-link text-white" onClick={() => onNavigate('facturas')}>🧾 Facturas</button></li>
      </ul>
    </div>
  )
}
