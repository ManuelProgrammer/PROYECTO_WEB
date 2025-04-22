import React, { useEffect, useState } from 'react'
import ProductForm from './ProductForm'

export default function ProductList() {
  const [productos, setProductos] = useState([])
  const [productoEditando, setProductoEditando] = useState(null)

  useEffect(() => {
    cargarProductos()
  }, [])

  const cargarProductos = () => {
    fetch('/api/productos_admin.php')
      .then(res => res.json())
      .then(data => setProductos(data))
      .catch(err => console.error("Error al cargar productos:", err))
  }

  const eliminarProducto = (id) => {
    if (confirm('¿Estás seguro de eliminar este producto?')) {
      fetch('/api/productos_admin.php', {
        method: 'DELETE',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify({ id }) // ✅ CORRECTO: se envía como JSON
      })
        .then(res => res.json())
        .then(data => {
          if (data.success) {
            alert('✅ Producto eliminado')
            setProductos(productos.filter(p => p.id !== id))
          } else {
            alert('❌ Error al eliminar: ' + (data.error || 'Error desconocido'))
          }
        })
        .catch(err => {
          console.error('❌ Error de red al intentar eliminar el producto', err)
          alert('❌ Error de red al intentar eliminar el producto')
        })
    }
  }
  

  return (
    <div>
      <h4 className="mb-4">🛒 Administración de Productos</h4>

      {/* Botón para agregar producto / corrección automática de grupos y subgrupos*/}
      <div className="d-flex justify-content-start gap-2 mb-3">
  <button className="btn btn-primary" onClick={() => setProductoEditando({})}>
    ➕ Agregar Producto
  </button>
  <button
    className="btn btn-warning"
    onClick={() => {
      if (confirm("¿Deseas ejecutar la corrección automática de grupos y subgrupos?")) {
        fetch('/api/productos_corregir_grupos.php')
          .then(res => res.text())
          .then(html => {
            const nuevaVentana = window.open();
            nuevaVentana.document.write(html);
          });
      }
    }}
  >
    🧹 Corregir grupos/subgrupos automáticamente
  </button>
</div>


      <table className="table table-bordered table-hover">
        <thead className="table-success">
          <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Grupo</th>
            <th>Precio</th>
            <th>Stock</th>
            <th>Imagen</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          {productos.map(prod => (
            <tr key={prod.id}>
              <td>{prod.id}</td>
              <td>{prod.nombre}</td>
              <td>{prod.grupo}</td>
              <td>${prod.precio}</td>
              <td>{prod.stock}</td>
              <td>
                <img src={`/multimedia/${prod.imagen}`} alt={prod.nombre} style={{ width: '60px' }} />
              </td>
              <td>
                <button className="btn btn-sm btn-danger me-2" onClick={() => eliminarProducto(prod.id)}>Eliminar</button>
                <button className="btn btn-sm btn-secondary" onClick={() => setProductoEditando(prod)}>Editar</button>
              </td>
            </tr>
          ))}
        </tbody>
      </table>

      {/* Modal de formulario (editar o agregar) */}
      {productoEditando && (
        <ProductForm
          producto={Object.keys(productoEditando).length ? productoEditando : null}
          onClose={() => setProductoEditando(null)}
          onSave={cargarProductos}
        />
      )}
    </div>
  )
}
