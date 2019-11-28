<?php
if(!isset($_POST["total"])) exit;


session_start();


$total = $_POST["total"]; // Total de la venta
include_once "conexion.php"; // Conexión a la base de datos
$mysql = new connection();
$conexion = $mysql->get_connection();

$ahora = date("Y-m-d H:i:s"); // Fecha del servidor

$sentencia = $conexion->prepare("CALL insertar_fecha_total(?,?)"); // Prepara la query, en este caso se inserta en la relación, la fecha y el total
$sentencia->execute([$ahora, $total]); // Ejecuta la query con los parametros ($ahora (fecha), y $total)

$sentencia = $conexion->prepare("CALL seleccionar_ventas_por_id"); // Prepara la Query, que selecciona ID de Ventas, ordenandolo descendentemente por ID
$sentencia->execute(); // Ejecuta la query
$resultado = $sentencia->fetch(PDO::FETCH_OBJ); // Devuelve las columnas

$idVenta = $resultado === false ? 1 : $resultado->id;

$base_de_datos->beginTransaction();
$sentencia = $conexion->prepare("CALL insertar_productos_vendidos(?,?,?)");
$sentenciaExistencia = $conexion->prepare("CALL actualizar_stock(?,?)");
foreach ($_SESSION["carrito"] as $producto) {
        $total += $producto->total;
        $sentencia->execute([$producto->id, $idVenta, $producto->cantidad]);
        $sentenciaExistencia->execute([$producto->cantidad, $producto->id]);
}
$base_de_datos->commit();
unset($_SESSION["carrito"]);
$_SESSION["carrito"] = [];
header("Location: ./vender.php?status=1");
?>