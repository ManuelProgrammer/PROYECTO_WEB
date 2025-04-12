import React, { useEffect, useState } from 'react'

export default function UserList() {
  const [usuarios, setUsuarios] = useState([])
  const [rol, setRol] = useState('todos')

  useEffect(() => {
    fetch('/mi_proyecto/api/usuarios.php')
      .then(res => res.json())
      .then(data => setUsuarios(data))
      .catch(err => console.error("Error al cargar usuarios:", err))
  }, [])

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
          </tr>
        </thead>
        <tbody>
          {usuariosFiltrados.map(user => (
            <tr key={user.id}>
              <td>{user.id}</td>
              <td>{user.nombre}</td>
              <td>{user.correo}</td>
              <td>{user.numeroTelefono || 'N/A'}</td>
              <td>{user.rol}</td>
            </tr>
          ))}
        </tbody>
      </table>
    </div>
  )
}
