import React, { useEffect, useState } from 'react'
import './App.css'

const gruposYSubgrupos = {
  'Plantas': ['Ornamentales de Interior', 'Ornamentales de Exterior', 'Trepadoras', 'Arbustos Ornamentales', 'Maceta', 'Colgantes'],
  'Suculentas': ['Suculentas de Sol', 'Suculentas de Sombra', 'Mini Suculentas', 'Cactus', 'Arreglos con Suculentas'],
  'Plantas Medicinales': ['Aromáticas', 'Terapéuticas', 'Comestibles'],
  'Fertilizantes': ['Orgánicos', 'Químicos', 'Líquidos', 'Granulados', 'Para flores', 'Para césped'],
  'Abonos': ['Humus de lombriz', 'Compost', 'Estiércol', 'Abonos foliares', 'Mezclas para macetas'],
  'Materas': ['Plásticas', 'Barro', 'Decorativas', 'Colgantes', 'Autorriego'],
  'Herramientas de Jardinería': ['Palas y rastrillos', 'Guantes', 'Tijeras de poda', 'Regaderas', 'Kits de jardinería']
}

function App() {
  const [productos, setProductos] = useState([])
  const [loading, setLoading] = useState(true)
  const [error, setError] = useState(null)

  const [busqueda, setBusqueda] = useState('')
  const [filtroGrupo, setFiltroGrupo] = useState('')
  const [filtroSubgrupo, setFiltroSubgrupo] = useState('')
  const [favoritos, setFavoritos] = useState([])

  useEffect(() => {
    const url = new URL(window.location.href)
    const q = url.searchParams.get('busqueda')?.toLowerCase() || ''
    setBusqueda(q)
  }, [])

  useEffect(() => {
    fetch('/api/productos.php')
      .then(res => res.json())
      .then(data => {
        setProductos(data)
        setLoading(false)
      })
      .catch(() => {
        setError('Error al cargar productos')
        setLoading(false)
      })
  }, [])

  useEffect(() => {
    fetch('/api/wishlist.php', { credentials: 'include' })
      .then(res => res.ok ? res.json() : [])
      .then(data => setFavoritos(data))
      .catch(() => setFavoritos([]))
  }, [])

  const toggleFavorito = (id) => {
    const metodo = favoritos.includes(id) ? 'DELETE' : 'POST'

    fetch('/api/wishlist.php', {
      method: metodo,
      headers: { 'Content-Type': 'application/json' },
      credentials: 'include',
      body: JSON.stringify({ producto_id: id })
    })
      .then(() => {
        setFavoritos(prev =>
          metodo === 'POST'
            ? [...prev, id]
            : prev.filter(pid => pid !== id)
        )
      })
  }

  const agregarAlCarrito = (producto_id) => {
    const producto = productos.find(p => p.id === producto_id)
    if (!producto) return
  
    const carritoActual = JSON.parse(localStorage.getItem('carrito')) || []
  
    const existe = carritoActual.find(p => p.id === producto.id)
    let actualizado
  
    if (existe) {
      actualizado = carritoActual.map(p =>
        p.id === producto.id ? { ...p, cantidad: p.cantidad + 1 } : p
      )
    } else {
      actualizado = [...carritoActual, { ...producto, cantidad: 1 }]
    }
  
    localStorage.setItem('carrito', JSON.stringify(actualizado))
    alert('✅ Producto agregado al carrito')
  }
  
  const productosFiltrados = productos.filter(p => {
    const coincideBusqueda = busqueda
      ? (p.nombre?.toLowerCase().includes(busqueda) || p.descripcion?.toLowerCase().includes(busqueda))
      : true;
    const coincideGrupo = filtroGrupo ? p.grupo === filtroGrupo : true;
    const coincideSubgrupo = filtroSubgrupo ? p.subGrupo === filtroSubgrupo : true;
    return coincideBusqueda && coincideGrupo && coincideSubgrupo;
  });
  

  return (
    <div className="container-fluid py-4 px-3 px-md-5">
      <h2 className="mb-5 text-center" style={{ color: '#004d00' }}>
        <i className="bx bxs-leaf me-2"></i> Nuestros Productos
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

      {loading && <p className="text-center text-muted">Cargando productos...</p>}
      {error && <div className="alert alert-danger text-center">{error}</div>}

      <div className="row">
        {productosFiltrados.map(p => (
          <div className="col-md-4 mb-4" key={p.id}>
            <div className="card h-100 shadow-sm animate-hover">
            <img
            src={`https://proyecto-web-jr8l.onrender.com/multimedia/${p.imagen || 'no-image.png'}`}
            className="card-img-top"
            style={{ height: '250px', objectFit: 'contain', padding: '1rem' }}
            onError={e => { e.target.src = '/multimedia/no-image.png' }}
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
                  className="btn btn-outline-success w-100 mt-3"
                  onClick={() => agregarAlCarrito(p.id)}
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

export default App

