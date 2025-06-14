<?php
    session_start();
    require_once 'db_ajeo.php';

    if (isset($_POST['cerrar_sesion'])) {
        session_destroy();
        echo '<script>window.location.href = "index.php";</script>';
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <!-- Google Font cursiva elegante -->
  <link
    href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@1,400;1,700&display=swap"
    rel="stylesheet"
  />
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
    rel="stylesheet"
  />
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
  />
  <title>Black Rouse</title>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <style>
    /* ---------------------------------------------------
       TIPOGRAFÍA Y COLORES GENERALES
    --------------------------------------------------- */
    body,
    .nav-link,
    .btn,
    h1,
    h5,
    p,
    .card .card-title,
    .card .card-text {
      font-family: 'Playfair Display', serif;
      font-style: italic;
      color: #ffffff !important; /* Todas las letras en blanco */
    }

    body {
      background-image: url('images/fondoindex.jpg');
      background-size: cover;
      background-position: center;
      color: #ffffff;
    }

    /* ---------------------------------------------------
       NAVBAR PRINCIPAL (Transparente 30%)
    --------------------------------------------------- */
    .navbar-custom {
      background-color: rgba(0, 0, 0, 0.3) !important;
      padding-top: 0.8rem;
      padding-bottom: 0.8rem;
    }
    .navbar-custom .navbar-brand img {
      filter: none !important;
      max-height: 60px;
      width: auto;
      /* Sutil sombra para destacar el logotipo */
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.5);
      margin-right: 1rem;
    }
    .navbar-custom .nav-link,
    .navbar-custom .dropdown-toggle {
      color: #ffffff !important;
      padding: 0.6rem 1rem;
    }
    .navbar-custom .nav-link:hover,
    .navbar-custom .dropdown-toggle:hover {
      color: #e63946 !important; /* Rojo suave al pasar */
    }
    .navbar-custom .dropdown-menu {
      background-color: rgba(0, 0, 0, 0.6);
      border: none;
      margin-top: 0.3rem;
    }
    .navbar-custom .dropdown-item {
      color: #ffffff !important;
      padding: 0.5rem 1rem;
    }
    .navbar-custom .dropdown-item:hover {
      background-color: rgba(230, 57, 70, 0.1);
      color: #e63946 !important;
    }
    .navbar-toggler {
      border-color: rgba(255, 255, 255, 0.7);
    }
    .navbar-toggler-icon {
      filter: invert(1);
    }

    /* ---------------------------------------------------
       BOTONES PERSONALIZADOS (“Ayuda”, “Contáctanos”, “Chat”)
       - Rojo difuminado / semitransparente
       - Bordes redondeados
       - No cambian a blanco cuando están activos
    --------------------------------------------------- */
    .btn-custom {
      color: #ffffff;
      background: rgba(230, 57, 70, 0.5); /* Rojo semitransparente */
      border: 2px solid rgba(230, 57, 70, 0.8);
      border-radius: 50px;
      padding: 0.4rem 1.3rem;
      font-size: 0.95rem;
      transition: background 0.3s, color 0.3s;
    }
    .btn-custom:hover {
      background: rgba(230, 57, 70, 0.8);
      color: #ffffff;
    }
    /* Si algún .btn-custom queda con clase active o focus */
    .btn-custom.active,
    .btn-custom:active,
    .btn-custom:focus {
      background: rgba(230, 57, 70, 0.7);
      color: #ffffff;
      outline: none;
      box-shadow: none;
    }

    /* ---------------------------------------------------
       SEGUNDO NAV TRANSPARENTE (Tabs)
       - Pestañas activas en rojo transparente, texto blanco
    --------------------------------------------------- */
    .custom-nav {
      background-color: rgba(0, 0, 0, 0.25);
      padding-top: 0.4rem;
      padding-bottom: 0.4rem;
    }
    .custom-nav .nav-tabs {
      border-bottom: none;
      justify-content: center;
    }
    .custom-nav .nav-tabs .nav-link {
      color: #ffffff;
      background-color: transparent;
      border: none;
      margin: 0 0.5rem;
      padding: 0.5rem 1rem;
      transition: background 0.3s;
    }
    .custom-nav .nav-tabs .nav-link:hover {
      color: #e63946;
    }
    .custom-nav .nav-tabs .nav-link.active {
      color: #ffffff;
      background-color: rgba(230, 57, 70, 0.4); /* Rojo transparente */
      border: none;
    }

    /* ---------------------------------------------------
       CARRUSEL
    --------------------------------------------------- */
    .carousel-inner {
      height: 500px; /* Altura fija */
    }
    .carousel-img {
      width: 100%;
      height: 100%;
      object-fit: cover; /* Recorta sin distorsión */
    }

    /* ---------------------------------------------------
       TABLA DE IMÁGENES (Bienvenidos)
    --------------------------------------------------- */
    .image-table img {
      width: 100%;
      height: auto;
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.3);
    }

    /* ---------------------------------------------------
       CARTAS (CARDS) CON SOMBRAS SUAVES Y FONDO SEMITRANSPARENTE
    --------------------------------------------------- */
