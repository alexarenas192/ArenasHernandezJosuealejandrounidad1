<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mapa del Sitio | Black Rouse</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <style>
    body {
      background-image: url('images/fondoindex.jpg');
      background-size: cover;
      background-position: center;
      background-attachment: fixed;
      color: white;
      font-family: cursive;
      font-style: italic;
      margin: 0;
    }
    .navbar-custom { background-color: rgba(0, 0, 0, 0.8); }
    .navbar-brand img { height: 40px; }
    .btn-volver { background-color: #e91e63; color: white; border: none; font-style: italic; }
    .btn-volver:hover { background-color: #d81b60; }
    h2 { color: #e0c2c0; }
    .container { max-width: 1000px; margin: auto; padding: 20px; }
    ul { list-style: none; padding: 0; }
    li { margin: 10px 0; }
    a { color: #ff4c4c; text-decoration: none; transition: 0.3s; }
    a:hover { color: #ff9f9f; }
    .cocktail { background-color: #1a1a1a; padding: 20px; margin: 20px 0; border-left: 5px solid #aa0e36; }
    .cocktail h3 { margin: 0 0 10px 0; color: #ff6688; }
    footer { background-color: rgba(0, 0, 0, 0.5); color: #f5f5f5; padding-top: 1rem; padding-bottom: 1rem; }
    footer a { color: #e63946; }
    footer a:hover { color: #ffffff; }
  </style>
</head>
<body>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark navbar-custom">
    <div class="container">
      <a class="navbar-brand" href="#"><img src="images/logo.jpg" alt="Logo"></a>
      <div class="ml-auto"><a href="index.php" class="btn btn-volver">← Regresar</a></div>
    </div>
  </nav>

  <div class="container">
    <h2>Secciones principales</h2>
    <ul>
      <li><a href="index.php">Inicio</a></li>
      <li><a href="ayuda.php">Ayuda</a></li>
      <li><a href="reservas.php">Contáctanos</a></li>
      <li><a href="chat.php">Chat</a></li>
    </ul>

    <h2 id="estrellas">Estrellas de la Noche</h2>
    <div class="cocktail" id="scarlet">
      <h3><a href="scarlet.php">Scarlet Desire</a></h3>
      <p>Pasión que se desborda en cada sorbo.</p>
    </div>
    <div class="cocktail" id="esmeralda">
      <h3><a href="esmeralda.php">Esmeralda de Medianoche</a></h3>
      <p>El misterio cítrico que ilumina la noche.</p>
    </div>
    <div class="cocktail" id="eclipse">
      <h3><a href="eclipse.php">Eclipse Rosa</a></h3>
      <p>Entre luces y sombras, nace el glamour.</p>
    </div>
    <div class="cocktail" id="velvet">
      <h3><a href="error.php">Velvet Poison</a></h3>
      <p>Dulce tentación con un toque letal.</p>
    </div>
  </div>

  <!-- Footer -->
  <footer class="text-center text-lg-start">
    <!-- Social media -->
    <section class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom">
      <div class="me-5 d-none d-lg-block"><span>Conéctate con nosotros en las redes sociales:</span></div>
      <div>
        <a href="#" class="me-4 text-reset"><i class="fab fa-facebook-f"></i></a>
        <a href="#" class="me-4 text-reset"><i class="fab fa-twitter"></i></a>
        <a href="#" class="me-4 text-reset"><i class="fab fa-google"></i></a>
        <a href="#" class="me-4 text-reset"><i class="fab fa-instagram"></i></a>
        <a href="#" class="me-4 text-reset"><i class="fab fa-linkedin"></i></a>
        <a href="#" class="me-4 text-reset"><i class="fab fa-github"></i></a>
      </div>
    </section>

    <!-- Links -->
    <section>
      <div class="container text-center text-md-start mt-5">
        <div class="row mt-3">
          <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
            <h6 class="text-uppercase fw-bold mb-4"><i class="fas fa-gem me-3"></i>Black Rouse</h6>
            <p>La elegancia en cada sorbo. Ven a descubrir nuestra coctelería de autor y vive una experiencia única.</p>
          </div>
          <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
            <h6 class="text-uppercase fw-bold mb-4">Productos</h6>
            <p><a href="#estrellas" class="text-reset">Cócteles</a></p>
            <p><a href="#" class="text-reset">Bebidas Premium</a></p>
            <p><a href="#" class="text-reset">Experiencias</a></p>
            <p><a href="#" class="text-reset">Accesorios</a></p>
          </div>
          <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
            <h6 class="text-uppercase fw-bold mb-4">Enlaces útiles</h6>
            <p><a href="menu.html" class="text-reset">Menú</a></p>
            <p><a href="reservaciones.html" class="text-reset">Reservaciones</a></p>
            <p><a href="eventos.html" class="text-reset">Eventos</a></p>
            <p><a href="ayuda.html" class="text-reset">Ayuda</a></p>
          </div>
          <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
            <h6 class="text-uppercase fw-bold mb-4">Contacto</h6>
            <p><i class="fas fa-home me-3"></i> Monterrey, NL, México</p>
            <p><i class="fas fa-envelope me-3"></i> contacto@blackrouse.mx</p>
            <p><i class="fas fa-phone me-3"></i> +52 81 1234 5678</p>
            <p><i class="fas fa-print me-3"></i> +52 81 8765 4321</p>
          </div>
        </div>
      </div>
    </section>

    <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.3);">© 2025 Black Rouse. Todos los derechos reservados.</div>
  </footer>
</body>
</html>
