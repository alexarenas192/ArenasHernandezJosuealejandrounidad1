<?php
session_start();
require_once 'db_ajeo.php'; // Conexión a la base de datos

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
require 'PHPMailer/Exception.php';

$mensaje_error = "";
$mensaje_exito = "";

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['email'])) {
    $email = $_POST['email'];

    // Buscar al usuario por correo
    $query = $cnnPDO->prepare("SELECT * FROM usuarios WHERE email = :email");
    $query->bindParam(':email', $email);
    $query->execute();

    if ($query->rowCount() > 0) {
        $user = $query->fetch();

        // Generar token único
        $token = bin2hex(random_bytes(20));

        // Guardar token en la base de datos
        $update = $cnnPDO->prepare("UPDATE usuarios SET token = :token WHERE email = :email");
        $update->bindParam(':token', $token);
        $update->bindParam(':email', $email);
        $update->execute();

        // Crear enlace
        $link = "http://localhost/ajeo/restablecer.php?token=$token";

        // Enviar correo
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'alejandroarenas120404@gmail.com';
            $mail->Password   = 'hufcwfntlvmaedpm'; // Tu contraseña de aplicación de Gmail
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;

            $mail->setFrom('alejandroarenas120404@gmail.com', 'BLACKROUSES');
            $mail->addAddress($email);

            $mail->isHTML(true);
            $mail->Subject = 'Recuperación de contraseña - BLACKROUSES';
            $mail->Body    = "
            <html>
            <body style='background-color:#111; color:white; font-family:Arial, sans-serif;'>
                <div style='background:#000; padding:30px; border:1px solid #e91e63; border-radius:15px; max-width:600px; margin:auto;'>
                    <h2 style='color:#e91e63; text-align:center;'>Recuperación de contraseña</h2>
                    <p>Hola <strong>{$user['nombre']}</strong>,</p>
                    <p>Recibimos una solicitud para restablecer tu contraseña. Haz clic en el siguiente botón:</p>
                    <p style='text-align:center; margin:20px 0;'>
                        <a href='$link' style='background:#e91e63; color:white; padding:10px 20px; border-radius:5px; text-decoration:none;'>Restablecer Contraseña</a>
                    </p>
                    <p>Si no solicitaste esto, puedes ignorar este mensaje.</p>
                    <p style='text-align:center;'>BLACKROUSES - Monterrey, NL</p>
                </div>
            </body>
            </html>";

            $mail->send();
            $mensaje_exito = "Se ha enviado un enlace de recuperación a <strong>$email</strong>.";
        } catch (Exception $e) {
            $mensaje_error = 'No se pudo enviar el correo: ' . $mail->ErrorInfo;
        }
    } else {
        $mensaje_error = "No se encontró un usuario con ese correo.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Recuperar Contraseña</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body style="background:#f4f4f4;">
    <div class="container mt-5">
        <div class="card mx-auto" style="max-width: 400px;">
            <div class="card-body">
                <h4 class="card-title text-center mb-4">Recuperar Contraseña</h4>
                <?php if ($mensaje_exito): ?>
                    <div class="alert alert-success"><?= $mensaje_exito ?></div>
                <?php elseif ($mensaje_error): ?>
                    <div class="alert alert-danger"><?= $mensaje_error ?></div>
                <?php endif; ?>
                <form method="POST">
                    <div class="mb-3">
                        <label for="email" class="form-label">Ingresa tu correo</label>
                        <input type="email" class="form-control" name="email" required>
                    </div>
                    <button type="submit" class="btn btn-danger w-100">Enviar enlace</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
