<?php
    session_start();
    require_once 'db_ajeo.php';

    if (isset($_POST['cerrar_sesion'])) {
        session_destroy();
        echo '<script>window.location.href = "index.php";</script>';
        exit();
    }
    if (!isset($_SESSION['username'])) {
        echo '<script>window.location.href = "index.php";</script>';
        exit();
    }
?>
<?php
# Inicia Código de REGISTRAR

if (isset($_POST['registrar'])) {

    $coment = $_POST['coment'];;

    if (!empty($coment) && !empty($_SESSION['username'])) {
        $sql = $cnnPDO->prepare("INSERT INTO comentarios 
        (coment, username) VALUES (:coment, :username)");
        
        $sql->bindParam(':coment', $coment);
        $sql->bindParam(':username', $_SESSION['username']);
        
        $sql->execute();
        unset($sql);
        echo '<script>window.location.href = "comentario.php";</script>';
        exit();
    }
}
?>
<?php
# Código de BUSCAR

$GLOBALS['$coment'] = "";

if (isset($_POST['buscar'])) {
	
	$coment=$_POST['coment'];

	$query = $cnnPDO->prepare('SELECT * from comentarios WHERE coment =:coment');
	$query->bindParam(':coment', $coment);
	
	$query->execute(); 
	$count=$query->rowCount();
	$campo = $query->fetch();

	if($count)	{	
        
		$GLOBALS['$coment'] = $campo['coment'];
		
	} 
	else
		$GLOBALS['$coment'] = "";	

}
# Termina Código de BUSCAR
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/index.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Bootstrap Example</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>    
    <style>
  body {
    background-image: url('images/fondoindex.jpg');
    background-size: 100%;
}

</style>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">
        <img src="images/AJEO-logos_transparent.png" alt="Logo" class="logo" height="65 px" width="185 px" >
        </a>
        <form class="d-flex ms-auto">
          <div class="input-group">
              <input class="form-control" type="search" placeholder="Buscar" aria-label="Search">
              <button class="btn btn-outline-success" type="submit">
                  <i class="bi bi-search"></i>
              </button>
          </div>
        </form>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
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
                    <li class="nav-item">
                      <span class="nav-link">
                            <img src="images/Inicio Sesion.png" alt="Logo" height="35" width="35">
                            ' . $username . '
                      </span>
                    </li>
                        <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <img src="images/Conoce.png" alt="Logo" height="30" width="30">
                          Conoce mas...
                      </a>
                      <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                          <a class="dropdown-item" href="">Modificar Ofertas PDF</a>
                          <a class="dropdown-item" href="ver_perfil.php">Mostrar Perfiles</a>
                          <a class="dropdown-item" href="">Mostrar Tarjetas de <br>Credito/Debito</a>
                          <a class="nav-link" href="#" onclick="document.querySelector(\'form[name=\\\'logout-form\\\']\').submit(); return false;">Cerrar Sesión</a>
                          <form name="logout-form" action="" method="post" style="display: none;">
                              <input type="hidden" name="cerrar_sesion">
                          </form>
                      </div>
                    </li>
                    ';
                } else {
                    // Mostrar usuarios
                  echo '
                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img src="images/Inicio Sesion.png" alt="Logo" height="35" width="35">
                    ' . $username . '
                    </a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <a class="nav-link" href="#" onclick="document.querySelector(\'form[name=\\\'logout-form\\\']\').submit(); return false;">Cerrar Sesión</a>
                        <form name="logout-form" action="" method="post" style="display: none;">
                            <input type="hidden" name="cerrar_sesion">
                        </form>
                    </div>
                  </li>
                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img src="images/Conoce.png" alt="Logo" height="30" width="30">
                        Conoce mas...
                    </a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <a class="dropdown-item" href="">Ofertas en PDF</a>
                        <a class="dropdown-item" href="ver_perfil.php">Mi Perfil</a>
                        <a class="dropdown-item" href="ver_tarjetas.php">Mis Tarjetas</a>
                        <a class="dropdown-item" href="registrar_tarjeta.php">Agregar Tarjeta <br>Credito/Debito</a>
                    </div>
                  </li>
                  ';
                }
            } else {
                // Usuario no ha iniciado sesión
                echo '
                
                ';
            }
            ?>
            </ul>
        </div>
    </div>
    </nav>
    <nav class="custom-nav">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="false" onclick="window.location.href='index.php';">Home</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Categoria</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link active" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact-tab-pane" type="button" role="tab" aria-controls="contact-tab-pane" aria-selected="true" onclick="window.location.href='comentario.php';">Comentarios</button>
</li>
  <li class="nav-item" role="presentation">
  <button class="nav-link" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling">Nosotros...</button>    
  <div class="offcanvas offcanvas-start" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">
  <div class="offcanvas-header">
  <h5 class="offcanvas-title" id="offcanvasLabel">BIENVENIDOS A</h5>
  <img src="images/AJEO-logos_transparent.png" alt="Logo" class="logo" height="65 px" width="185 px" >
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
    <p>Bienvenidos a Ajeo, tu nuevo destino para la moda en línea. Inspirada por el éxito de Shein, Ajeo busca revolucionar tu experiencia de compra en línea. ¿La diferencia?<br><br> Esta plataforma fue creada por cuatro personas apasionadas y con siete litros de café en el sistema.
  <br><br>Imagina un lugar donde la moda se encuentra con la innovación. <br><br>En Ajeo, encontrarás las últimas tendencias y un enfoque fresco para el estilo. Nuestro equipo de visionarios se esforzó para unir belleza y comodidad en cada detalle.  </div></p>
  </div>
</div>
  </li>
</ul>
  </nav>
    <div class="container">
    <h2 style="font-size: 24px; text-align: center;"><br>
    <img src="images/AJEO-logos_transparent.png" alt="Logo" class="logo" height="65 px" width="185 px" >
    </h2>
    <div class="form-container">
    <form name="form1" method="post" enctype="multipart/form-data"> 
                    <div class="card-body">
                        <div class="form-group">
                        
                    <div class="form-group">
                        <label for="nombre">Comentarios:</label>
                        <input type="text" class="form-control" name="coment" placeholder="Ingrese un comentario"
                            value="<?php echo $GLOBALS['$coment']; ?>">
                    </div>
                    </div><br>
                    <div class="btn-group d-flex justify-content-center" role="group" aria-label="Botones">
                    <button type="submit" name="registrar" class="btn btn-primary" >Agregar Comentario</button>
                    <br>
                </div>
            </div>
        </form>
    </div>
</div>
<section class="comments-section">
  <div class="container" style="width: 80%; margin-top: 90px;">
    <?php
    $sql = $cnnPDO->prepare("SELECT * FROM comentarios");
    $sql->execute();
    ?>

    <div class="comments-container">
      <?php
      while ($campo = $sql->fetch(PDO::FETCH_ASSOC)) {
      ?>
        <div class="comment-box">
          <div class="comment-row">
            <div class="comment-content">
              <p class="comment-text"><?php echo $campo['coment']; ?></p>
              <p class="comment-user">Por <?php echo $campo['username']; ?></p>
            </div>
          </div>
        </div>
      <?php
      }
      ?>
    </div>
  </div>
</section>
</head>
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