.card {
  background: radial-gradient(circle, rgba(0,0,0,0.95) 0%, rgba(0,0,0,0.8) 70%, rgba(0,0,0,0.6) 100%);
  border: none;
  border-radius: 12px;
  box-shadow: 0 6px 12px rgba(0,0,0,0.8);
  margin-bottom: 1rem;
  overflow: hidden;
}

.card-img-top {
  height: 460px; /* fotos más largas */
  object-fit: cover;
  width: 100%;
}

.card-body {
  background: radial-gradient(circle, rgba(0,0,0,0.95) 0%, rgba(0,0,0,0.8) 70%, rgba(0,0,0,0.6) 100%);
  padding: 1rem;
}

.card .card-title,
.card .card-text {
  color: #ffffff;
  font-style: italic;
  font-family: 'Playfair Display', serif;
}

.card .btn-primary {
  color: #ffffff;
  background: linear-gradient(45deg, rgba(230, 57, 70, 0.6), rgba(180, 30, 45, 0.6));
  border: none;
  border-radius: 50px;
  padding: 0.5rem 1.4rem;
  font-family: 'Playfair Display', serif;
  font-style: italic;
  transition: background 0.3s ease, opacity 0.3s ease;
}

.card .btn-primary:hover {
  background: linear-gradient(45deg, rgba(230, 57, 70, 0.9), rgba(150, 20, 35, 0.9));
  opacity: 0.9;
}
    /* ---------------------------------------------------
       FOOTER
    --------------------------------------------------- */
    footer {
      background-color: rgba(0, 0, 0, 0.5);
      color: #f5f5f5;
      padding-top: 1rem;
      padding-bottom: 1rem;
    }
    footer a {
      color: #e63946;
    }
    footer a:hover {
      color: #ffffff;
    }

    /* ---------------------------------------------------
       MARGEN ENTRE BOTONES DE NAVBAR
    --------------------------------------------------- */
    .nav-item .btn-custom {
      margin-left: 0.4rem;
      margin-right: 0.4rem;
    }
    /* Canvas lateral "Sobre nosotros" */
#offcanvasScrolling {
  position: fixed;
  top: 0;
  right: -100%;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.9); /* Fondo negro transparente */
  color: #fff;
  font-style: italic;
  font-family: 'Playfair Display', serif;
  padding: 3rem 2rem;
  box-sizing: border-box;
  z-index: 1050;
  overflow-y: auto;
  transition: right 0.4s ease;
}

/* Mostrar canvas */
#offcanvasScrolling.show {
  right: 0;
}
/* Botón de cerrar */
#cerrarCanvas {
  position: absolute;
  top: 20px;
  right: 30px;
  font-size: 26px;
  background: none;
  border: none;
  color: #ffffff;
  cursor: pointer;
  z-index: 1100;
}

/* Texto dentro del canvas */
#canvasSobreNosotros .contenido p {
  font-size: 20px;
  line-height: 1.7;
  white-space: pre-line;
}

