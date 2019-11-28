<?php
if(!isset($_GET["id"])) exit();
$id = $_GET["id"];
include_once "conexion.php";
$mysql = new connection();
$conexion = $mysql->get_connection();


$statement = $conexion->prepare("CALL eliminar_productos(?)");
$statement->execute([$id]);

if($statement == true)
{
    header("Location: ./listar.php");
    exit;
}else echo "Error";
?>