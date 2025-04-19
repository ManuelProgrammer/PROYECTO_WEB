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

  // ✅ Obtener búsqueda desde URL
  useEffect(() => {
    const url = new URL(window.location.href)
    const q = url.searchParams.get('busqueda')?.toLowerCase() || ''
    setBusqueda(q)
  }, [])

  // ✅ Cargar productos
  useEffect(() => {
    fetch('http://localhost/mi_proyecto/api/productos.php')
      .then(res => {
        if (!res.ok) throw new Error('❌ Error en la respuesta del servidor')
        return res.json()
      })
      .then(data => {
        setProductos(data)
        setLoading(false)
      })
      .catch(err => {
        console.error('⚠️ Error al cargar productos:', err)
        setError('No se pudieron cargar los productos.')
        setLoading(false)
      })
  }, [])

  // ✅ Cargar wishlist del usuario
  useEffect(() => {
    fetch('/mi_proyecto/api/wishlist.php')
      .then(res => res.json())
      .then(setFavoritos)
      .catch(() => setFavoritos([]))
  }, [])

  const toggleFavorito = (id) => {
    const metodo = favoritos.includes(id) ? 'DELETE' : 'POST'

    fetch('/mi_proyecto/api/wishlist.php', {
      method: metodo,
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ producto_id: id })
    })
      .then(res => res.json())
      .then(() => {
        setFavoritos(prev =>
          metodo === 'POST'
            ? [...prev, id]
            : prev.filter(pid => pid !== id)
        )
      })
  }

  const productosFiltrados = productos.filter(p => {
    const coincideBusqueda = busqueda
      ? (p.nombre?.toLowerCase().includes(busqueda) || p.descripcion?.toLowerCase().includes(busqueda))
      : true

    const coincideGrupo = filtroGrupo ? p.grupo === filtroGrupo : true
    const coincideSubgrupo = filtroSubgrupo ? p.subGrupo === filtroSubgrupo : true

    return coincideBusqueda && coincideGrupo && coincideSubgrupo
  })

  return (
    <div className="container py-4">
      <h2 className="mb-5 text-center" style={{ color: '#004d00' }}>
        <i className="bx bxs-leaf" style={{ fontSize: '1.5rem', marginRight: '8px', verticalAlign: 'middle' }}></i>
        Nuestros Productos
      </h2>

      {/* Filtros */}
      <div className="row mb-4">
        <div className="col-md-6">
          <label className="form-label">Filtrar por Grupo</label>
          <select
            className="form-select"
            value={filtroGrupo}
            onChange={e => {
              setFiltroGrupo(e.target.value)
              setFiltroSubgrupo('')
            }}
          >
            <option value="">-- Todos los grupos --</option>
            {Object.keys(gruposYSubgrupos).map(grupo => (
              <option key={grupo} value={grupo}>{grupo}</option>
            ))}
          </select>
        </div>

        <div className="col-md-6">
          <label className="form-label">Filtrar por Subgrupo</label>
          <select
            className="form-select"
            value={filtroSubgrupo}
            onChange={e => setFiltroSubgrupo(e.target.value)}
            disabled={!filtroGrupo}
          >
            <option value="">-- Todos los subgrupos --</option>
            {filtroGrupo && gruposYSubgrupos[filtroGrupo].map(sub => (
              <option key={sub} value={sub}>{sub}</option>
            ))}
          </select>
        </div>
      </div>

      {loading && <p className="text-muted text-center">Cargando productos...</p>}
      {error && <div className="alert alert-danger text-center">{error}</div>}

      <div className="row">
        {productosFiltrados.length === 0 && !loading && (
          <p className="text-muted text-center">No se encontraron productos.</p>
        )}
        {productosFiltrados.map(p => (
          <div className="col-md-4 mb-4" key={p.id}>
            <div className="card h-100 shadow-sm">
              <img
                src={`http://localhost/mi_proyecto/multimedia/${p.imagen}`}
                className="card-img-top"
                alt={p.nombre}
                onError={e => (e.target.style.display = 'none')}
              />
              <div className="card-body position-relative">
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

export default App

