<?php
require_once 'db_ajeo.php';
?>

<?php
if(isset($_POST["guardar"]))
{
    $producto = $_POST['producto'];
    $tipo = $_POST['tipo'];
    $costo = $_POST['costo'];
    $descripcion = $_POST['descripcion'];
    $producto_id = $_POST['producto_id'];
    $imagen = $_FILES['imagen']['tmp_name'];

    if(!empty($producto) && !empty($tipo) && !empty($costo) && !empty($descripcion)  && !empty($producto_id) && !empty($imagen))
    {
        $imgData = fopen($imagen, 'rb');

        $sql = $cnnPDO->prepare("INSERT INTO compras (producto, tipo, costo, descripcion, producto_id, imagen) VALUES (:producto, :tipo, :costo, :descripcion, :producto_id, :imagen)");

        $sql->bindParam(':producto', $producto);
        $sql->bindParam(':tipo', $tipo);
        $sql->bindParam(':costo', $costo);
        $sql->bindParam(':descripcion', $descripcion);
        $sql->bindParam(':producto_id', $producto_id);
        $sql->bindParam(':imagen', $imgData, PDO::PARAM_LOB);

        $sql->execute();
        unset($sql);
        
        echo '<script>window.location.href = "index.php";</script>';
        exit(); 
    }
}
?>


<?php
# Código de BUSCAR

$GLOBALS['$producto'] = "";
$GLOBALS['$tipo'] = "";
$GLOBALS['$costo'] = "";
$GLOBALS['$descripcion'] = "";
$GLOBALS['$producto_id'] = "";

if (isset($_POST['buscar'])) {
	
	$email=$_POST['producto'];

	$query = $cnnPDO->prepare('SELECT * from compras WHERE producto =:producto');
	$query->bindParam(':producto', $producto);
	
	$query->execute(); 
	$count=$query->rowCount();
	$campo = $query->fetch();

	if($count)	{	
        
		$GLOBALS['$producto'] = $campo['producto'];
        $GLOBALS['$tipo'] = $campo['tipo'];
		$GLOBALS['$costo'] = $campo['costo'];
        $GLOBALS['$descripcion'] = $campo['descripcion'];
        $GLOBALS['$producto_id'] = $campo['producto_id'];

	} 
	else
		$GLOBALS['$producto'] = "";	

}
# Termina Código de BUSCAR
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/css/mdb.min.css" rel="stylesheet">
    
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
</head>
<body>
<div class="container">
    <h2 style="font-size: 24px; text-align: center;">
    <img src="images//AJEO-logos_transparent.png" alt="Logo" class="logo" height="60 px" width="180 px" >
    </h2>
    <div class="form-container">
    <form name="form1" method="post" enctype="multipart/form-data"> 
                    <div class="card-body">
                        <div class="form-group">
                        
                    <div class="form-group">
                        <label for="nombre">Nombre del Producto:</label>
                        <input type="text" class="form-control" name="producto" placeholder="Ingrese nombre producto"
                            value="<?php echo $GLOBALS['$producto']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="username">Tipo de Producto:</label>
                        <input type="text" class="form-control" name="tipo" placeholder="ingrese tipo producto"
                            value="<?php echo $GLOBALS['$tipo']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="carreras">Costo del Producto:</label>
                        <input type="text" class="form-control" name="costo" placeholder="Ingrese costo producto"
                            value="<?php echo $GLOBALS['$costo']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="carreras">Descripcio del Producto:</label>
                        <input type="text" class="form-control" name="descripcion" placeholder="Ingrese descripcion producto"
                            value="<?php echo $GLOBALS['$descripcion']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="carreras">Id del Producto:</label>
                        <input type="text" class="form-control" name="producto_id" placeholder="Id del Producto"
                            value="<?php echo $GLOBALS['$producto_id']; ?>">
                    </div>
                            <label for="foto">Foto del Producto:</label>
                    <div class="input-group form-outline mb-4">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroupFileAddon01"><i class="fas fa-cloud-upload-alt"></i> </span>
                    </div>
                    <div class="custom-file">
                            <input type="file" accept="image/jpg" name="imagen" class="custom-file-input"  id="image"
                            aria-describedby="inputGroupFileAddon01" lang="es">
                            <label class="custom-file-label" for="image">Foto de Perfil (.jpg)</label>
                        </div>
                        </div>
                        </div>
                            <div class="btn-group d-flex justify-content-center" role="group" aria-label="Botones">
                            <button type="submit" name="guardar" name="registrar" class="btn btn-primary" href="index.php" >Subir Producto</button>
                            <br>
                        </div>
                    </div>
                </form>
    </div>
</div>

<!-- JQuery -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- Bootstrap tooltips -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.min.js"></script>
<!-- MDB core JavaScript -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/js/mdb.min.js"></script>

</body>
</html>
