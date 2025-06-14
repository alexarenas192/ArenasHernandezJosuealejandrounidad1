<?php
session_start();
require_once 'db_ajeo.php';

if (isset($_POST['buscar'])) {
    $recaptchaSecret = '6Lcgi1wrAAAAABBVTgQyW6lx0m56ZbIGy6pUwUVn';
    $recaptchaResponse = $_POST['g-recaptcha-response'];

    $verify = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$recaptchaSecret}&response={$recaptchaResponse}");
    $captchaSuccess = json_decode($verify);

    if ($captchaSuccess->success) {
        $username = $_POST['username'];

        $query = $cnnPDO->prepare('SELECT * FROM usuarios WHERE username = :username');
        $query->bindParam(':username', $username);
        $query->execute();

        $count = $query->rowCount();
        $campo = $query->fetch();

        if ($count && $_POST['pasword'] == $campo['pasword']) {
            $_SESSION['email'] = $campo['email'];
            $_SESSION['pasword'] = $campo['pasword'];
            $_SESSION['username'] = $campo['username'];
            $_SESSION['nombre'] = $campo['nombre'];

            echo '<script>window.location.href = "index.php";</script>';
            exit();
        } else {
            echo "<strong><font color='red'>El Usuario o la Contraseña son Incorrectos</font></strong>";
        }
    } else {
        echo "<strong><font color='red'>Verificación reCAPTCHA fallida. Intenta de nuevo.</font></strong>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Iniciar Sesión</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
  <style>
    body {
      background-image: url('images/fondoindex2.jpg');
      background-size: cover;
      background-position: center;
      color: #fff;
      font-family: Arial, sans-serif;
      min-height: 100vh;
      margin: 0;
      display: flex;
      flex-direction: column;
    }
    nav.navbar {
      background-color: #000;
      box-shadow: 0 2px 8px rgba(0,0,0,0.8);
      padding: 0.5rem 1rem;
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
    .login-container {
      background-color: rgba(0,0,0,0.6);
      padding: 2rem;
      border-radius: 8px;
      max-width: 400px;
      margin: auto;
      box-shadow: 0 0 20px rgba(0,0,0,0.7);
    }
    .login-container h2 {
      text-align: center;
      margin-bottom: 1.5rem;
      color: #ff0047;
      font-weight: bold;
    }
    .form-label {
      color: #ddd;
      font-weight: 600;
    }
    .form-input {
      background-color: #222;
      border: 1px solid #444;
      color: #fff;
      border-radius: 4px;
      padding: 10px;
    }
    .form-button {
      width: 100%;
      padding: 10px;
      background-color: #ff0047;
      border: none;
      border-radius: 4px;
      color: #fff;
      font-size: 16px;
      cursor: pointer;
      transition: background-color .3s;
    }
    .form-button:hover {
      background-color: #cc0038;
    }
    .form-container a {
      display: inline-block;
      width: 100%;
      text-align: center;
      margin-top: 0.5rem;
      background-color: transparent;
      border: 2px solid #ff0047;
      color: #ff0047;
      padding: 8px;
      border-radius: 4px;
      text-decoration: none;
      transition: background-color .3s, color .3s;
    }
    .form-container a:hover {
      background-color: #ff0047;
      color: #fff;
    }
  </style>
</head>
<body>

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

  <div class="login-container">
    <h2>BIENVENIDO</h2>
    <div class="form-container">
      <form action="" method="post" name="Form">
        <label class="form-label" for="username">Username</label>
        <input class="form-input mb-3" type="text" placeholder="Ingresa tu Username" id="username" name="username" required>

        <label class="form-label" for="password">Contraseña</label>
        <input class="form-input mb-3" type="password" placeholder="Ingresa tu Contraseña" id="password" name="pasword" required>

        <div class="g-recaptcha mb-3" data-sitekey="6Lcgi1wrAAAAAE6Ijz3Nf675MiFrcICsGDpcnzES"></div>

        <button class="form-button mb-3" type="submit" name="buscar">INICIAR SESIÓN</button>

        <!-- Enlace de recuperación -->
        <div class="text-center mb-3">
          <a href="recuperar_contrasena.php" style="color: #ff0047;">¿Olvidaste tu contraseña?</a>
        </div>

        <p class="text-center mb-1" style="color:#ccc;">¿No tienes una cuenta?</p>
        <a href="crear_cuenta.php">REGÍSTRATE</a>
      </form>
    </div>
  </div>

  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>

</body>
</html>

<!-- Librerías adicionales -->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/css/mdb.min.css" rel="stylesheet">

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/js/mdb.min.js"></script>
