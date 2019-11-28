<?php include_once "encabezado.php" ?>
<?php
#Salir si alguno de los datos no está presente
if(!isset($_POST["codigo"]) || !isset($_POST["descripcion"]) || !isset($_POST["precioVenta"]) || !isset($_POST["precioCompra"]) || !isset($_POST["cantidad"])) exit();

#Si va bien, se ejecuta esta parte del código...

include_once "conexion.php";
$mysql = new connection();
$conexion = $mysql->get_connection();

$codigo = $_POST["codigo"];
$descripcion = $_POST["descripcion"];
$precioVenta = $_POST["precioVenta"];
$precioCompra = $_POST["precioCompra"];
$existencia = $_POST["cantidad"];

$buscarProducto = $base_de_datos->query("select * from productos");
$CodigoProductos = $buscarProducto->fetchAll(PDO::FETCH_OBJ);

foreach($CodigoProductos as $codigoProducto) {
	if ($codigo != $codigoProducto->codigo) {
		$sentencia = $base_de_datos->prepare("CALL insertar_productos(?,?,?,?,?)");
		$resultado = $sentencia->execute([$codigo, $descripcion, $precioVenta, $precioCompra, $existencia]);
		if ($resultado === TRUE) {
			header("Location: ./listar.php");
			exit;
		}
	}else{
		header("Location: ./formulario.php?error=1");
		exit;
	}
}




?>
<?php include_once "pie.php" ?>