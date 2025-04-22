import React, { useEffect, useState } from 'react'
import UserForm from './UserForm'

export default function UserList() {
  const [usuarios, setUsuarios] = useState([])
  const [rol, setRol] = useState('todos')
  const [usuarioEditando, setUsuarioEditando] = useState(null)

  useEffect(() => {
    cargarUsuarios()
  }, [])

  const cargarUsuarios = () => {
    fetch('/api/usuarios.php')
      .then(res => res.json())
      .then(data => {
        console.log("Usuarios recibidos:", data)
        setUsuarios(data)
      })
      .catch(err => console.error("Error al cargar usuarios:", err))
  }

  const eliminarUsuario = (id) => {
    if (confirm('¿Estás seguro de eliminar este usuario?')) {
      fetch(`/api/usuarios.php?id=${id}`, {
        method: 'DELETE'
      })
        .then(res => res.json())
        .then(data => {
          if (data.success) {
            alert('✅ Usuario eliminado correctamente')
            setUsuarios(usuarios.filter(u => u.id !== id))
          } else {
            alert('❌ Error al eliminar usuario')
          }
        })
    }
  }

  const toggleEstado = (user) => {
    const nuevoEstado = parseInt(user.activo) === 1 ? 0 : 1
    const confirmMsg = nuevoEstado === 0
      ? "¿Seguro que quieres banear a este usuario?"
      : "¿Deseas activar nuevamente este usuario?"

    if (confirm(confirmMsg)) {
      fetch('/api/usuarios.php', {
        method: 'PUT',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ ...user, activo: nuevoEstado })
      })
        .then(res => res.json())
        .then(data => {
          if (data.success) {
            alert('✅ Estado actualizado')
            cargarUsuarios()
          } else {
            alert('❌ Error al actualizar estado')
          }
        })
    }
  }

  const usuariosFiltrados = rol === 'todos'
    ? usuarios
    : usuarios.filter(u => u.rol === rol)

  return (
    <div>
      <h4 className="mb-4">👥 Lista de Usuarios</h4>

      <div className="mb-3">
        <label className="form-label me-2">Filtrar por rol:</label>
        <select
          className="form-select w-auto d-inline"
          value={rol}
          onChange={(e) => setRol(e.target.value)}
        >
          <option value="todos">Todos</option>
          <option value="cliente">Cliente</option>
          <option value="admin">Administrador</option>
        </select>
      </div>

      <table className="table table-bordered table-hover">
        <thead className="table-success">
          <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Correo</th>
            <th>Teléfono</th>
            <th>Rol</th>
            <th>Estado</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          {usuariosFiltrados.map(user => {
            const activo = parseInt(user.activo) === 1
            return (
              <tr key={user.id} className={activo ? 'table-success' : 'table-danger'}>
                <td>{user.id}</td>
                <td>{user.nombre}</td>
                <td>{user.correo}</td>
                <td>{user.numeroTelefono || 'N/A'}</td>
                <td>{user.rol}</td>
                <td>
                  <span className={`badge ${activo ? 'bg-success' : 'bg-danger'}`}>
                    {activo ? '✅ Activo' : '❌ Baneado'}
                  </span>
                </td>
                <td>
                  <button
                    className="btn btn-sm btn-secondary me-2"
                    onClick={() => setUsuarioEditando(user)}
                  >
                    Editar
                  </button>
                  <button
                    className="btn btn-sm btn-danger me-2"
                    onClick={() => eliminarUsuario(user.id)}
                  >
                    Borrar
                  </button>
                  <button
                    className={`btn btn-sm ${activo ? 'btn-warning' : 'btn-success'}`}
                    onClick={() => toggleEstado(user)}
                  >
                    {activo ? 'Banear' : 'Activar'}
                  </button>
                </td>
              </tr>
            )
          })}
        </tbody>
      </table>

      {usuarioEditando && (
        <UserForm
          usuario={usuarioEditando}
          onClose={() => setUsuarioEditando(null)}
          onSave={cargarUsuarios}
        />
      )}
    </div>
  )
}
