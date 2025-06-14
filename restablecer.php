<?php
session_start();
require_once 'db_ajeo.php'; // conexión a BD

$mensaje_error = "";
$mensaje_exito = "";

if (!isset($_GET['token'])) {
    die("Acceso inválido.");
}

$token = $_GET['token'];

// Verificar si el token existe en la base de datos
$query = $cnnPDO->prepare("SELECT * FROM usuarios WHERE token = :token");
$query->bindParam(':token', $token);
$query->execute();

if ($query->rowCount() == 0) {
    die("Token inválido o expirado.");
}

$user = $query->fetch();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pass1 = $_POST['password'];
    $pass2 = $_POST['password_confirm'];

    if (empty($pass1) || empty($pass2)) {
        $mensaje_error = "Ambos campos son obligatorios.";
    } elseif ($pass1 !== $pass2) {
        $mensaje_error = "Las contraseñas no coinciden.";
    } elseif (strlen($pass1) < 6) {
        $mensaje_error = "La contraseña debe tener al menos 6 caracteres.";
    } else {
        // Guardar la contraseña tal cual (sin hash)
        $nueva_password = $pass1;

        // Actualizar contraseña y eliminar token
        $update = $cnnPDO->prepare("UPDATE usuarios SET pasword = :pasword, token = NULL WHERE id = :id");

        $update->bindParam(':pasword', $nueva_password);
        $update->bindParam(':id', $user['id']);
        if ($update->execute()) {
            $mensaje_exito = "Contraseña actualizada correctamente. Ya puedes iniciar sesión.";
        } else {
            $mensaje_error = "Error al actualizar la contraseña. Intenta de nuevo.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Restablecer Contraseña</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body style="background:#f4f4f4;">
    <div class="container mt-5">
        <div class="card mx-auto" style="max-width: 400px;">
            <div class="card-body">
                <h4 class="card-title text-center mb-4">Restablecer Contraseña</h4>

                <?php if ($mensaje_exito): ?>
                    <div class="alert alert-success"><?= $mensaje_exito ?></div>
                    <div class="text-center mt-3">
                        <a href="inicio_sesion.php" class="btn btn-primary">Ir a Iniciar Sesión</a>
                    </div>
                <?php else: ?>
                    <?php if ($mensaje_error): ?>
                        <div class="alert alert-danger"><?= $mensaje_error ?></div>
                    <?php endif; ?>

                    <form method="POST">
                        <div class="mb-3">
                            <label for="password" class="form-label">Nueva contraseña</label>
                            <input type="password" class="form-control" name="password" required minlength="6" />
                        </div>
                        <div class="mb-3">
                            <label for="password_confirm" class="form-label">Confirmar nueva contraseña</label>
                            <input type="password" class="form-control" name="password_confirm" required minlength="6" />
                        </div>
                        <button type="submit" class="btn btn-danger w-100">Actualizar contraseña</button>
                    </form>
                <?php endif; ?>

            </div>
        </div>
    </div>
</body>
</html>
