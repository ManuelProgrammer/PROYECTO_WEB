import React, { useState } from 'react'

export default function UserForm({ usuario, onClose, onSave }) {
  const [form, setForm] = useState({ ...usuario })

  const handleChange = (e) => {
    const { name, value } = e.target
    setForm({ ...form, [name]: value })
  }

  const handleToggleActivo = () => {
    setForm(prev => ({ ...prev, activo: prev.activo ? 0 : 1 }))
  }

  const handleSubmit = (e) => {
    e.preventDefault()

    fetch('/mi_proyecto/api/usuarios.php', {
      method: 'PUT',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(form)
    })
      .then(res => res.json())
      .then(data => {
        if (data.success) {
          alert('✅ Usuario actualizado')
          onSave()
          onClose()
        } else {
          alert('❌ Error al actualizar usuario')
        }
      })
      .catch(err => console.error("Error:", err))
  }

  return (
    <div className="modal d-block bg-dark bg-opacity-50">
      <div className="modal-dialog">
        <div className="modal-content">
          <form onSubmit={handleSubmit}>
            <div className="modal-header">
              <h5 className="modal-title">Editar Usuario</h5>
              <button type="button" className="btn-close" onClick={onClose}></button>
            </div>
            <div className="modal-body">
              <div className="mb-3">
                <label className="form-label">Nombre</label>
                <input type="text" className="form-control" name="nombre" value={form.nombre} onChange={handleChange} />
              </div>
              <div className="mb-3">
                <label className="form-label">Correo</label>
                <input type="email" className="form-control" name="correo" value={form.correo} onChange={handleChange} />
              </div>
              <div className="mb-3">
                <label className="form-label">Teléfono</label>
                <input type="text" className="form-control" name="numeroTelefono" value={form.numeroTelefono || ''} onChange={handleChange} />
              </div>
              <div className="mb-3">
                <label className="form-label">Rol</label>
                <select className="form-select" name="rol" value={form.rol} onChange={handleChange}>
                  <option value="cliente">Cliente</option>
                  <option value="admin">Administrador</option>
                </select>
              </div>

              <div className="form-check form-switch">
                <input
                  className="form-check-input"
                  type="checkbox"
                  role="switch"
                  id="activoSwitch"
                  checked={!!form.activo}
                  onChange={handleToggleActivo}
                />
                <label className="form-check-label" htmlFor="activoSwitch">
                  {form.activo ? '✅ Activo' : '🚫 Baneado'}
                </label>
              </div>
            </div>

            <div className="modal-footer">
              <button type="submit" className="btn btn-success">Guardar</button>
              <button type="button" className="btn btn-secondary" onClick={onClose}>Cancelar</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  )
}
