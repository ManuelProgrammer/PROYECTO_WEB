import React, { useState } from 'react'
import Sidebar from './Sidebar'
import Dashboard from './Dashboard'
import UserList from './UserList'
import ProductList from './ProductList'
import FacturaList from './FacturaList'

export default function AdminPanel() {
  const [view, setView] = useState('dashboard')

  return (
    <div className="d-flex">
      <Sidebar onNavigate={setView} />
      <div className="p-4 flex-grow-1 w-100">
        {view === 'dashboard' && <Dashboard />}
        {view === 'usuarios' && <UserList />}
        {view === 'productos' && <ProductList />}
        {view === 'facturas' && <FacturaList />}
      </div>
    </div>
  )
}
