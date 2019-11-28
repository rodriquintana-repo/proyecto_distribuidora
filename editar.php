<?php
if(!isset($_GET["id"])) exit(); // pregunta si la referencia está seteada
$id = $_GET["id"]; // la toma
include_once "conexion.php"; // conexión a la base de datos

$sentencia = $base_de_datos->prepare("CALL seleccionar_productos_por_id(?)"); // prepara la query
$sentencia->execute([$id]); // la ejecuta con el parametro de la id
$producto = $sentencia->fetch(PDO::FETCH_OBJ); // llama a los productos con la ID, los toma como objetos

if($producto === FALSE){ // Si devuelve False, sale
	echo "¡No existe algún producto con ese ID!";
	exit();
}

?>
<?php include_once "encabezado.php" ?> <!-- Incluye el encabezado -->
	<div class="col-xs-12">
		<h2>Editar: <?php echo $producto->descripcion; ?></h2> <!-- Encabezado del formulario, en éste caso le pido que me muestre la descripcion -->
		<form method="post" action="guardarDatosEditados.php">
			<input type="hidden" name="id" value="<?php echo $producto->id; ?>"> <!-- Input para cambiar la ID, muestra la actual -->
	
			<label for="codigo">Código de producto:</label>
			<input value="<?php echo $producto->codigo ?>" class="form-control" name="codigo" required type="text" id="codigo" placeholder="Escribe el código">
            <!-- Input para cambiar el codigo del producto, muestra el actual -->
			<label for="descripcion">Descripción:</label>
			<textarea required id="descripcion" name="descripcion" cols="30" rows="5" class="form-control"><?php echo $producto->descripcion ?></textarea>
            <!-- Input para cambiar la descripcion, muestra la actual -->
			<label for="precioVenta">Precio de venta:</label>
			<input value="<?php echo $producto->precioVenta ?>" class="form-control" name="precioVenta" required type="number" id="precioVenta" placeholder="Precio de venta">
            <!-- Input para cambiar el precio de venta, muestra el actual -->
			<label for="precioCompra">Precio de compra:</label>
			<input value="<?php echo $producto->precioCompra ?>" class="form-control" name="precioCompra" required type="number" id="precioCompra" placeholder="Precio de compra">
            <!-- Input para cambiar el precio de compra, muestra el actual -->
			<label for="cantidad">Cantidad:</label>
			<input value="<?php echo $producto->cantidad ?>" class="form-control" name="cantidad" required type="number" id="cantidad" placeholder="Cantidad de productos">
            <!-- Input para cambiar la cantidad de productos en stock, muestra la actual -->
			<br><br><input class="btn btn-info" type="submit" value="Guardar"> <!-- Submit al form -->
			<a class="btn btn-warning" href="./listar.php">Cancelar</a> <!-- Vuelve a la lista de productos -->
		</form>
	</div>
<?php include_once "pie.php" ?> <!-- Footer (que no tenemos jeje) -->
