<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Vivero El Paraíso</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="../style/style_index.css">
</head>
<body>

  <!-- Header -->

<header class="header-bg py-2">
  <div class="container d-flex justify-content-between align-items-center" id="header">
    <div class="d-flex align-items-center">
      <a class="navbar-brand" href="../Index.html">
        <img src="../Multimedia/LOGO SOLO.png" alt="Logo" height="50">
      </a>
      <h4 class="ms-2 header-text">Vivero el Paraíso</h4>
    </div>
    <div class="form-container d-flex align-items-center">
      <form class="d-flex align-items-center">
        <input class="form-control me-1 search-input" type="search" placeholder="Busca productos y mucho más" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Buscar</button>
      </form>
    </div>
    <button class="btn btn-outline-success">Iniciar Sesión 
      <i class='bx bxs-user' style='color:#004d00'></i>
    </button>
  </div>
</header>

<!-- Navigation -->
<div class="navbar-shadow">
<nav class="navbar navbar-expand-lg navbar-dark highlight-bg py-3">
  <div class="container">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
      <ul class="navbar-nav mb-2 mb-lg-0">
        <li class="nav-item mx-3"><a class="nav-link fs-5" href="../Index.html">Inicio</a></li>
        <li class="nav-item mx-3"><a class="nav-link fs-5" href="#">Producto</a></li>
        <li class="nav-item mx-3"><a class="nav-link fs-5" href="pagina/nosotros.html">Acerca de Nosotros</a></li>
        <li class="nav-item mx-3"><a class="nav-link active fs-5" href="blog.php">Blog</a></li>
        <li class="nav-item mx-3"><a class="nav-link fs-5" href="soport.html">Soporte</a></li>
        <li class="nav-item mx-3"><a class="nav-link fs-5" href="#">Contacto</a></li>
      </ul>
    </div>
  </div>
</nav>
</div>

  <!-- Carrusel-banner -->

  <div class="carousel-inner">
    <div class="carousel-item active">
        <img src="../Multimedia/BANNER.jpg" class="d-block w-100" alt="">
    </div> 
    <div class="carousel-item">
        <img src="#" class="d-block w-100" alt="">
    </div> 
  </div>

  
  <div class="container">
  <p><br><br></p><p><br><br></p>
    <h2 class="highlight">Blog</h2>
    <a href="entrada_blog.html" class="btn btn-primary mb-3">Agregar Nueva Entrada</a>
    <div class="row">
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "sistema_venta_compra";

        // Crear la conexión
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Verificar la conexión
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Obtener las entradas del blog
        $sql = "SELECT * FROM entradas ORDER BY fecha DESC";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo '<div class="col-md-4 mb-4">';
                echo '<div class="card">';
                echo '<div class="card-body">';
                echo '<h5 class="card-title">' . $row["titulo"] . '</h5>';
                echo '<p class="card-text">' . substr($row["contenido"], 0, 100) . '...</p>';
                echo '<a href="entrada.php?id=' . $row["id"] . '" class="btn btn-primary">Leer más</a>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo "No hay entradas aún.";
        }

        // Cerrar la conexión
        $conn->close();
        ?>
    </div>
    <p><br><br></p><p><br><br></p>
</div>


  <!-- Footer -->
  <footer class="footer-bg text-white py-4">
    <div class="container">
      <div class="row" id="footer-row">
        <div class="col-md-4 col-sm-12 cont-footer">
          <img class="logo-footer" src="../Multimedia/LOGO NAME.png" alt="Logo">
        </div>

        <div class="col-md-4 col-sm-12 cont-footer">
          <h5>Quiénes Somos</h5>
          <ul class="list-unstyled">
            <li><a href="../Index.html" class="text-white">Inicio</a></li>
            <li><a href="#" class="text-white">Productos</a></li>
            <li><a href="nosotros.html" class="text-white">Acerca de Nosotros</a></li>
            <li><a href="#" class="text-white">Soporte</a></li>
            <li><a href="#" class="text-white">Iniciar Sección</a></li>
            <li><a href="#" class="text-white">Regístrate</a></li>
          </ul>
        </div>

        <div class="col-md-4 col-sm-12 cont-footer">
          <h5>Contáctenos</h5>
          <p>Manzana 12 Casa 12 Villa Jaidith </p>
         <p> Colombia Valledupar Cesar</p>
          <p>Tel: 3145964947 | Cel: 3003123507</p>
          <p>Email: fontalvcoronado9@gmail.com</p>
        </div>
      </div>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
