import React, { useEffect, useState } from 'react'

export default function FacturaList() {
  const [facturas, setFacturas] = useState([])

  useEffect(() => {
    fetch('/mi_proyecto/api/facturas_admin.php')
      .then(res => res.json())
      .then(data => setFacturas(data))
      .catch(err => console.error("❌ Error al cargar facturas:", err))
  }, [])

  return (
    <div>
      <h4 className="mb-4">📄 Lista de Facturas</h4>

      <table className="table table-bordered table-hover">
        <thead className="table-warning">
          <tr>
            <th>Nº Factura</th>
            <th>Cliente</th>
            <th>Fecha</th>
            <th>Subtotal</th>
            <th>IGV</th>
            <th>Total</th>
          </tr>
        </thead>
        <tbody>
          {facturas.map(factura => (
            <tr key={factura.numeroFactura}>
              <td>{factura.numeroFactura}</td>
              <td>{factura.cliente}</td>
              <td>{new Date(factura.fecha).toLocaleString()}</td>
              <td>COP ${factura.subTotal}</td>
              <td>COP ${factura.igv}</td>
              <td><strong>COP ${factura.total}</strong></td>
            </tr>
          ))}
        </tbody>
      </table>
    </div>
  )
}
