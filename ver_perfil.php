<?php
session_start();

require_once 'db_ajeo.php';

if (!isset($_SESSION['username'])) {
  echo '<script>window.location.href = "index.php";</script>';
  exit();
}

# Inicia Código de EDITAR o MODIFICAR

if (isset($_POST['editar'])) 
{  
    $nombre = $_POST['nombre'];
    $username = $_POST['username'];
    $password = $_POST['pasword'];
    
    if(!empty($nombre) && !empty($username) && !empty($password))
    {  
        $sql = $cnnPDO->prepare(
            'UPDATE usuarios SET nombre = :nombre, username = :username, pasword = :pasword WHERE email = :email'
        );
        
        $sql->bindParam(':nombre', $nombre);
        $sql->bindParam(':username', $username);
        $sql->bindParam(':pasword', $password);
        $sql->bindParam(':email', $_SESSION['email']);

        $sql->execute();
        unset($sql);
        unset($cnnPDO);
        
        $_SESSION['username'] = $username;

        echo '<script>window.location.href = "index.php";</script>';
        exit();
        
    }
}
# Termina Código de EDITAR o MODIFICAR
?>
<?php
# Código de ELIMINAR

if (isset($_POST['eliminar'])) {
  
  $nombre=$_POST['nombre'];

  if (!empty($nombre)){
    $query = $cnnPDO->prepare('DELETE from usuarios WHERE nombre =:nombre');
    $query->bindParam(':nombre', $nombre);
    
    $query->execute(); 
    session_destroy();
    echo '<script>window.location.href = "index.php";</script>';
    exit();
  }
  
# Termina Código de ELIMINAR
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Mi Perfil | Black Rouse</title>

  <!-- Bootstrap 5.3 y FontAwesome -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />

  <style>
    /* Fondo de página */
    body {
      background-image: url('images/fondoindex2.jpg');
      background-size: cover;
      background-position: center;
      font-family: Arial, sans-serif;
      color: #fff;
      min-height: 100vh;
      margin: 0;
      display: flex;
      flex-direction: column;
    }
    /* Navbar oscuro + rosa */
    nav.navbar {
      background-color: #000;
      box-shadow: 0 2px 8px rgba(0,0,0,0.8);
      padding: .5rem 1rem;
    }
    nav .navbar-brand img {
      height: 60px;
    }
    nav .form-control {
      background-color: #222;
      border: 1px solid #444;
      color: #eee;
    }
    nav .form-control::placeholder {
      color: #bbb;
    }
    nav .btn-outline-success {
      border-color: #ff0047;
      color: #ff0047;
    }
    nav .btn-outline-success:hover {
      background-color: #ff0047;
      color: #fff;
    }
    nav .nav-link img {
      filter: invert(1);
    }

    /* Contenedor de tarjetas */
    .profile-section {
      flex: 1;
      padding: 2rem 1rem;
    }
    .card-container {
      display: flex;
      flex-wrap: wrap;
      gap: 2rem;
      justify-content: center;
    }
    .card {
      background-color: rgba(0,0,0,0.6);
      border: none;
      border-radius: 8px;
      width: 320px;
      box-shadow: 0 0 15px rgba(0,0,0,0.7);
      overflow: hidden;
    }
    .card-head {
      background-color: rgba(255,0,71,0.8);
      padding: .75rem;
      text-align: center;
      font-weight: bold;
    }
    .card-image {
      text-align: center;
      padding: 1rem;
    }
    .card-image img {
      width: 180px;
      height: 180px;
      object-fit: cover;
      border-radius: 50%;
      border: 3px solid #ff0047;
    }
    .card-body {
      padding: 1rem;
    }
    .form-label {
      color: #ddd;
      font-weight: 600;
    }
    .form-control {
      background-color: #222;
      border: 1px solid #444;
      color: #fff;
      margin-bottom: 1rem;
    }
    .btn-group .btn {
      background-color: #ff0047;
      border: none;
      color: #fff;
      width: 100%;
      margin-top: .5rem;
      transition: background-color .3s;
    }
    .btn-group .btn:hover {
      background-color: #cc0038;
    }
  </style>
</head>
<body>
  <!-- TU PHP / SESSION_START aquí -->

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.php">
        <img src="images/logo.jpg" alt="Logo">
      </a>
      
      <div class="collapse navbar-collapse">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link" href="index.php">
              <img src="images/Regresar.png" alt="Regresar" height="30" width="30">
              Regresar
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Sección Perfil -->
  <section class="profile-section">
    <div class="container">
      <div class="card-container">
        <?php
          $sql = $cnnPDO->prepare("SELECT * FROM usuarios WHERE email = :email");
          $sql->bindParam(':email', $_SESSION['email']);
          $sql->execute();
          while ($campo = $sql->fetch(PDO::FETCH_ASSOC)) {
        ?>
        <div class="card">
          <div class="card-head">Foto de Perfil</div>
          <div class="card-image">
            <?php 
              $rutaFoto = htmlspecialchars($campo['imagen']);
              if (!empty($rutaFoto) && file_exists($rutaFoto)): 
            ?>
              <img src="<?= $rutaFoto ?>" alt="Perfil">
            <?php else: ?>
              <p style="color:#bbb;">No hay foto.</p>
            <?php endif; ?>
          </div>
          <div class="card-body">
            <form method="post" action="">
              <label class="form-label" for="nombre">Nombre</label>
              <input type="text" id="nombre" name="nombre" class="form-control" value="<?= $campo['nombre'] ?>">

              <label class="form-label" for="username">Username</label>
              <input type="text" id="username" name="username" class="form-control" value="<?= $campo['username'] ?>">

              <label class="form-label" for="email">Email</label>
              <input type="email" id="email" name="email" class="form-control" value="<?= $campo['email'] ?>">

              <label class="form-label" for="pasword">Password</label>
              <input type="text" id="pasword" name="pasword" class="form-control" value="<?= $campo['pasword'] ?>">

              <div class="btn-group" role="group">
                <button class="btn" name="editar" type="submit">
                  <i class="fas fa-save"></i> Guardar
                </button>
                <button class="btn" name="eliminar" type="submit">
                  <i class="fas fa-trash-alt"></i> Eliminar
                </button>
              </div>
            </form>
          </div>
        </div>
        <?php } ?>
      </div>
    </div>
  </section>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
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
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.min.js"></script>
<!-- MDB core JavaScript -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/js/mdb.min.js"></script>