form.d-flex input.form-control {
  background-color: rgba(255,255,255,0.1);
  border: 1px solid #fff;
  color: #fff;
}
form.d-flex input.form-control::placeholder {
  color: rgba(255,255,255,0.7);
}
form.d-flex .btn {
  border-color: #e63946;
  color: #fff;
}


  </style>
</head>
<body>
  <!-- Navbar principal -->
  <nav class="navbar navbar-expand-lg navbar-custom">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">
        <!-- El logo se mostrará en sus colores originales -->
        <img src="images/logo.jpg" alt="Logo Black Rouse" height="60" width="auto" />
      </a>
      <button
        class="navbar-toggler"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#navbarNav"
        aria-controls="navbarNav"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav align-items-center">
          <?php
            if (isset($_SESSION['email'])) {
              $username = $_SESSION['username'];
              $email = $_SESSION['email'];
              $es_administrador = false;
              if ($username === 'admin' && $email === 'aministrador@wallet.com') {
                $es_administrador = true;
              }
              if ($es_administrador) {
                // Mostrar admin
                echo '
                <li class="nav-item me-3">
                  <a class="nav-link" href="Compras.php">
                    <i class="fas fa-shopping-bag me-1"></i>
                  </a>
                </li>
                <li class="nav-item dropdown me-3">
                  <a
                    class="nav-link dropdown-toggle"
                    href="#"
                    role="button"
                    id="dropdownMenuLink"
                    data-bs-toggle="dropdown"
                    aria-haspopup="true"
                    aria-expanded="false"
                  >
                    <i class="fas fa-user-circle me-1"></i>' . htmlspecialchars($username) . '
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="ver_perfil.php">Mi Perfil</a></li>
                    <li><a class="dropdown-item" href="#" onclick="document.querySelector(\'form[name=\\\'logout-form\\\']\').submit(); return false;">Cerrar Sesión</a></li>
                  </ul>
                  <form name="logout-form" action="" method="post" style="display: none;">
                    <input type="hidden" name="cerrar_sesion" />
                  </form>
                </li>
                <li class="nav-item dropdown me-3">
                  <a
                    class="nav-link dropdown-toggle"
                    href="#"
                    role="button"
                    id="dropdownMenuLink2"
                    data-bs-toggle="dropdown"
                    aria-haspopup="true"
                    aria-expanded="false"
                  >
                    <i class="fas fa-info-circle me-1"></i>Conoce más
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="">Modificar PDF</a></li>
                    <li><a class="dropdown-item" href="m"></a></li>
                    <li><a class="dropdown-item" href=""></a></li>
                  </ul>
                </li>
                ';
              } else {
                // Mostrar usuarios
                echo '
                <li class="nav-item me-3">
                  <a class="nav-link" href="">
                    <i class="fas fa-shopping-cart me-1"></i>
                  </a>
                </li>
                <li class="nav-item dropdown me-3">
                  <a
                    class="nav-link dropdown-toggle"
                    href="#"
                    role="button"
                    id="dropdownMenuLink3"
                    data-bs-toggle="dropdown"
                    aria-haspopup="true"
                    aria-expanded="false"
                  >
                    <i class="fas fa-user-circle me-1"></i>' . htmlspecialchars($username) . '
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="ver_perfil.php">Mi Perfil</a></li>
                    <li><a class="dropdown-item" href="#" onclick="document.querySelector(\'form[name=\\\'logout-form\\\']\').submit(); return false;">Cerrar Sesión</a></li>
                  </ul>
                  <form name="logout-form" action="" method="post" style="display: none;">
                    <input type="hidden" name="cerrar_sesion" />
                  </form>
                </li>
                <li class="nav-item dropdown me-3">
                  <a
                    class="nav-link dropdown-toggle"
                    href="#"
                    role="button"
                    id="dropdownMenuLink4"
                    data-bs-toggle="dropdown"
                    aria-haspopup="true"
                    aria-expanded="false"
                  >
                    <i class="fas fa-info-circle me-1"></i>Conoce más
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href=""></a></li>
                    <li><a class="dropdown-item" href=""></a></li>
                    <li><a class="dropdown-item" href=""></a></li>
                  </ul>
                </li>
                ';
              }
            } else {
            // Usuario no ha iniciado sesión
// Usuario no ha iniciado sesión
echo '
  <li class="nav-item me-3">
    <form class="d-flex" role="search" action="esmeralda.php" method="get">
      <input class="form-control me-2" type="search" name="q" placeholder="Buscar..." aria-label="Buscar">
      <button class="btn btn-outline-light" type="submit"><i class="fas fa-search"></i></button>
    </form>
  </li>
  <li class="nav-item me-3">
    <a class="nav-link" href="inicio_sesion.php">
      <i class="fas fa-sign-in-alt me-1"></i>Iniciar Sesión
    </a>
  </li>
  <li class="nav-item dropdown me-3">
    <a
      class="nav-link dropdown-toggle"
      href="#"
      role="button"
      id="dropdownMenuLink5"
      data-bs-toggle="dropdown"
      aria-haspopup="true"
      aria-expanded="false"
    >
      <i class="fas fa-info-circle me-1"></i>Conoce más
    </a>
    <ul class="dropdown-menu dropdown-menu-end"><li><a class="dropdown-item" href="images/menu.jpg" download="">nuestro menu</a></li>
     <li><a class="dropdown-item" href="images/mixologia.jpg" download="MIXOLOGIA">Mixología</a></li>
    </ul>
  </li>
';
}
?>

          <!-- Botones de Ayuda, Contáctanos y Chat -->
          <li class="nav-item me-2">
            <a href="ayuda.php" class="btn btn-custom">Ayuda</a>
          </li>
          <li class="nav-item me-2">
            <a href="reservas.php" class="btn btn-custom">Contáctanos</a>
          </li>
          <li class="nav-item">
            <a href="chat.php" class="btn btn-custom">Chat</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Segundo nav transparente -->
  <nav class="custom-nav">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
      <li class="nav-item" role="presentation">
        <button
          class="nav-link active"
          id="home-tab"
          data-bs-toggle="tab"
          data-bs-target="#home-tab-pane"
          type="button"
          role="tab"
          aria-controls="home-tab-pane"
          aria-selected="true"
        >Home</button>
      </li>
      <li class="nav-item" role="presentation">
        <button
          class="nav-link"
          id="profile-tab"
          data-bs-toggle="tab"
          data-bs-target="#profile-tab-pane"
          type="button"
          role="tab"
          aria-controls="profile-tab-pane"
          aria-selected="false"
          onclick="window.location.href='mapa del sitio.php';"
        >mapa del sitio</button>
      </li>
      <li class="nav-item" role="presentation">
        <button
          class="nav-link"
          id="contact-tab"
          data-bs-toggle="tab"
          data-bs-target="#contact-tab-pane"
          type="button"
          role="tab"
          aria-controls="contact-tab-pane"
          aria-selected="false"
          onclick="window.location.href='comentario.php';"
        ></button>
      </li>
      <li class="nav-item" role="presentation">
        <button
          class="nav-link"
          type="button"
          data-bs-toggle="offcanvas"
          data-bs-target="#offcanvasScrolling"
          aria-controls="offcanvasScrolling"
        >Nosotros...     </button>
        <div
          class="offcanvas offcanvas-start"
          data-bs-scroll="true"
          data-bs-backdrop="false"
          tabindex="-1"
          id="offcanvasScrolling"
          aria-labelledby="offcanvasLabel"
        >
          <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasLabel">BIENVENIDOS A</h5>
            <img src="images/logo.jpg" alt="Logo" class="logo" height="60" width="180" />
            <button
              type="button"
              class="btn-close btn-close-white"
              data-bs-dismiss="offcanvas"
              aria-label="Close"
            ></button>
          </div>
          <div class="offcanvas-body">
            <p>
  Bienvenido a <strong>Black Rouse</strong>, el club nocturno donde las reglas se rompen y la diversión nunca termina. Aquí, el lema es claro: <em>“Pórtate mal, pásalo bien y luego... niégalo todo”</em>.<br /><br />
  Sumérgete en un ambiente mágico, un refugio exclusivo donde cada noche se transforma en una experiencia única. Déjate envolver por luces, música y una vibra que despierta tus sentidos.<br /><br />
  Disfruta de nuestra exquisita mixología, con cócteles preparados por maestros que combinan arte y sabor en cada trago. Además, nuestro menú cuidadosamente diseñado deleitará tu paladar con sabores sorprendentes e innovadores.<br /><br />
  En Black Rouse no solo sales de fiesta, entras a un mundo donde la pasión y la diversión se encuentran para crear momentos inolvidables. ¿Estás listo para vivir la noche como nunca antes?
