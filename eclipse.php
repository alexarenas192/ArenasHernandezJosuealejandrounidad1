<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Eclipse Rosa - Cóctel</title>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300;500;700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

	<style>
		* {
			margin: 0;
			padding: 0;
			box-sizing: border-box;
		}

		body {
			font-family: 'Ubuntu', sans-serif;
			background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('images/fondoindex2.jpg') no-repeat center center fixed;
			background-size: cover;
			color: #fff;
			max-width: 1200px;
			margin: 0 auto;
		}

		header {
			display: flex;
			justify-content: space-between;
			align-items: center;
			padding: 20px 30px;
			background-color: rgba(0, 0, 0, 0.6);
		}

		header img {
			height: 50px;
		}

		.btn-regresar {
			background: none;
			border: 2px solid #fff;
			color: #fff;
			padding: 8px 16px;
			cursor: pointer;
			font-size: 14px;
			text-decoration: none;
			border-radius: 5px;
		}

		.btn-regresar:hover {
			background-color: #ff66b2;
			color: #000;
		}

		.container-title {
			padding: 30px;
			background-color: rgba(255, 255, 255, 0.1);
			margin-bottom: 40px;
			text-align: center;
			font-size: 28px;
			font-weight: 700;
			letter-spacing: 2px;
		}

		main {
			display: flex;
			gap: 30px;
			margin-bottom: 60px;
			padding: 0 30px;
		}

		.container-img img {
			width: 100%;
			height: auto;
			max-height: 600px;
			object-fit: cover;
			border-radius: 10px;
			box-shadow: 0 0 15px rgba(255, 255, 255, 0.2);
		}

		.container-info-product {
			flex: 1;
			display: flex;
			flex-direction: column;
			gap: 20px;
		}

		.container-price span {
			font-size: 28px;
			font-weight: 700;
			color: #ff66b2;
		}

		.section {
			margin-top: 20px;
		}

		.section h4 {
			font-size: 18px;
			color: #ff66b2;
			margin-bottom: 10px;
		}

		.section p, .section ul {
			font-size: 15px;
			line-height: 1.6;
		}

		.section ul {
			list-style: disc;
			padding-left: 20px;
		}

		.container-related-products {
			padding: 30px;
			background-color: rgba(255, 255, 255, 0.1);
			border-top: 1px solid #444;
		}

		.container-related-products h2 {
			text-align: center;
			color: #fff;
			margin-bottom: 30px;
		}

		.card-list-products {
			display: grid;
			grid-template-columns: repeat(4, 1fr);
			gap: 25px;
		}

		.card-img img {
			width: 100%;
			height: 300px;
			object-fit: cover;
			border-radius: 8px;
			box-shadow: 0 0 10px rgba(255, 255, 255, 0.1);
		}

		.text-product h3 {
			font-size: 14px;
			font-weight: 500;
			color: #fff;
		}

		.text-product p {
			font-size: 12px;
			color: #aaa;
		}

		.price {
			color: #ff66b2;
			font-size: 16px;
			font-weight: bold;
		}

		/* FOOTER */
		footer {
			background-color: rgba(0, 0, 0, 0.6);
			color: #f5f5f5;
			padding: 40px 30px 20px;
			margin-top: 40px;
			font-size: 14px;
		}

		footer h6 {
			color: #ff66b2;
			font-weight: 700;
			margin-bottom: 15px;
		}

		footer p {
			color: #ccc;
			margin-bottom: 10px;
		}

		footer a {
			color: #e63946;
			text-decoration: none;
		}

		footer a:hover {
			color: #ff66b2;
		}

		footer .row {
			display: flex;
			flex-wrap: wrap;
			gap: 30px;
		}

		footer .col {
			flex: 1 1 200px;
		}

		footer .social-icons i {
			margin-right: 15px;
			color: #ccc;
			transition: color 0.3s ease;
		}

		footer .social-icons i:hover {
			color: #ff66b2;
		}

		footer .copyright {
			text-align: center;
			margin-top: 30px;
			font-size: 13px;
			color: #999;
		}
	</style>
</head>

<body>

<header>
	<img src="images/logo.jpg" alt="Logo">
	<a href="index.php" class="btn-regresar">Regresar</a>
</header>

<div class="container-title">Eclipse Rosa</div>

