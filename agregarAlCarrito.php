<?php
if(!isset($_POST["codigo"])) return; // Pregunta si está seteado el codigo de producto, si no existe, vuelve
$codigo = $_POST["codigo"]; // Entrega el código del producto

include_once "conexion.php"; // Conecta con la base de datos
$sentencia = $base_de_datos->prepare("CALL seleccionar_productos_carrito(?)"); // Prepara la Query
$sentencia->execute([$codigo]); // Ejecuta la query con el parametro del codigo
$producto = $sentencia->fetch(PDO::FETCH_OBJ); // Toma la query y la agrupa como objetos, dandole de nombre $producto

$cantidadelegida = $_POST['cantidad'];
if($producto){
	if($producto->cantidad < $cantidadelegida){ // Si la cantidad de productos es menor a 1, quiere decir que éste producto no se encuentra en stock
		header("Location: ./vender.php?status=5"); // Retorna el status = 5 , es decir, no hay Stock.
		exit;
	}
	session_start();
	$indice = false;
	for ($i=0; $i < count($_SESSION["carrito"]); $i++) { // Se recorre el array carrito, para determinar si ya se había agregado el producto
		if($_SESSION["carrito"][$i]->codigo === $codigo){
			$indice = $i;
			break;
		}
	}
	if($indice === FALSE){
		$producto->cantidad = $cantidadelegida; // Si no existe ese producto en el array "carrito" , éste es agregado, expresando su cantidad en 1
		$producto->total = $producto->precioVenta * $cantidadelegida;
		array_push($_SESSION["carrito"], $producto);
	}else{
		$_SESSION["carrito"][$indice]->cantidad = $_SESSION["carrito"][$indice]->cantidad+$cantidadelegida; // En caso de que se haya agregado antes, sólo se cambia la cantidad
		$_SESSION["carrito"][$indice]->total = $_SESSION["carrito"][$indice]->cantidad * $_SESSION["carrito"][$indice]->precioVenta; // Se calcula el total
		// Precio de venta * cantidad = total.
	}
	if($_SESSION["carrito"][$indice]->cantidad > $producto->cantidad){
		$_SESSION["carrito"][$indice]->cantidad = $_SESSION["carrito"][$indice]->cantidad - $cantidadelegida;
		header("Location: ./vender.php?status=6&&descripcion=".$producto->descripcion."&&cantidadDisponible=".$producto->cantidad);
		exit;
	}
	header("Location: ./vender.php");
}else header("Location: ./vender.php?status=4"); // Después de ejecutar la primera condición, este else indica que el paquete no se encontró,
// es decir, no existe (diferente a que no haya stock).
?>
