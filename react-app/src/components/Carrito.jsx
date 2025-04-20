import React, { useEffect, useState } from 'react'
import '../App.css'

function Carrito() {
  const [carrito, setCarrito] = useState([])

  // 🔁 Cargar productos del localStorage al iniciar
  useEffect(() => {
    const datos = JSON.parse(localStorage.getItem('carrito')) || []
    setCarrito(datos)
  }, [])

  // 🔄 Cambiar cantidad
  const actualizarCantidad = (id, cantidad) => {
    const nuevoCarrito = carrito.map(p =>
      p.id === id ? { ...p, cantidad: Math.max(1, cantidad) } : p
    )
    setCarrito(nuevoCarrito)
    localStorage.setItem('carrito', JSON.stringify(nuevoCarrito))
  }

  // 🗑️ Eliminar producto
  const eliminarProducto = (id) => {
    const nuevoCarrito = carrito.filter(p => p.id !== id)
    setCarrito(nuevoCarrito)
    localStorage.setItem('carrito', JSON.stringify(nuevoCarrito))
  }

  // 💲 Total
  const total = carrito.reduce((acc, p) => acc + p.precio * p.cantidad, 0)

  // ✅ Simular compra
  const confirmarCompra = () => {
    alert('✅ Compra realizada con éxito (simulada)')
    localStorage.removeItem('carrito')
    setCarrito([])
  }

  return (
    <div className="container py-4">
      <h2 className="mb-5 text-center" style={{ color: '#004d00' }}>
        <i className="bi bi-cart-fill me-2"></i> Carrito de Compras
      </h2>

      {carrito.length === 0 ? (
        <p className="text-muted text-center">Tu carrito está vacío.</p>
      ) : (
        <>
          <div className="row">
            {carrito.map(p => (
              <div className="col-md-6 mb-4" key={p.id}>
                <div className="card h-100 shadow-sm">
                  <div className="row g-0">
                    <div className="col-md-4">
                      <img
                        src={`http://localhost/mi_proyecto/multimedia/${p.imagen || 'no-image.png'}`}
                        alt={p.nombre}
                        className="img-fluid rounded-start"
                        onError={e => {
                          e.target.onerror = null
                          e.target.src = '/mi_proyecto/multimedia/no-image.png'
                        }}
                      />
                    </div>
                    <div className="col-md-8">
                      <div className="card-body">
                        <h5 className="card-title text-start">{p.nombre}</h5>
                        <p className="card-text text-start">{p.descripcion}</p>
                        <p className="card-text fw-bold text-success">
                        {new Intl.NumberFormat('es-CO', { style: 'currency', currency: 'COP' }).format(p.precio)}
                      </p>


                        <div className="d-flex align-items-center mb-2">
                          <label className="me-2 mb-0">Cantidad:</label>
                          <input
                            type="number"
                            className="form-control"
                            style={{ width: '80px' }}
                            value={p.cantidad}
                            min="1"
                            onChange={e => actualizarCantidad(p.id, parseInt(e.target.value))}
                          />
                        </div>

                        <button
                          className="btn btn-outline-danger btn-sm"
                          onClick={() => eliminarProducto(p.id)}
                        >
                          <i className="bi bi-trash me-1"></i> Quitar
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            ))}
          </div>

          <div className="mt-4 text-end">
            <h4>Total: <span className="text-success">${total.toFixed(2)}</span></h4>
            <button className="btn btn-success mt-3" onClick={confirmarCompra}>
              <i className="bi bi-credit-card me-2"></i> Confirmar Compra
            </button>
          </div>
        </>
      )}
    </div>
  )
}

export default Carrito
