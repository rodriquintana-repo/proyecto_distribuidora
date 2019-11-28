<?php

session_start();

unset($_SESSION["carrito"]); // Desetea la sesion
$_SESSION["carrito"] = [];

header("Location: ./vender.php?status=2");
?>