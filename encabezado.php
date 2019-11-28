<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Distribuidora</title>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <link rel="stylesheet" href="./css/fontawesome-all.min.css">
    <link rel="stylesheet" href="./css/2.css">
    <link rel="stylesheet" href="./css/estilo.css">
    <!--Linkeo con el CDN de bootstrap-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap-theme.min.css">

    <script src="js/jquery.min.js"></script>
    <script src="js/moment.min.js"></script>
    <script src="js/es.js"></script>

    <!--Scripts de bootstrap-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

    <link rel="stylesheet" type="text/css" href="css/estilo2.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

</head>

<body>
<header id="cabecera">
    <div class="container-fluid">
        <div class="row">
            <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
                <div class="navbar-header navbar-inverse">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                        <span class="sr-only"><a href="#"></a></span>
                        <span class="icon-bar"><a href="#"></a></span>
                        <span class="icon-bar"><a href="#"></a></span>
                        <span class="icon-bar"><a href="#"></a></span>
                    </button>
                </div>
                <!-- Segunda navbar, donde volcamos realmente cada ítem de menú y su correspondiente hipervínculo-->
                <div class="collapse navbar-collapse navbar-ex1-collapse navegacion">
                    <ul class="nav navbar-nav navbar-inverse menu">
                        <li><a href="#"><span class="glyphicon glyphicon-home"></span> Proyecto Distribuidora</a></li>
                        <!--<li><a href="#"><span class="glyphicon glyphicon-folder-open"></span> Organizacion interna</a></li>-->
                        <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-barcode"></span> Productos</a>
                            <ul class="dropdown-menu submenu">
                                <li><a href="./listar.php"><i class="glyphicon glyphicon-list"></i> Ver Productos</a></li>
                                <li><a href="./formulario.php"><i class="glyphicon glyphicon-open"></i> Añadir producto</a></li>
                            </ul>
                        </li>
                        <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-folder-open"></span> Ventas</a>
                            <ul class="dropdown-menu submenu">
                                <li><a href="./ventas.php"><i class="glyphicon glyphicon-signal"></i> Ver Ventas</a></li>
                                <li><a href="./vender.php"><i class="glyphicon glyphicon-usd"></i> Nueva venta</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>

</header>
	<div class="container">
		<div class="row">