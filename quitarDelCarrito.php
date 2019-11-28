<?php
if(!isset($_GET["indice"])) return;
$indice = $_GET["indice"];

session_start();
array_splice($_SESSION["carrito"], $indice, 1); // Se elimina el elemento que perteneza al índice que recibimos a través de get.
header("Location: ./vender.php?status=3");
?>