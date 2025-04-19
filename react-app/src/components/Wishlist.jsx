import React, { useEffect, useState } from 'react'
import '../App.css'

function Wishlist() {
  const [productos, setProductos] = useState([])
  const [loading, setLoading] = useState(true)
  const [error, setError] = useState(null)
  

  useEffect(() => {
    fetch('/mi_proyecto/api/wishlist.php', {
      credentials: 'include' // Asegura el envío de cookies de sesión
    })
      .then(res => {
        if (res.status === 401) {
          setError('Debes iniciar sesión para ver tu lista de deseos.')
          setLoading(false)
          return []
        }
        if (!res.ok) throw new Error('❌ Error al cargar favoritos')
        return res.json()
      })
      .then(data => {
        setProductos(data)
        setLoading(false)
      })
      .catch(err => {
        console.error('⚠️ Error:', err)
        setError('Ocurrió un error al cargar los productos.')
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
        {productos.length === 0 && !loading && !error && (
          <p className="text-muted text-center">No hay productos en tu lista de deseos.</p>
        )}
        {productos.map(p => (
          <div className="col-md-4 mb-4" key={p.id}>
            <div className="card h-100 shadow-sm">
              <img
                src={
                  p.imagen
                    ? `http://localhost/mi_proyecto/multimedia/${p.imagen}`
                    : `http://localhost/mi_proyecto/multimedia/no-image.png`
                }
                alt={p.nombre || 'Producto sin nombre'}
                className="card-img-top"
                onError={e => {
                  e.target.onerror = null
                  e.target.src = 'http://localhost/mi_proyecto/multimedia/no-image.png'
                }}
              />
              <div className="card-body">
              <div className="d-flex justify-content-end">
                <i
                  className={`wishlist-icon bi ${favoritos.includes(p.id) ? 'bi-heart-fill' : 'bi-heart'}`}
                  data-id={p.id}
                  style={{
                    fontSize: '1.5rem',
                    color: '#1d7e13',
                    cursor: 'pointer',
                    transition: 'transform 0.2s ease'
                  }}
                  onClick={() => toggleFavorito(p.id)}
                  onMouseEnter={e => (e.currentTarget.style.transform = 'scale(1.2)')}
                  onMouseLeave={e => (e.currentTarget.style.transform = 'scale(1)')}
                ></i>
              </div>

                <h5 className="card-title">{p.nombre || 'Producto sin nombre'}</h5>
                <p className="card-text">{p.descripcion || 'Sin descripción disponible.'}</p>
                <p className="card-text fw-bold text-success">${p.precio || '0.00'}</p>
              </div>
            </div>
          </div>
        ))}
      </div>
    </div>
  )
}

export default Wishlist
