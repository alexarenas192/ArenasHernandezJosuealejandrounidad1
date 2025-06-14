<?php
session_start();
require_once 'db_ajeo.php'; // Asegúrate de que este archivo no cause errores

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
require 'PHPMailer/Exception.php';

$mensaje_error = "";
$mensaje_exito = "";

// Lógica del formulario
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['email'])) {
    $nombre    = $_POST['nombre'];
    $email     = $_POST['email'];
    $telefono  = $_POST['telefono'];
    $area      = $_POST['area'];
    $hora      = $_POST['hora'];
    $personas  = $_POST['personas'];
    $mensaje   = $_POST['mensaje'];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $mensaje_error = "El correo ingresado no es válido.";
    } else {
        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'alejandroarenas120404@gmail.com';
            $mail->Password   = 'hufcwfntlvmaedpm'; // Reemplaza con tu contraseña de aplicación
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;

            $mail->setFrom('alejandroarenas120404@gmail.com', 'BLACKROUSES');
            $mail->addAddress($email);

            $mail->isHTML(true);
            $mail->Subject = 'Reserva hecha con éxito';
            $mail->Body    = '
            <html>
            <body style="background-color:#111; color:white; font-family:cursive;">
                <div style="background:#000; padding:30px; border:1px solid #e91e63; border-radius:15px; max-width:600px; margin:auto;">
                    <h2 style="color:#e91e63; text-align:center;">¡Reserva Confirmada!</h2>
                    <p>Hola <strong>' . htmlspecialchars($nombre) . '</strong>,</p>
                    <p>Gracias por reservar con nosotros. Aquí están los detalles:</p>
                    <ul>
                        <li><strong>Correo:</strong> ' . htmlspecialchars($email) . '</li>
                        <li><strong>Teléfono:</strong> ' . htmlspecialchars($telefono) . '</li>
                        <li><strong>Área:</strong> ' . htmlspecialchars($area) . '</li>
                        <li><strong>Hora:</strong> ' . htmlspecialchars($hora) . '</li>
                        <li><strong>Personas:</strong> ' . htmlspecialchars($personas) . '</li>
                        <li><strong>Mensaje:</strong> ' . htmlspecialchars($mensaje) . '</li>
                    </ul>
                    <p>✨ ¡Te esperamos en <strong>Black Rouse</strong>! ✨</p>
                    <p style="text-align:center;">Que la noche magica comienze🍸 Monterrey, NL</p>
                </div>
            </body>
            </html>';

            $mail->send();
            $mensaje_exito = "Reserva realizada con éxito. Se ha enviado un correo a <strong>$email</strong>.";
        } catch (Exception $e) {
            $mensaje_error = 'La reserva fue registrada, pero no se pudo enviar el correo: ' . $mail->ErrorInfo;
        }
    }
}
?>

