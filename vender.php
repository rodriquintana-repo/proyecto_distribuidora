<?php 
include_once "encabezado.php";
session_start();
if(!isset($_SESSION["carrito"])) $_SESSION["carrito"] = [];
$granTotal = 0;
?>
	<div class="col-xs-12">
		<h1>Realizar una venta</h1>
		<?php
			if(isset($_GET["status"])){
				if($_GET["status"] === "1"){
					?>
						<div class="alert alert-success">
							<strong>¡Correcto!</strong> Venta realizada correctamente
						</div>
					<?php
				}else if($_GET["status"] === "2"){
					?>
					<div class="alert alert-info">
							<strong>Venta cancelada</strong>
						</div>
					<?php
				}else if($_GET["status"] === "3"){
					?>
					<div class="alert alert-info">
							 Producto eliminado de la lista
						</div>
					<?php
				}else if($_GET["status"] === "4"){
					?>
					<div class="alert alert-warning">
							<strong>Error:</strong> El producto que buscas no existe
						</div>
					<?php
				}else if($_GET["status"] === "5"){
					?>
					<div class="alert alert-danger">
							<strong>Error: </strong>No disponemos de stock
						</div>
					<?php
				}else if($_GET["status"] === "6"){
                    ?>
        <div class="alert alert-danger">
            <strong>Error: </strong>Cantidad de Stock para "<?php $descripcion = $_GET["descripcion"]; echo "$descripcion" ?>" excedida. Stock disponible: <?php $cantidad = $_GET["cantidadDisponible"]; echo "$cantidad" ?>
        </div>
        <?php
        }else{
					?>
					<div class="alert alert-danger">
							<strong>Error:</strong> Algo salió mal mientras se realizaba la venta
						</div>
                    <?php
				}
			}
        if (isset($_POST["btnAgregar"])) {
            $cantidadelegida = $_POST['cantidad'];
        }
		?>
		<br>
		<!--<form method="post" action="agregarAlCarrito.php"> -->
            <!--<div class="input-group">
			    <input autocomplete="off" class="form-control" name="codigo" required type="text" id="codigo" placeholder="Escribe el código del producto">
            </div>
		</form>
        <div class="input-group-item">
            <button type="submit" class="btn btn-success">Añadir al carrito</button>
        </div>-->
        <div class="container-fluid">
                <form method="post" action="agregarAlCarrito.php?cantidad=">
                    <div class="row-fluid form-group col-md-7">
                        <label>Código de producto:</label>
                        <input autocomplete="off" class="form-control" name="codigo" required type="text" id="codigo" placeholder="Escribe el código del producto">
                    </div>
                    <div class="col-md-1">
                        <label for="cantidad"><strong>Cantidad:</strong></label>
                        <select class="form-control" name="cantidad" id="cantidad">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label align="center">Añadir</label>
                        <br>
                        <button type="submit" class="btn btn-success" name="btnAgregar">Añadir al carrito  <i class="fa fa-plus"></i></button>
                    </div>
                </form>
        </div>
		<br><br>
        <div style="text-align: center;"><strong>Productos</strong></div>
		<table class="table table-bordered table-responsive">
			<thead>
				<tr>
					<th class="visible-lg">ID</th>
					<th>Código</th>
					<th>Descripción</th>
					<th>Precio</th>
					<th>Cantidad</th>
					<th>Total</th>
					<th>Quitar</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($_SESSION["carrito"] as $indice => $producto){ 
						$granTotal += $producto->total;
					?>
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
				<tr>
					<td class="visible-lg"><?php echo $producto->id ?></td>
					<td><?php echo $producto->codigo ?></td>
					<td><?php echo $producto->descripcion ?></td>
					<td><?php echo $producto->precioVenta ?></td>
					<td><?php echo $producto->cantidad ?></td>
					<td><?php echo $producto->total ?></td>
					<td align="center"><a class="btn btn-danger" href="<?php echo "quitarDelCarrito.php?indice=" . $indice?>" onClick="return confirma(this)"><i class="fa fa-trash" ></i></a></td>
                </tr>
				<?php } ?>
			</tbody>
		</table>
        <h3>Total (en pesos):  <strong>$<?php echo $granTotal; ?></strong></h3>
        <form action="./terminarVenta.php" method="POST">
            <input name="total" type="hidden" value="<?php echo $granTotal;?>">
            <button type="submit" class="btn btn-success">Terminar venta</button>
            <a href="./cancelarVenta.php" class="btn btn-danger">Cancelar venta</a>
        </form>
	</div>
<?php include_once "pie.php" ?>