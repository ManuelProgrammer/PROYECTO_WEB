import React, { useEffect, useState } from 'react';
import '../App.css';

function Destacados() {
  const [destacados, setDestacados] = useState([]);

  useEffect(() => {
    fetch('/mi_proyecto/api/productos_destacados.php')
      .then(res => res.json())
      .then(data => setDestacados(data));
  }, []);

  const agregarAlCarrito = (producto) => {
    const carrito = JSON.parse(localStorage.getItem('carrito')) || [];

    const existente = carrito.find(p => p.id === producto.id);

    if (existente) {
      existente.cantidad += 1;
    } else {
      carrito.push({ ...producto, cantidad: 1 });
    }

    localStorage.setItem('carrito', JSON.stringify(carrito));
    alert('✅ Producto agregado al carrito');
  };

  if (destacados.length === 0) return null;

  return (
    <div className="container py-5">
      <h3 className="mb-4 text-center text-success">🌿 Productos Destacados</h3>
      <div className="row">
        {destacados.map(p => (
          <div className="col-md-4 mb-4" key={p.id}>
            <div className="card h-100 shadow-sm animate-hover">
              <img
                src={`http://localhost/mi_proyecto/multimedia/${p.imagen || 'no-image.png'}`}
                className="card-img-top"
                onError={e => e.target.src = '/mi_proyecto/multimedia/no-image.png'}
                alt={p.nombre}
              />
              <div className="card-body">
                <h5 className="card-title text-start">{p.nombre}</h5>
                <p className="card-text text-start">{p.descripcion}</p>
                <p className="card-text fw-bold text-success text-start">COP ${p.precio}</p>
                <button
                  className="btn btn-success w-100 mt-2"
                  onClick={() => agregarAlCarrito(p)}
                >
                  <i className="bi bi-cart-plus me-2"></i> Agregar al carrito
                </button>
              </div>
            </div>
          </div>
        ))}
      </div>
    </div>
  );
}

export default Destacados;