<!-- AHORA VA TODO TU HTML NORMAL DESDE AQUÍ -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reservas</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script> <!-- Para íconos -->
    <style>
        body {
            background-image: url('images/fondoindex.jpg'); /* Reemplaza con tu imagen de fondo */
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            color: white;
            font-family: cursive;
            font-style: italic;
        }

        .navbar-custom {
            background-color: rgba(0, 0, 0, 0.8);
        }

        .navbar-brand img {
            height: 40px;
        }

        .btn-volver {
            background-color: #e91e63;
            color: white;
            border: none;
            font-style: italic;
        }

        .btn-volver:hover {
            background-color: #d81b60;
        }

        .form-control:invalid {
            border-color: red;
        }

        .alert-azul {
            background: linear-gradient(to right, #007bff, #66b2ff);
            color: white;
            border: none;
        }

        .card {
            background-color: #111;
            border: 1px solid #333;
        }

        .btn-reservar {
            background: #e91e63;
            color: white;
            border: none;
            font-style: italic;
        }

        .btn-reservar:hover {
            background: #d81b60;
        }

        label {
            color: #ddd;
            font-style: italic;
        }

        /* ---------------------------------------------------
           ALERTAS EN LA ESQUINA SUPERIOR IZQUIERDA
        --------------------------------------------------- */
        .alert {
            position: fixed;
            top: 20px;
            left: 20px;
            z-index: 9999;
            border-radius: 10px;
            padding: 15px 25px;
            font-weight: bold;
            font-style: italic;
            box-shadow: 0 0 15px rgba(0,0,0,0.3);
        }

        .alert-danger {
            background: linear-gradient(135deg, #8b0000, #ff4d4d);
            color: white;
            border: none;
        }

        /* ---------------------------------------------------
           PIE DE PÁGINA
        --------------------------------------------------- */
        footer {
            background-color: rgba(0, 0, 0, 0.5);
            color: #f5f5f5;
            padding-top: 1rem;
            padding-bottom: 1rem;
            font-style: italic;
        }

        footer a {
            color: #e63946;
            font-style: italic;
        }

        footer a:hover {
            color: #ffffff;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark navbar-custom">
    <div class="container">
        <a class="navbar-brand" href="#">
            <img src="images/logo.jpg" alt="Logo"> <!-- Reemplaza con tu logo -->
        </a>
        <div class="ml-auto">
            <a href="index.php" class="btn btn-volver">← Regresar</a>
        </div>
    </div>
</nav>

<!-- Mensajes de alerta -->
<?php if ($mensaje_error): ?>
    <div class="alert alert-danger"><?= $mensaje_error ?></div>
<?php endif; ?>

<?php if ($mensaje_exito): ?>
    <div class="alert alert-azul"><?= $mensaje_exito ?></div>
<?php endif; ?>

<!-- Formulario -->
<div class="container mt-5">
    <h2 class="text-center mb-4">Haz tu reserva</h2>
    <form method="POST" action="reservas.php">
        <div class="card p-4">
            <div class="form-group">
                <label for="nombre">Nombre completo</label>
                <input type="text" class="form-control" name="nombre" id="nombre" required>
            </div>
            <div class="form-group">
                <label for="email">Correo electrónico</label>
                <input type="email" class="form-control" name="email" id="email" required>
            </div>
            <div class="form-group">
                <label for="telefono">Número de teléfono</label>
                <input type="text" class="form-control" name="telefono" id="telefono" required>
            </div>
            <div class="form-group">
                <label for="area">Área deseada</label>
                <select class="form-control" name="area" id="area" required>
                    <option value="">Selecciona un área</option>
                    <option value="Pista de baile">Pista de baile</option>
                    <option value="Área VIP">Área VIP</option>
                    <option value="Área de descanso">Área de descanso</option>
                    <option value="Lounge">Lounge</option>
                </select>
            </div>
            <div class="form-group">
                <label for="hora">Hora de la reserva</label>
                <input type="time" class="form-control" name="hora" id="hora" required>
            </div>
            <div class="form-group">
                <label for="personas">Número de personas</label>
                <input type="number" class="form-control" name="personas" id="personas" min="1" required>
            </div>
            <div class="form-group">
                <label for="mensaje">Detalles / mensaje</label>
                <textarea class="form-control" name="mensaje" id="mensaje" rows="4" required placeholder="Ej. ¿Gustas agregar un adicional para hacer tu noche más mágica con nosotros?"></textarea>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-reservar">Reservar</button>
            </div>
        </div>
    </form>
</div>

<!-- Pie de página -->
<footer class="text-center text-lg-start mt-5">
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

    <section>
        <div class="container text-center text-md-start mt-5">
            <div class="row mt-3">
                <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
                    <h6 class="text-uppercase fw-bold mb-4">Black Rouse</h6>
                    <p>La elegancia en cada sorbo. Ven a descubrir nuestra coctelería de autor y vive una experiencia única.</p>
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

    <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.3);">
        © 2025 Black Rouse. Todos los derechos reservados.
    </div>
</footer>

<!-- JavaScript para ocultar alertas después de 3 segundos -->
<script>
    window.addEventListener('DOMContentLoaded', function() {
        setTimeout(function() {
            document.querySelectorAll('.alert').forEach(function(el) {
                el.style.display = 'none';
            });
        }, 7000);
    });
</script>

</body>
</html>