import React, { useEffect, useState } from 'react'
import '../App.css'

function Wishlist() {
  const [productos, setProductos] = useState([])
  const [loading, setLoading] = useState(true)
  const [error, setError] = useState(null)

  useEffect(() => {
    fetch('/mi_proyecto/api/wishlist.php?productos=1')
      .then(res => {
        if (!res.ok) throw new Error('❌ Error al cargar favoritos')
        return res.json()
      })
      .then(data => {
        setProductos(data)
        setLoading(false)
      })
      .catch(err => {
        console.error('⚠️ Error:', err)
        setError('No se pudieron cargar los productos favoritos.')
        setLoading(false)
      })
  }, [])

  return (
    <div className="container py-4">
      <h2 className="mb-5 text-center" style={{ color: '#004d00' }}>
        <i className="bx bxs-heart" style={{ fontSize: '1.5rem', marginRight: '8px', verticalAlign: 'middle' }}></i>
        Mi Lista de Deseos
      </h2>

      {loading && <p className="text-muted text-center">Cargando productos favoritos...</p>}
      {error && <div className="alert alert-danger text-center">{error}</div>}

      <div className="row">
        {productos.length === 0 && !loading && (
          <p className="text-muted text-center">No hay productos en tu lista de deseos.</p>
        )}
        {productos.map(p => (
          <div className="col-md-4 mb-4" key={p.id}>
            <div className="card h-100 shadow-sm">
              <img
                src={`http://localhost/mi_proyecto/multimedia/${p.imagen}`}
                className="card-img-top"
                alt={p.nombre}
                onError={e => (e.target.style.display = 'none')}
              />
              <div className="card-body">
                <h5 className="card-title">{p.nombre}</h5>
                <p className="card-text">{p.descripcion}</p>
                <p className="card-text fw-bold text-success">${p.precio}</p>
              </div>
            </div>
          </div>
        ))}
      </div>
    </div>
  )
}

export default Wishlist