<main>
	<div class="container-img">
		<img src="images/coctel3.jpg" alt="Imagen Cóctel Eclipse Rosa">
	</div>

	<div class="container-info-product">
		<div class="container-price"></div>

		<div class="section">
			<h4>Ingredientes</h4>
			<ul>
				<li>1.5 oz de vodka de frambuesa</li>
				<li>1 oz de licor de flor de saúco</li>
				<li>1 oz de jugo de toronja rosada</li>
				<li>1/2 oz de jarabe simple</li>
				<li>Hielo</li>
				<li>Pétalos comestibles o rodaja de toronja para decorar</li>
			</ul>
		</div>

		<div class="section">
			<h4>Preparación</h4>
			<p>
				En una coctelera con hielo, combina el vodka, licor de flor de saúco, jugo de toronja y jarabe simple. Agita vigorosamente por 15 segundos y cuela en una copa fría. Decora con pétalos comestibles o una rodaja de toronja en el borde.
			</p>
		</div>

		<div class="section">
			<h4>Historia del Cóctel</h4>
			<p>
				Eclipse Rosa nace de la fusión entre lo etéreo y lo vibrante. Su tono rosado evoca el cielo justo antes de un eclipse lunar, mientras que su sabor delicado y floral despierta los sentidos con una frescura moderna. Es el cóctel ideal para quienes buscan un toque romántico y sofisticado en su copa.
			</p>
		</div>
	</div>
</main>

<section class="container-related-products">
	<h2>Estrellas Afines</h2>
	<div class="card-list-products">
		<div class="card">
			<div class="card-img">
				<img src="images/ecli1.jpg" alt="Producto 1" />
			</div>
			<div class="info-card">
				<div class="text-product">
					<h3>Luz de Venus</h3>
					<p>Floral, celestial</p>
				</div>
			</div>
		</div>
		<div class="card">
			<div class="card-img">
				<img src="images/ecli2.jpg" alt="Producto 2" />
			</div>
			<div class="info-card">
				<div class="text-product">
					<h3>Bruma Rosada</h3>
					<p>Ligero, refrescante</p>
				</div>
			</div>
		</div>
		<div class="card">
			<div class="card-img">
				<img src="images/ecli3.jpg" alt="Producto 3" />
			</div>
			<div class="info-card">
				<div class="text-product">
					<h3>Aurora Boreal</h3>
					<p>Dulce, místico</p>
				</div>
			</div>
		</div>
		<div class="card">
			<div class="card-img">
				<img src="images/ecli4.jpg" alt="Producto 4" />
			</div>
			<div class="info-card">
				<div class="text-product">
					<h3>Flor del Alba</h3>
					<p>Suave, aromático</p>
				</div>
			</div>
		</div>
	</div>
</section>

<footer>
	<div class="row">
		<div class="col">
			<h6>Black Rouse</h6>
			<p>La elegancia en cada sorbo. Ven a descubrir nuestra coctelería de autor y vive una experiencia única.</p>
		</div>
		<div class="col">
			<h6>Productos</h6>
			<p><a href="#">Cócteles</a></p>
			<p><a href="#">Bebidas Premium</a></p>
			<p><a href="#">Experiencias</a></p>
			<p><a href="#">Accesorios</a></p>
		</div>
		<div class="col">
			<h6>Enlaces útiles</h6>
			<p><a href="#">Menú</a></p>
			<p><a href="#">Reservaciones</a></p>
			<p><a href="#">Eventos</a></p>
			<p><a href="#">Ayuda</a></p>
		</div>
		<div class="col">
			<h6>Contacto</h6>
			<p>Monterrey, NL, México</p>
			<p>contacto@blackrouse.mx</p>
			<p>+52 81 1234 5678</p>
			<p>+52 81 8765 4321</p>
		</div>
	</div>
	<div class="social-icons" style="margin-top: 20px; text-align:center;">
		<a href="#"><i class="fab fa-facebook-f"></i></a>
		<a href="#"><i class="fab fa-twitter"></i></a>
		<a href="#"><i class="fab fa-instagram"></i></a>
		<a href="#"><i class="fab fa-linkedin"></i></a>
	</div>
	<div class="copyright">
		© 2025 Black Rouse. Todos los derechos reservados.
	</div>
</footer>

</body>
</html>