</p>

          </div>
        </div>
      </li>
    </ul>
  </nav>

  <!-- Carrusel con las 3 imágenes solicitadas -->
  <section>
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-indicators">
        <button
          type="button"
          data-bs-target="#carouselExampleIndicators"
          data-bs-slide-to="0"
          class="active"
          aria-current="true"
          aria-label="Slide 1"
        ></button>
        <button
          type="button"
          data-bs-target="#carouselExampleIndicators"
          data-bs-slide-to="1"
          aria-label="Slide 2"
        ></button>
        <button
          type="button"
          data-bs-target="#carouselExampleIndicators"
          data-bs-slide-to="2"
          aria-label="Slide 3"
        ></button>
      </div>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img
            src="images/shutt.jpg"
            class="d-block carousel-img"
            alt="Interior Black Rouse"
          />
        </div>
        <div class="carousel-item">
          <img
            src="images/barra.jpg"
            class="d-block carousel-img"
            alt="Detalle Coctelero"
          />
        </div>
        <div class="carousel-item">
          <img
            src="images/fondito.jpg"
            class="d-block carousel-img"
            alt="Ambiente Nocturno"
          />
        </div>
      </div>
      <button
        class="carousel-control-prev"
        type="button"
        data-bs-target="#carouselExampleIndicators"
        data-bs-slide="prev"
      >
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Anterior</span>
      </button>
      <button
        class="carousel-control-next"
        type="button"
        data-bs-target="#carouselExampleIndicators"
        data-bs-slide="next"
      >
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Siguiente</span>
      </button>
    </div>
    <hr />
  </section>

  <br />

  <!-- Sección de bienvenida -->
  <section>
    <h1 class="text-center mb-4">BIENVENIDOS A</h1>
    <table class="image-table mx-auto">
      <tr>
        <td><img src="images/table 1.jpg" alt="Ambiente 1" /></td>
        <td><img src="images/table 2.jpg" alt="Ambiente 2" /></td>
        <td><img src="images/table 3.jpg" alt="Ambiente 3" /></td>
      </tr>
    </table>
  </section>
  <hr class="my-5" />

  <!-- Sección: Lo más vendido / Cocteles -->
