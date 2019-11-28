<?php
if(!isset($_GET["id"])) exit();
$id = $_GET["id"];
include_once "conexion.php";
$mysql = new connection();
$conexion = $mysql->get_connection();


$statement = $conexion->prepare("CALL eliminar_ventas(?)");
$statement->bind_param("i",$id);
$statement->execute();

if($statement == true)
{
    header("Location: ./ventas.php");
    exit;
}else echo "Error";
?>