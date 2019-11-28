<?php

// Si alguno de los parametros no está seteado, sale
if(
	!isset($_POST["codigo"]) || 
	!isset($_POST["descripcion"]) || 
	!isset($_POST["precioCompra"]) || 
	!isset($_POST["precioVenta"]) || 
	!isset($_POST["cantidad"]) || 
	!isset($_POST["id"])
) exit();

// Si la condición se cumple (todos los parametros seteados), ejecuta el siguiente código
include_once "conexion.php"; // Llama a la conexión a la base de datos
$mysql = new connection();
$conexion = $mysql->get_connection();

$id = $_POST["id"]; // Busca la id del producto
$codigo = $_POST["codigo"]; // Codigo
$descripcion = $_POST["descripcion"]; // Descripcion
$precioCompra = $_POST["precioCompra"]; // Precio de la compra
$precioVenta = $_POST["precioVenta"]; // Precio de la venta
$existencia = $_POST["cantidad"]; // Cantidad de productos en stock


$statement = $conexion->prepare("CALL editar_productos(?,?,?,?,?,?)");
$statement->bind_param("issiii",$id,$codigo,$descripcion,$precioCompra,$precioVenta,$existencia);
$statement->execute();

if($statement == true)
{
    header("Location: ./listar.php");
    exit;
}else echo "Error";
?>