<section>
  <h1 class="text-center mb-4">Estrellas de la Noche</h1>
  <div class="row justify-content-center g-4">
    <div class="col-md-3 col-sm-6">
      <div class="card custom-card">
        <img src="images/coctel1.jpg" class="card-img-top custom-img" alt="Polister" />
        <div class="card-body text-center">
          <h5 class="card-title">Scarlet Desire</h5>
          <p class="card-text">Pasión que se desborda en cada sorbo.</p>
          <a href="scarlet.php" class="btn custom-btn">Ver Fotos</a>
        </div>
      </div>
    </div>
    <div class="col-md-3 col-sm-6">
      <div class="card custom-card">
        <img src="images/coctel2.jpg" class="card-img-top custom-img" alt="Rayon" />
        <div class="card-body text-center">
          <h5 class="card-title">Esmeralda de Medianoche</h5>
          <p class="card-text">El misterio cítrico que ilumina la noche.</p>
          <a href="esmeralda.php" class="btn custom-btn">Ver Fotos</a>
        </div>
      </div>
    </div>
    <div class="col-md-3 col-sm-6">
      <div class="card custom-card">
        <img src="images/coctel3.jpg" class="card-img-top custom-img" alt="Licra" />
        <div class="card-body text-center">
          <h5 class="card-title">Eclipse Rosa</h5>
          <p class="card-text">Entre luces y sombras, nace el glamour.</p>
          <a href="eclipse.php" class="btn custom-btn">Ver Fotos</a>
        </div>
      </div>
    </div>
    <div class="col-md-3 col-sm-6">
      <div class="card custom-card">
        <img src="images/coctel4.jpg" class="card-img-top custom-img" alt="Algodón" />
        <div class="card-body text-center">
          <h5 class="card-title"> Velvet Poison</h5>
          <p class="card-text"> Dulce tentación con un toque letal.</p>
          <a href="error.php" class="btn custom-btn">Ver Fotos</a>
        </div>
      </div>
    </div>
  </div>
