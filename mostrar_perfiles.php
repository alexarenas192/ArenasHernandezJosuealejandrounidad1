<?php
session_start();

require_once 'db_ajeo.php';

if (!isset($_SESSION['username'])) {
  echo '<script>window.location.href = "index.php";</script>';
  exit();
}

# Código de ELIMINAR

if (isset($_POST['eliminar'])) {
	
	$nombre=$_POST['nombre'];

	if (!empty($nombre)){
		$query = $cnnPDO->prepare('DELETE from usuarios WHERE nombre =:nombre');
		$query->bindParam(':nombre', $nombre);
		
		$query->execute(); 
    echo '<script>window.location.href = "index.php";</script>';
    exit();
	}
	
# Termina Código de ELIMINAR
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Bootstrap Example</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>   
    <style>
      body {
        background-image: url('images/fondoindex.jpg');
        background-size: 100% 100%;
      }
      .card-container {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
      }
      .card {
        width: 300px;
        border: 1px solid #ccc;
        border-radius: 5px;
        padding: 10px;
      }
      .card-image {
        text-align: center;
        margin-bottom: 10px;
      }
      .card-image img {
        width: 100px;
        height: 100px;
        object-fit: contain;
      }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="images//AJEO-logos_transparent.png" alt="Logo" class="logo" height="60 px" width="180 px" >
            </a>
            <form class="d-flex ms-auto">
                <input class="form-control me-2" type="search" placeholder="Buscar" aria-label="Search">
                <button class="btn btn-outline-success flex-grow-0" type="submit">
                    <i class="bi bi-search"></i>
                </button>
            </form>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">
                            <img src="images/Regresar.png" alt="Logo" height="30" width="30">
                            Regresar
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

<!-- Section Para publicar Imagenes -->
<section>
  <div class="container" style="width:80%;margin-top:90px;">
  <?php
    $sql = $cnnPDO->prepare("SELECT * FROM usuarios");

    $sql->execute();
    ?>

    <div class="card-container">
      <?php
      while ($campo = $sql->fetch(PDO::FETCH_ASSOC)) {
      ?>
        <div class="card">
          <div class="card-image">
          <p class="card-text"> <?php echo'<img class="rounded-circle" src="data:image/png;base64,' . base64_encode($campo['imagen']) . '" width="250px" height="250px"/>'; ?></p>
          </div>
          <div class="card-body">
            <p class="card-text"><b>Nombre:</b> <?php echo $campo['nombre']; ?></p>
            <p class="card-text"><b>Nombre Usuario:</b> <?php echo $campo['username']; ?></p>
            <p class="card-text"><b>Email:</b> <?php echo $campo['email']; ?></p>
            <p class="card-text"><b>Password:</b> <?php echo $campo['pasword']; ?></p>
          </div>
        </div>
      <?php
      }
      ?>
    </div>
  </div>
</section>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>  

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