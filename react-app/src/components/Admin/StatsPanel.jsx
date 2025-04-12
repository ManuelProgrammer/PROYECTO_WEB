import React, { useEffect, useState } from 'react'

export default function StatsPanel() {
  const [stats, setStats] = useState({
    productos: 0,
    usuarios: 0,
    facturas: 0,
    total_ventas: 0
  })

  useEffect(() => {
    fetch('/mi_proyecto/api/stats_admin.php')
      .then(res => res.json())
      .then(data => setStats(data))
      .catch(err => console.error("❌ Error al obtener estadísticas:", err))
  }, [])

  return (
    <div className="row mb-4">
      <div className="col-md-3">
        <div className="card text-white bg-success">
          <div className="card-body">
            <h5 className="card-title">Productos</h5>
            <p className="card-text fs-3">{stats.productos}</p>
          </div>
        </div>
      </div>
      <div className="col-md-3">
        <div className="card text-white bg-primary">
          <div className="card-body">
            <h5 className="card-title">Usuarios</h5>
            <p className="card-text fs-3">{stats.usuarios}</p>
          </div>
        </div>
      </div>
      <div className="col-md-3">
        <div className="card text-white bg-info">
          <div className="card-body">
            <h5 className="card-title">Facturas</h5>
            <p className="card-text fs-3">{stats.facturas}</p>
          </div>
        </div>
      </div>
      <div className="col-md-3">
        <div className="card text-white bg-dark">
          <div className="card-body">
            <h5 className="card-title">Total Ventas</h5>
            <p className="card-text fs-3">${stats.total_ventas}</p>
          </div>
        </div>
      </div>
    </div>
  )
}
