<?php include_once "encabezado.php" ?>

<?php

    if(isset($_GET["error"]))
    {
        if($_GET["error"] === 1){?>
            <div class="alert alert-danger">
                <strong>Error: </strong>No disponemos de stock
            </div>
        <?php }
    }

?>

<div class="col-xs-12">
	<h1>Nuevo producto</h1>
	<form method="post" action="nuevo.php">
		<label for="codigo">Código de barras:</label>
		<input class="form-control" name="codigo" required type="text" id="codigo" placeholder="Escribe el código">

		<label for="descripcion">Descripción:</label>
		<textarea required id="descripcion" name="descripcion" cols="30" rows="5" class="form-control"></textarea>

		<label for="precioVenta">Precio de venta:</label>
		<input class="form-control" name="precioVenta" required type="number" id="precioVenta" placeholder="Precio de venta">

		<label for="precioCompra">Precio de compra:</label>
		<input class="form-control" name="precioCompra" required type="number" id="precioCompra" placeholder="Precio de compra">

		<label for="cantidad">Cantidad:</label>
		<input class="form-control" name="cantidad" required type="number" id="cantidad" placeholder="Cantidad">
		<br><br><input class="btn btn-info" type="submit" value="Guardar">
	</form>
</div>
<?php include_once "pie.php" ?>