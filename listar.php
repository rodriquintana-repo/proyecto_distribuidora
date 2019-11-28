<?php include_once "encabezado.php"; ?>
<?php
include_once "conexion.php";
$sentencia = $base_de_datos->query("CALL seleccionar_productos");
$productos = $sentencia->fetchAll(PDO::FETCH_OBJ);
?>

	<div class="col-xs-12">
		<h1>Productos</h1>
		<div>
			<a class="btn btn-success" href="./formulario.php">Agregar Producto  <i class="fa fa-plus"></i></a>
		</div>
		<br>
		<table class="table table-bordered table-responsive">
			<thead>
				<tr>
					<th class="visible-lg">ID</th>
					<th>Código</th>
					<th>Descripción</th>
					<th class="visible-lg">Precio de compra</th>
					<th>Precio</th>
					<th>En stock</th>
					<th>Editar</th>
					<th>Eliminar</th>
				</tr>
			</thead>
            <script>
                function confirma()
                {
                    if (confirm("Desea eliminar el producto de la lista?") === true)
                    {
                        return true;
                    }
                    else
                    {
                        return false;
                    }
                }
            </script>
			<tbody>
				<?php foreach($productos as $producto){ ?>
				<tr>
					<td class="visible-lg"><?php echo $producto->id ?></td>
					<td><?php echo $producto->codigo ?></td>
					<td><?php echo $producto->descripcion ?></td>
					<td class="visible-lg"><?php echo $producto->precioCompra ?></td>
					<td><?php echo $producto->precioVenta ?></td>
					<td><?php echo $producto->cantidad ?></td>
					<td align="center"><a class="btn btn-warning" href="<?php echo "editar.php?id=" . $producto->id?>"><i class="fa fa-edit"></i></a></td>
					<td align="center"><a class="btn btn-danger" href="<?php echo "eliminar.php?id=" . $producto->id?>" onClick="return confirma(this)"><i class="fa fa-trash"></i></a></td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
<?php include_once "pie.php" ?>