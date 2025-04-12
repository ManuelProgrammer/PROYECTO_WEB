import React, { useState, useEffect } from 'react'

export default function ProductForm({ producto, onClose, onSave }) {
  const [formData, setFormData] = useState({
    nombre: '',
    grupo: '',
    precio: '',
    stock: ''
  })

  const modoEdicion = !!producto

  useEffect(() => {
    if (producto) setFormData(producto)
  }, [producto])

  const handleChange = e => {
    const { name, value } = e.target
    setFormData(prev => ({ ...prev, [name]: value }))
  }

  const handleSubmit = e => {
    e.preventDefault()

    const method = modoEdicion ? 'PUT' : 'POST'

    fetch('/mi_proyecto/api/productos_admin.php', {
      method,
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(formData)
    })
      .then(res => res.json())
      .then(data => {
        if (data.success) {
          alert(`✅ Producto ${modoEdicion ? 'actualizado' : 'agregado'} correctamente`)
          onSave()
          onClose()
        } else {
          alert('❌ Hubo un error')
        }
      })
  }

  return (
    <div className="modal show d-block" style={{ backgroundColor: '#00000088' }}>
      <div className="modal-dialog">
        <div className="modal-content">
          <form onSubmit={handleSubmit}>
            <div className="modal-header">
              <h5 className="modal-title">{modoEdicion ? 'Editar' : 'Agregar'} Producto</h5>
              <button type="button" className="btn-close" onClick={onClose}></button>
            </div>
            <div className="modal-body">
              <div className="mb-2">
                <label className="form-label">Nombre</label>
                <input type="text" name="nombre" className="form-control" value={formData.nombre} onChange={handleChange} required />
              </div>
              <div className="mb-2">
                <label className="form-label">Grupo</label>
                <input type="text" name="grupo" className="form-control" value={formData.grupo} onChange={handleChange} />
              </div>
              <div className="mb-2">
                <label className="form-label">Precio</label>
                <input type="number" name="precio" className="form-control" value={formData.precio} onChange={handleChange} required />
              </div>
              <div className="mb-2">
                <label className="form-label">Stock</label>
                <input type="number" name="stock" className="form-control" value={formData.stock} onChange={handleChange} required />
              </div>
            </div>
            <div className="modal-footer">
              <button type="submit" className="btn btn-success">{modoEdicion ? 'Guardar cambios' : 'Agregar'}</button>
              <button type="button" className="btn btn-secondary" onClick={onClose}>Cancelar</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  )
}
