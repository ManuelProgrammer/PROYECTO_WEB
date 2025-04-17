import React, { useEffect, useState } from 'react'
import './App.css'

function App() {
  const [productos, setProductos] = useState([])
  const [loading, setLoading] = useState(true)
  const [error, setError] = useState(null)

  useEffect(() => {
    console.log("🔄 Montando componente...")

    fetch('http://localhost/mi_proyecto/api/productos.php')
      .then(res => {
        console.log("🔍 Respuesta fetch recibida:", res)
        if (!res.ok) throw new Error("❌ Error en la respuesta del servidor")
        return res.json()
      })
      .then(data => {
        console.log("✅ Productos cargados:", data)
        setProductos(data)
        setLoading(false)
      })
      .catch(err => {
        console.error("⚠️ Error al cargar productos:", err)
        setError('No se pudieron cargar los productos.')
        setLoading(false)
      })
  }, [])

  return (
    <div className="container py-4">
      <h2 className="mb-4 text-center">Nuestros Productos</h2>

      {loading && (
        <div className="text-center text-muted">
          <p>Cargando productos...</p>
        </div>
      )}

      {error && (
        <div className="alert alert-danger text-center" role="alert">
          {error}
        </div>
      )}

      {!loading && !error && (
        <div className="row">
          {productos.map(p => (
            <div className="col-md-4 mb-4" key={p.id}>
              <div className="card h-100 shadow">
                <img
                  src={`http://localhost/mi_proyecto/multimedia/${p.imagen}`}
                  className="card-img-top"
                  alt={p.nombre}
                  onError={e => e.target.style.display = 'none'}
                />
                <div className="card-body">
                  <h5 className="card-title">{p.nombre}</h5>
                  <p className="card-text"><strong>${p.precio}</strong></p>
                  <a href="#" className="btn btn-success">Ver más</a>
                </div>
              </div>
            </div>
          ))}
        </div>
      )}
    </div>
  )
}

export default App
