<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ayuda / Soporte</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script> <!-- Para íconos si los necesitas -->
    <style>
        /* ======= Estilos Generales ======= */
        body {
            margin: 0;
            padding: 0;
            background-image: url('images/fondoindex.jpg'); /* Reemplaza con tu imagen de fondo */
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            font-family: cursive;
            font-style: italic;
            color: white;
        }

        /* ======= Navbar ======= */
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

        /* ======= Contenedor Principal ======= */
        .help-container {
            background-color: rgba(0, 0, 0, 0.6);
            padding: 40px;
            margin: 80px auto 40px auto; /* deja espacio para el navbar arriba */
            border-radius: 15px;
            width: 90%;
            max-width: 800px;
            box-shadow: 0 0 20px rgba(255, 255, 255, 0.1);
        }
        .help-container h2 {
            text-align: center;
            margin-bottom: 30px;
        }

        /* ======= FAQ (Acordeón) ======= */
        .accordion .card {
            background-color: #111;
            border: 1px solid #333;
        }
        .accordion .card-header {
            background-color: #222;
            border-bottom: 1px solid #333;
        }
        .accordion .btn-link {
            color: #ddd;
            font-style: italic;
            text-decoration: none;
        }
        .accordion .btn-link:hover {
            text-decoration: none;
            color: #fff;
        }
        .accordion .collapse {
            background-color: #222;
        }
        .accordion .collapse .card-body {
            color: #f0f0f0;
            font-style: italic;
        }

        /* ======= Formulario de Contacto ======= */
        .contact-form .form-control {
            background: linear-gradient(135deg, #8b0000, #ff4d4d);
            border: none;
            color: white;
            font-style: italic;
        }
        .contact-form .form-control::placeholder {
            color: #f2f2f2;
            font-style: italic;
        }
        .contact-form .btn-enviar {
            background: #e91e63;
            color: white;
            border: none;
            font-style: italic;
        }
        .contact-form .btn-enviar:hover {
            background: #d81b60;
        }

        /* ======= Pie de Página ======= */
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

        /* ======= Alertas en la esquina superior izquierda ======= */
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
        .alert-azul {
            background: linear-gradient(135deg, #003366, #3399ff);
            color: white;
            border: none;
        }
    </style>
</head>
<body>

    <!-- Navbar igual a las otras páginas -->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="images/logo.jpg" alt="Logo"> <!-- Reemplaza con tu logo -->
            </a>
            <div class="ml-auto">
                <a href="index.php" class="btn btn-volver">← Regresar</a>
            </div>
        </div>
    </nav>

    <!-- Contenedor Principal de Ayuda -->
    <div class="help-container">
        <!-- Título e Introducción -->
        <h2>Centro de Ayuda</h2>
        <p>
            Bienvenido a nuestra sección de Ayuda. Aquí encontrarás respuestas a las preguntas más frecuentes y un formulario para contactarnos si necesitas soporte adicional.
        </p>

        <!-- ======= Acordeón de Preguntas Frecuentes ======= -->
        <div id="faqAccordion" class="accordion mb-5">

            <!-- Pregunta 1 -->
            <div class="card">
                <div class="card-header" id="headingOne">
                    <h5 class="mb-0">
                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            ✦ ¿Cómo hago una reserva?
                        </button>
                    </h5>
                </div>
                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#faqAccordion">
                    <div class="card-body">
                        Para realizar una reserva, dirígete a la sección de “Reservas” en el menú principal, llena todos los campos requeridos (nombre, correo, teléfono, área, hora, número de personas y mensaje) y pulsa el botón “Reservar”. Si todo sale bien, verás una alerta que confirma tu reserva.
                    </div>
                </div>
            </div>

            <!-- Pregunta 2 -->
            <div class="card">
                <div class="card-header" id="headingTwo">
                    <h5 class="mb-0">
                        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            ✦ ¿Cuál es la política de cancelación?
                        </button>
                    </h5>
                </div>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#faqAccordion">
                    <div class="card-body">
                        Puedes cancelar tu reserva sin cargo hasta 12 horas antes de la hora pactada. Si cancelas después de ese tiempo o no te presentas, se cobra un 50% del costo total de la reserva. Para cancelar, envíanos un correo a <a href="mailto:contacto@blackrouse.mx">alejandroarenas120404@gmail.com</a> o utiliza el formulario al final de esta página.
                    </div>
                </div>
            </div>

            <!-- Pregunta 3 -->
            <div class="card">
                <div class="card-header" id="headingThree">
                    <h5 class="mb-0">
                        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            ✦ ¿Puedo modificar mi reserva después de haberla hecho?
                        </button>
                    </h5>
                </div>
                <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#faqAccordion">
                    <div class="card-body">
                        Sí, puedes cambiar la hora o el número de personas hasta 6 horas antes de la reserva (sujeto a disponibilidad). Para modificarla, envía un correo a <a href="mailto:contacto@blackrouse.mx">contacto@blackrouse.mx</a> indicando tu nombre completo y los detalles a modificar.
                    </div>
                </div>
            </div>

            <!-- Aquí puedes añadir más preguntas siguiendo el mismo patrón -->
        </div>

        <!-- ======= Formulario de Contacto Rápido ======= -->
        <h3>¿No encontraste respuesta? Contáctanos</h3>
        <form class="contact-form mt-3" method="POST" action="ayuda_contacto.php">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="nombreContacto">Nombre</label>
                    <input type="text" class="form-control" id="nombreContacto" name="nombreContacto" placeholder="Tu nombre" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="emailContacto">Correo Electrónico</label>
                    <input type="email" class="form-control" id="emailContacto" name="emailContacto" placeholder="tu@correo.com" required>
                </div>
            </div>
            <div class="form-group">
                <label for="asuntoContacto">Asunto</label>
                <input type="text" class="form-control" id="asuntoContacto" name="asuntoContacto" placeholder="¿Sobre qué quieres preguntar?" required>
            </div>
            <div class="form-group">
                <label for="mensajeContacto">Mensaje</label>
                <textarea class="form-control" id="mensajeContacto" name="mensajeContacto" rows="4" placeholder="Escribe tu mensaje aquí..." required></textarea>
            </div>
            <button type="submit" class="btn btn-enviar">Enviar Mensaje</button>
        </form>

        <!-- ======= Enlaces Adicionales ======= -->
        <div class="mt-5">
            <p>También puedes:</p>
            <ul>
                <li>
                    <a href="images/guia de usuario.jpg" download class="text-reset">
                        Descargar nuestra imagen de muestra
                    </a>
                </li>
                <li>
                    <a href="#" class="text-reset" onclick="showChatAlert(); return false;">
                        Chatear en vivo (próximamente)
                    </a>
                </li>
                <li>
                    <a href="mailto:soporte@blackrouse.mx" class="text-reset">
                        Enviar un correo directo a soporte@blackrouse.mx
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <!-- Pie de Página -->
    <footer class="text-center text-lg-start">
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

    <!-- Scripts de Bootstrap (para el acordeón) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Script para mostrar alerta al hacer clic en "Chatear en vivo" -->
    <script>
        function showChatAlert() {
            const alertDiv = document.createElement('div');
            alertDiv.className = 'alert alert-azul';
            alertDiv.textContent = 'Trabajamos para activar este servicio próximamente';
            document.body.appendChild(alertDiv);
            setTimeout(() => {
                alertDiv.remove();
            }, 3000);
        }
    </script>
</body>
</html>