</section>
  <br /><br />

  <!-- Sección de productos dinámicos -->
  <section>
    <div class="row justify-content-center g-4">
      <?php
        $sql = $cnnPDO->prepare("SELECT * FROM compras");
        $sql->execute();
        while ($campo = $sql->fetch(PDO::FETCH_ASSOC)) {
      ?>
          <div class="col-md-3 col-sm-6">
            <div class="card">
              <?php echo '<img class="card-img-top" src="data:images/png;base64,' . base64_encode($campo['imagen']) . '" />'; ?>
              <div class="card-body text-center">
                <h5 class="card-title"><?php echo htmlspecialchars($campo['producto']); ?></h5>
                <p class="card-text"><?php echo htmlspecialchars($campo['descripcion']); ?></p>
                <a href="ver_producto.php?producto_id=<?php echo $campo['producto_id']; ?>" class="btn btn-primary">Ver Fotos</a>
              </div>
            </div>
          </div>
      <?php
        }
      ?>
    </div>
  </section>

  <?php
      if (isset($_SESSION['email'])) {
          $username = $_SESSION['username'];
          $email = $_SESSION['email'];
          $es_administrador = false;
          if ($username === 'admin' && $email === 'aministrador@wallet.com') {
              $es_administrador = true;
          }
          if ($es_administrador) {
              // Botón para agregar producto
              echo '
              <div class="row justify-content-center mt-5">
                <div class="col-auto">
                  <a href="crear_producto.php" class="btn btn-custom btn-lg">
                    <i class="fas fa-plus-circle me-2"></i>Agregar Producto
                  </a>
                </div>
              </div>
              ';
          }
      }
  ?>

  <br /><br />

  <!-- Footer -->
  <footer class="text-center text-lg-start">
    <!-- Social media -->
    <section class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom">
      <div class="me-5 d-none d-lg-block">
        <span>Conéctate con nosotros en las redes sociales:</span>
      </div>
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
            <p>
              La elegancia en cada sorbo. Ven a descubrir nuestra coctelería de autor y vive una experiencia única.
            </p>
          </div>
          <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
            <h6 class="text-uppercase fw-bold mb-4">Productos</h6>
            <p><a href="#!" class="text-reset">Cócteles</a></p>
            <p><a href="#!" class="text-reset">Bebidas Premium</a></p>
            <p><a href="#!" class="text-reset">Experiencias</a></p>
            <p><a href="#!" class="text-reset">Accesorios</a></p>
          </div>
          <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
            <h6 class="text-uppercase fw-bold mb-4">Enlaces útiles</h6>
            <p><a href="#!" class="text-reset">Menú</a></p>
            <p><a href="#!" class="text-reset">Reservaciones</a></p>
            <p><a href="#!" class="text-reset">Eventos</a></p>
            <p><a href="#!" class="text-reset">Ayuda</a></p>
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

    <!-- Copyright -->
    <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.3);">
      © 2025 Black Rouse. Todos los derechos reservados.
    </div>
  </footer>
</body>
</html>

<!-- CDN  MDB 4.19.1 -->
<!-- CSS -->
<!-- Font Awesome -->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
<!-- Google Fonts -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
<!-- Bootstrap core CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
<!-- Material Design Bootstrap -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/css/mdb.min.css" rel="stylesheet">

<!-- JavaScript -->
<!-- JQuery -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- Bootstrap tooltips -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript"
    src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.min.js"></script>
<!-- MDB core JavaScript -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/js/mdb.min.js"></script>
```
