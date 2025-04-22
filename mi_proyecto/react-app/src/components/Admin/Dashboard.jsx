import React, { useEffect, useState } from 'react'
import StatsPanel from './StatsPanel' // ✅ Importamos para mostrar ventas totales, etc.

export default function Dashboard() {
  const [data, setData] = useState({
    totalUsuarios: 0,
    totalProductos: 0,
    totalFacturas: 0
  })

  useEffect(() => {
    fetch('/api/dashboard.php', {
      credentials: 'include' // ✅ Importante para que se mande la cookie de sesión
    })
      .then(res => {
        if (!res.ok) throw new Error('Error en la respuesta del servidor')
        return res.json()
      })
      .then(data => {
        console.log('📊 Datos:', data)
        setData(data)
      })
      .catch(err => console.error('❌ Error al obtener estadísticas:', err))
  }, [])

  return (
    <>
      <h3 className="mb-4">📊 Panel de Estadísticas</h3>

      {/* Stats adicionales como total ventas, etc */}
      <StatsPanel />

      {/* Tus 3 tarjetas estadísticas personalizadas */}
      <div className="row mt-4">
        <div className="col-md-4">
          <div className="card text-bg-primary mb-3">
            <div className="card-body text-center">
              <h5 className="card-title">👥 Usuarios Registrados</h5>
              <p className="fs-2">{data.totalUsuarios}</p>
            </div>
          </div>
        </div>

        <div className="col-md-4">
          <div className="card text-bg-success mb-3">
            <div className="card-body text-center">
              <h5 className="card-title">🛒 Productos Activos</h5>
              <p className="fs-2">{data.totalProductos}</p>
            </div>
          </div>
        </div>

        <div className="col-md-4">
          <div className="card text-bg-warning mb-3">
            <div className="card-body text-center">
              <h5 className="card-title">🧾 Facturas Emitidas</h5>
              <p className="fs-2">{data.totalFacturas}</p>
            </div>
          </div>
        </div>
      </div>
    </>
  )
}
