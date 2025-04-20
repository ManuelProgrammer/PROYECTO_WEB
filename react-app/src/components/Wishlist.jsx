import React, { useEffect, useState } from 'react'
import '../App.css'

function Wishlist() {
  const [productos, setProductos] = useState([])
  const [loading, setLoading] = useState(true)
  const [error, setError] = useState(null)
  const [favoritos, setFavoritos] = useState([])

  const [filtroGrupo, setFiltroGrupo] = useState('')
  const [filtroSubgrupo, setFiltroSubgrupo] = useState('')

  const gruposYSubgrupos = {
    'Plantas': ['Ornamentales de Interior', 'Ornamentales de Exterior', 'Trepadoras', 'Arbustos Ornamentales', 'Maceta', 'Colgantes'],
    'Suculentas': ['Suculentas de Sol', 'Suculentas de Sombra', 'Mini Suculentas', 'Cactus', 'Arreglos con Suculentas'],
    'Plantas Medicinales': ['Aromáticas', 'Terapéuticas', 'Comestibles'],
    'Fertilizantes': ['Orgánicos', 'Químicos', 'Líquidos', 'Granulados', 'Para flores', 'Para césped'],
    'Abonos': ['Humus de lombriz', 'Compost', 'Estiércol', 'Abonos foliares', 'Mezclas para macetas'],
    'Materas': ['Plásticas', 'Barro', 'Decorativas', 'Colgantes', 'Autorriego'],
    'Herramientas de Jardinería': ['Palas y rastrillos', 'Guantes', 'Tijeras de poda', 'Regaderas', 'Kits de jardinería']
  }

  useEffect(() => {
    fetch('/mi_proyecto/api/wishlist.php?productos=1', { credentials: 'include' })
      .then(res => res.ok ? res.json() : [])
      .then(data => {
        setProductos(data)
        setFavoritos(data.map(p => p.id))
        setLoading(false)
      })
      .catch(() => {
        setError('No se pudo cargar la lista de deseos.')
        setLoading(false)
      })
  }, [])

  const toggleFavorito = (id) => {
    const metodo = favoritos.includes(id) ? 'DELETE' : 'POST'

    fetch('/mi_proyecto/api/wishlist.php', {
      method: metodo,
      headers: { 'Content-Type': 'application/json' },
      credentials: 'include',
      body: JSON.stringify({ producto_id: id })
    })
      .then(() => {
        setFavoritos(prev =>
          metodo === 'POST' ? [...prev, id] : prev.filter(pid => pid !== id)
        )
        setProductos(prev => metodo === 'POST' ? prev : prev.filter(p => p.id !== id))
      })
  }

  const agregarAlCarrito = (producto) => {
    const carrito = JSON.parse(localStorage.getItem('carrito')) || []
    const yaExiste = carrito.find(item => item.id === producto.id)

    if (!yaExiste) {
      carrito.push({ ...producto, cantidad: 1 })
      localStorage.setItem('carrito', JSON.stringify(carrito))
      alert(`${producto.nombre} agregado al carrito.`)
    } else {
      alert('Este producto ya está en el carrito.')
    }
  }

  const filtrados = productos.filter(p => {
    const coincideGrupo = filtroGrupo ? p.grupo === filtroGrupo : true
    const coincideSubgrupo = filtroSubgrupo ? p.subGrupo === filtroSubgrupo : true
    return coincideGrupo && coincideSubgrupo
  })

  return (
    <div className="container py-4">
      <h2 className="mb-5 text-center" style={{ color: '#004d00' }}>
        <i className="bi bi-heart-fill me-2"></i> Mi Lista de Deseos
      </h2>

      {/* Filtros */}
      <div className="row mb-4">
        <div className="col-md-6">
          <label className="form-label">Grupo</label>
          <select className="form-select" value={filtroGrupo} onChange={e => {
            setFiltroGrupo(e.target.value)
            setFiltroSubgrupo('')
          }}>
            <option value="">Todos</option>
            {Object.keys(gruposYSubgrupos).map(grupo => (
              <option key={grupo} value={grupo}>{grupo}</option>
            ))}
          </select>
        </div>
        <div className="col-md-6">
          <label className="form-label">Subgrupo</label>
          <select className="form-select" value={filtroSubgrupo} onChange={e => setFiltroSubgrupo(e.target.value)} disabled={!filtroGrupo}>
            <option value="">Todos</option>
            {gruposYSubgrupos[filtroGrupo]?.map(sg => (
              <option key={sg} value={sg}>{sg}</option>
            ))}
          </select>
        </div>
      </div>

      {loading && <p className="text-center text-muted">Cargando favoritos...</p>}
      {error && <div className="alert alert-danger text-center">{error}</div>}

      <div className="row">
        {filtrados.map(p => (
          <div className="col-md-4 mb-4" key={p.id}>
            <div className="card h-100 shadow-sm">
              <img
                src={`http://localhost/mi_proyecto/multimedia/${p.imagen || 'no-image.png'}`}
                className="card-img-top"
                onError={e => { e.target.src = '/mi_proyecto/multimedia/no-image.png' }}
                alt={p.nombre}
              />
              <div className="card-body">
                <div className="d-flex justify-content-end">
                  <i
                    className={`bi ${favoritos.includes(p.id)
                      ? 'bi-heart-fill wishlist-icon-filled'
                      : 'bi-heart wishlist-icon-outline'} wishlist-icon`}
                    onClick={() => toggleFavorito(p.id)}
                  ></i>
                </div>
                <h5 className="card-title text-start">{p.nombre}</h5>
                <p className="card-text text-start">{p.descripcion}</p>
                <p className="card-text fw-bold text-success">
                {new Intl.NumberFormat('es-CO', { style: 'currency', currency: 'COP' }).format(p.precio)}
              </p>
                <button
                  className="btn btn-success w-100 mt-2"
                  onClick={() => agregarAlCarrito(p)}
                >
                  <i className="bi bi-cart-plus me-2"></i> Agregar al carrito
                </button>
              </div>
            </div>
          </div>
        ))}
      </div>
    </div>
  )
}

export default Wishlist
