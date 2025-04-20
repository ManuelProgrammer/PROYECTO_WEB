import React, { useState, useEffect } from 'react'

export default function ProductForm({ producto, onClose, onSave }) {
  const [formData, setFormData] = useState({
    id: '',
    nombre: '',
    grupo: '',
    subGrupo: '',
    descripcion: '',
    precio: '',
    stock: '',
    imagen: null,
    destacado: 0
  })

  const [previewImage, setPreviewImage] = useState(null)
  const modoEdicion = !!producto

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
    if (producto) {
      setFormData({
        id: producto.id || '',
        nombre: producto.nombre || '',
        grupo: producto.grupo || '',
        subGrupo: producto.subGrupo || '',
        descripcion: producto.descripcion || '',
        precio: producto.precio || '',
        stock: producto.stock || '',
        imagen: null,
        destacado: producto.destacado || 0
      })

      if (producto.imagen) {
        setPreviewImage(`../../multimedia/${producto.imagen}`)
      } else {
        setPreviewImage(null)
      }
    }
  }, [producto])

  const handleChange = (e) => {
    const { name, value, type, checked } = e.target

    if (name === 'grupo') {
      setFormData(prev => ({
        ...prev,
        grupo: value,
        subGrupo: ''
      }))
    } else if (type === 'checkbox') {
      setFormData(prev => ({
        ...prev,
        [name]: checked ? 1 : 0
      }))
    } else {
      setFormData(prev => ({
        ...prev,
        [name]: value
      }))
    }
  }

  const handleFileChange = (e) => {
    const file = e.target.files[0]
    if (file) {
      setFormData(prev => ({ ...prev, imagen: file }))
      setPreviewImage(URL.createObjectURL(file))
    }
  }

  const handleSubmit = (e) => {
    e.preventDefault()

    const data = new FormData()
    if (modoEdicion) data.append('id', formData.id)
    data.append('nombre', formData.nombre)
    data.append('grupo', formData.grupo)
    data.append('subGrupo', formData.subGrupo)
    data.append('descripcion', formData.descripcion)
    data.append('precio', formData.precio)
    data.append('stock', formData.stock)
    data.append('destacado', formData.destacado)
    if (formData.imagen) data.append('imagen', formData.imagen)

    fetch('/mi_proyecto/api/productos_admin.php', {
      method: modoEdicion ? 'POST' : 'PUT',
      body: data
    })
      .then(res => res.json())
      .then(data => {
        if (data.success) {
          alert(`✅ Producto ${modoEdicion ? 'actualizado' : 'agregado'} correctamente`)
          onSave()
          onClose()
        } else {
          alert('❌ Hubo un error al guardar el producto')
        }
      })
      .catch(error => {
        console.error('Error en la solicitud:', error)
        alert('❌ Error al comunicar con el servidor')
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
                <input
                  type="text"
                  name="nombre"
                  className="form-control"
                  value={formData.nombre}
                  onChange={handleChange}
                  required
                />
              </div>

              <div className="mb-2">
                <label className="form-label">Grupo</label>
                <select
                  name="grupo"
                  className="form-control"
                  value={formData.grupo}
                  onChange={handleChange}
                  required
                >
                  <option value="">Seleccione un grupo</option>
                  {Object.keys(gruposYSubgrupos).map(grupo => (
                    <option key={grupo} value={grupo}>{grupo}</option>
                  ))}
                </select>
              </div>

              {formData.grupo && gruposYSubgrupos[formData.grupo] && (
                <div className="mb-2">
                  <label className="form-label">Subgrupo</label>
                  <select
                    name="subGrupo"
                    className="form-control"
                    value={formData.subGrupo}
                    onChange={handleChange}
                    required
                  >
                    <option value="">Seleccione un subgrupo</option>
                    {gruposYSubgrupos[formData.grupo].map(sub => (
                      <option key={sub} value={sub}>{sub}</option>
                    ))}
                  </select>
                </div>
              )}

              <div className="mb-2">
                <label className="form-label">Descripción</label>
                <textarea
                  name="descripcion"
                  className="form-control"
                  value={formData.descripcion}
                  onChange={handleChange}
                ></textarea>
              </div>

              <div className="mb-2">
                <label className="form-label">Precio</label>
                <input
                  type="number"
                  name="precio"
                  className="form-control"
                  value={formData.precio}
                  onChange={handleChange}
                  required
                />
              </div>

              <div className="mb-2">
                <label className="form-label">Stock</label>
                <input
                  type="number"
                  name="stock"
                  className="form-control"
                  value={formData.stock}
                  onChange={handleChange}
                  required
                />
              </div>

              <div className="mb-3 form-check">
                <input
                  type="checkbox"
                  name="destacado"
                  className="form-check-input"
                  id="destacadoCheck"
                  checked={!!formData.destacado}
                  onChange={handleChange}
                />
                <label className="form-check-label" htmlFor="destacadoCheck">
                  Marcar como destacado
                </label>
              </div>

              <div className="mb-3">
                <label className="form-label">Imagen</label>
                <input
                  type="file"
                  name="imagen"
                  accept="image/*"
                  className="form-control"
                  onChange={handleFileChange}
                />
                {previewImage && (
                  <img
                    src={previewImage}
                    alt="Vista previa"
                    className="img-fluid mt-2 border"
                    style={{ maxHeight: 150 }}
                  />
                )}
              </div>
            </div>
            <div className="modal-footer">
              <button type="submit" className="btn btn-success">
                {modoEdicion ? 'Guardar cambios' : 'Agregar'}
              </button>
              <button type="button" className="btn btn-secondary" onClick={onClose}>
                Cancelar
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  )
}
