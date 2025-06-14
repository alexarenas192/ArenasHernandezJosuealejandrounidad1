<?php
require_once 'db_ajeo.php';

if (isset($_POST["guardar"])) {
    // 1) Recibir datos del formulario
    $nombre   = trim($_POST['nombre']);
    $username = trim($_POST['username']);
    $email    = trim($_POST['email']);
    $password = trim($_POST['pasword']);

    // 2) Procesar subida de imagen (si se cargó)
    $imagen_ruta = null;
    if (
        isset($_FILES["imagen"]) &&
        $_FILES["imagen"]["error"] === UPLOAD_ERR_OK
    ) {
        $carpetaDestino = "uploads/";
        // Si la carpeta no existe, se crea
        if (!file_exists($carpetaDestino)) {
            mkdir($carpetaDestino, 0777, true);
        }

        // Se genera un nombre único para el archivo
        $nombreArchivoOriginal = basename($_FILES["imagen"]["name"]);
        $nombreUnico = uniqid() . "_" . $nombreArchivoOriginal;
        $rutaFinal = $carpetaDestino . $nombreUnico;

        // Se mueve el archivo desde la carpeta temporal a la carpeta destino
        if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $rutaFinal)) {
            $imagen_ruta = $rutaFinal;
        }
        // Si por alguna razón falla move_uploaded_file, $imagen_ruta queda en null
    }

    // 3) Validar campos obligatorios (sin contar imagen)
    if (
        !empty($nombre) &&
        !empty($username) &&
        !empty($email) &&
        !empty($password)
    ) {
        // 4) Insertar en la tabla usuarios
        $sql = $cnnPDO->prepare("
            INSERT INTO usuarios
                (nombre, username, email, pasword, imagen)
            VALUES
                (:nombre, :username, :email, :pasword, :imagen)
        ");

        $sql->bindParam(':nombre', $nombre);
        $sql->bindParam(':username', $username);
        $sql->bindParam(':email', $email);
        $sql->bindParam(':pasword', $password);
        $sql->bindParam(':imagen', $imagen_ruta); // puede ser NULL si no se subió nada

        $sql->execute();
        unset($sql);

        // 5) Redirigir a inicio de sesión
        echo '<script>window.location.href = "inicio_sesion.php";</script>';
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Registrar Usuario | Ajeo</title>

  <!-- Bootstrap CSS v5.3 y FontAwesome -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">

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
    /* Navbar negro + acentos rosas */
    nav.navbar {
      background-color: #000;
      box-shadow: 0 2px 8px rgba(0,0,0,0.8);
      padding: .5rem 1rem;
    }
    nav .navbar-brand img {
      height: 60px;
    }
    nav .btn-outline-light {
      border-color: #ff0047;
      color: #ff0047;
    }
    nav .btn-outline-light:hover {
      background-color: #ff0047;
      color: #fff;
    }
    /* Contenedor del formulario */
    .register-container {
      background-color: rgba(0,0,0,0.6);
      padding: 2rem;
      border-radius: 8px;
      max-width: 450px;
      margin: 2rem auto;
      box-shadow: 0 0 20px rgba(0,0,0,0.7);
    }
    .register-container h2 {
      color: #ff0047;
      text-align: center;
      margin-bottom: 1.5rem;
      font-weight: bold;
    }
    /* Labels e inputs */
    .form-label {
      color: #ddd;
      font-weight: 600;
    }
    .form-control {
      background-color: #222;
      border: 1px solid #444;
      color: #fff;
    }
    .form-control::placeholder {
      color: #aaa;
    }
    /* Custom file */
    .custom-file-label, .custom-file-input {
      background-color: #222;
      border: 1px solid #444;
      color: #fff;
    }
    .custom-file-label::after {
      background-color: #ff0047;
      border-color: #ff0047;
      color: #fff;
    }
    /* Botón registrar */
    .btn-register {
      background-color: #ff0047;
      border: none;
      width: 100%;
      padding: 10px;
      font-size: 16px;
      color: #fff;
      border-radius: 4px;
      transition: background-color .3s;
    }
    .btn-register:hover {
      background-color: #cc0038;
    }
  </style>
</head>
<body>

  <!-- TU PHP / SESSION_START va aquí -->

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">
        <img src="images/logo.jpg" alt="Logo">
      </a>
      <div class="ms-auto">
        <a href="inicio_sesion.php" class="btn btn-outline-light">
          <i class="fas fa-arrow-left"></i> Regresar
        </a>
      </div>
    </div>
  </nav>

  <!-- Formulario de registro -->
  <div class="register-container">
    <h2>unete y haz magia</h2>
    <form name="form1" method="post" action="crear_cuenta.php" enctype="multipart/form-data">
      <!-- Nombre -->
      <div class="mb-3">
        <label class="form-label" for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Ingrese su nombre completo" required>
      </div>
      <!-- Username -->
      <div class="mb-3">
        <label class="form-label" for="username">Username:</label>
        <input type="text" id="username" name="username" class="form-control" placeholder="Ingrese un username" required>
      </div>
      <!-- Email -->
      <div class="mb-3">
        <label class="form-label" for="email">Email:</label>
        <input type="email" id="email" name="email" class="form-control" placeholder="Ingrese su email" required>
      </div>
      <!-- Password -->
      <div class="mb-3">
        <label class="form-label" for="pasword">Password:</label>
        <input type="password" id="pasword" name="pasword" class="form-control" placeholder="Ingrese su contraseña" required>
      </div>
      <!-- Foto de perfil -->
      <div class="mb-4">
        <label class="form-label" for="imagen">Foto de Perfil:</label>
        <div class="custom-file">
          <input type="file" id="imagen" name="imagen" class="custom-file-input" accept="image/*">
          <label class="custom-file-label" for="imagen">Seleccionar archivo</label>
        </div>
      </div>
      <!-- Botón Registrar -->
      <button type="submit" name="guardar" class="btn-register">Registrar</button>
    </form>
  </div>

  <!-- Scripts JS Bootstrap 5 -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

  <!-- Script para mostrar nombre de archivo -->
  <script>
    document.querySelector('#imagen').addEventListener('change', function() {
      let nombre = this.value.split('\\').pop();
      this.nextElementSibling.textContent = nombre;
    });
  </script>
</body>
</html>


