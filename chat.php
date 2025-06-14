<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>BlackRouses - Asistente Virtual</title>
  <style>
    * {
      box-sizing: border-box;
    }

    body {
      margin: 0;
      padding: 0;
      font-family: Arial, sans-serif;
      background-image: url('images/fondoindex2.jpg'); /* Cambia por tu imagen de fondo */
      background-size: cover;
      background-position: center;
      background-attachment: fixed;
      color: white;
    }

    /* NAVBAR */
    nav {
      background-color: rgba(0, 0, 0, 0.7);
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 10px 20px;
      position: sticky;
      top: 0;
      z-index: 999;
    }

    nav img {
      height: 40px;
    }

    .btn-regresar {
      background: red;
      color: white;
      border: none;
      padding: 8px 12px;
      border-radius: 8px;
      cursor: pointer;
      font-weight: bold;
    }

    /* CHAT */
    .chat-container {
      background: rgba(0, 0, 0, 0.85);
      border-radius: 15px;
      width: 90%;
      max-width: 400px;
      padding: 20px;
      margin: 80px auto 30px auto;
      box-shadow: 0 0 10px red;
    }

    .chat-box {
      height: 300px;
      overflow-y: auto;
      border: 1px solid red;
      border-radius: 10px;
      padding: 10px;
      background-color: #222;
    }

    .bot-message, .user-message {
      margin: 10px 0;
      padding: 10px;
      border-radius: 10px;
      max-width: 80%;
    }

    .bot-message {
      background: #ff4d4d;
      text-align: left;
    }

    .user-message {
      background: #444;
      text-align: right;
      margin-left: auto;
    }

    form {
      display: flex;
      margin-top: 10px;
    }

    input[type="text"] {
      flex: 1;
      padding: 10px;
      border-radius: 10px 0 0 10px;
      border: none;
      outline: none;
    }

    button {
      padding: 10px;
      background: red;
      color: white;
      border: none;
      border-radius: 0 10px 10px 0;
      cursor: pointer;
    }
  </style>
</head>
<body>

  <!-- NAVBAR -->
  <nav>
    <img src="images/logo.jpg" alt="Logo BlackRouses"> <!-- Cambia 'logo.png' por tu logo real -->
    <button class="btn-regresar" onclick="window.history.back()">Regresar</button>
  </nav>

  <!-- CHAT -->
  <div class="chat-container">
    <div class="chat-box" id="chat-box">
      <div class="bot-message">Hola 👋, soy el asistente virtual de <strong>BlackRouses</strong>. Pregúntame lo que quieras 🕺.</div>
    </div>
    <form id="chat-form">
      <input type="text" id="user-input" placeholder="Escribe tu pregunta aquí..." required>
      <button type="submit">Enviar</button>
    </form>
  </div>

  <!-- JS CHAT -->
  <script>
    const chatForm = document.getElementById("chat-form");
    const chatBox = document.getElementById("chat-box");
    const userInput = document.getElementById("user-input");

    const respuestas = {
      "horario": "Abrimos de jueves a sábado de 8:00 PM a 3:00 AM.",
      "ubicación": "Nos encontramos en el centro de Ramos Arizpe, Coahuila. Búscanos como 'BlackRouses Club'.",
      "costo": "La entrada general cuesta $150 por persona. Puede variar en eventos especiales.",
      "cover": "El cover es de $150. Consulta nuestras redes para promociones.",
      "reservación": "Puedes reservar por WhatsApp o Instagram. ¡Recomendado para fines de semana!",
      "reservaciones": "Sí, aceptamos reservaciones. Escríbenos por Instagram o WhatsApp.",
      "contacto": "Llámanos o manda WhatsApp al 844-123-4567. También estamos en @blackrouses_club.",
      "instagram": "Síguenos en Instagram: @blackrouses_club",
      "facebook": "En Facebook estamos como 'BlackRouses Club'.",
      "menú": "Tenemos snacks, alitas, hamburguesas, papas, y más.",
      "bebidas": "Ofrecemos cervezas, tragos, shots y mixología especial.",
      "mixología": "Contamos con mojitos, margaritas, martinis, gin tonics, daiquiris y tragos exclusivos 🍹.",
      "precios": "Cervezas desde $50, tragos desde $80, combos desde $300.",
      "tarjetas": "Aceptamos tarjetas de crédito, débito, y pagos en efectivo.",
      "efectivo": "Sí, aceptamos efectivo y tarjetas.",
      "edad": "Solo mayores de 18 años con INE. Es obligatorio.",
      "dni": "Debes presentar identificación oficial para entrar.",
      "baños": "Sí, tenemos baños disponibles para hombres y mujeres.",
      "estacionamiento": "Contamos con estacionamiento privado y seguro.",
      "dj": "Cada fin tenemos DJ en vivo con reguetón, electrónica y más.",
      "música": "Reguetón, electrónica, pop, hits del momento y noches temáticas 🎶.",
      "dress code": "Casual elegante. No se permite pants ni sandalias.",
      "ropa": "Vístete con estilo. No se permite ropa deportiva.",
      "ambiente": "Ambiente seguro y divertido para bailar, tomar y pasarla bien 🥳.",
      "eventos": "Tenemos noches de temática especial, fiestas de color, DJ invitados y más.",
      "fumar": "Hay terraza para fumadores. No se puede fumar adentro.",
      "área de fumar": "Sí, tenemos área especial para fumadores.",
      "mesas": "Puedes reservar mesa con paquetes especiales. Contáctanos para info.",
      "botellas": "Paquetes de botellas nacionales y premium. Pregunta en barra o por mensaje.",
      "cumpleaños": "¡Celebra tu cumple con nosotros! Tenemos sorpresas y atención especial 🎉.",
      "wifi": "No tenemos WiFi público, pero hay buena señal celular.",
      "promociones": "Promos cada semana. Revisa nuestras redes sociales.",
      "objetos perdidos": "Contáctanos lo antes posible si olvidaste algo.",
      "seguridad": "Contamos con seguridad privada dentro y fuera del club.",
      "clima": "Lugar cerrado con clima agradable.",
      "sillas": "Tenemos zonas para sentarse, aunque el lugar es para bailar.",
      "zona vip": "Zona VIP con servicio personalizado y exclusividad.",
      "pagos": "Puedes pagar con efectivo, tarjeta o transferencia.",
      "qr": "Sí, también puedes pagar por QR. Pregunta en barra.",
      "tarjeta": "Sí, aceptamos VISA, MasterCard y AMEX."
    };

    chatForm.addEventListener("submit", (e) => {
      e.preventDefault();
      const mensaje = userInput.value.toLowerCase().trim();
      if (!mensaje) return;

      agregarMensaje("user", mensaje);
      userInput.value = "";

      let respuesta = "Lo siento, no entendí tu pregunta. ¿Puedes escribirlo de otra forma?";
      for (let clave in respuestas) {
        if (mensaje.includes(clave)) {
          respuesta = respuestas[clave];
          break;
        }
      }

      setTimeout(() => {
        agregarMensaje("bot", respuesta);
      }, 600);
    });

    function agregarMensaje(tipo, texto) {
      const div = document.createElement("div");
      div.className = tipo + "-message";
      div.textContent = texto;
      chatBox.appendChild(div);
      chatBox.scrollTop = chatBox.scrollHeight;
    }
  </script>

</body>
</html>
