<?php
require_once 'config/config.php';
require_once 'config/conexion.php';

$sql = "SELECT * FROM articulos";
$result = mysqli_query($conn, $sql);

//~ if(isset($_POST)){
	//~ echo "<pre>";
	//~ print_r($_POST);
//~ }
?>
<html>
	<head>
		<meta charset="utf-8">
		<title>Proyecto Inventario</title>
	</head>
	<body>
		<h1 align="center">Lista de productos</h1>
		<form name="form_product" method="post" action="ver_historial.php">
			<label for="nombre">Producto</label>
			<select name="id">
				<option value="">Todos</option>
				<?php while($mostrar=mysqli_fetch_array($result)){ ?>
					<option value="<?php echo $mostrar['id']; ?>" <?php echo ((isset($_POST['ver']) || isset($_POST['ver_primero']) || isset($_POST['ver_ultimo'])) && $_POST['id'] == $mostrar['id']) ? 'selected' : ''; ?>>
					<?php echo $mostrar['nombre']; ?>
					</option>
				<?php } ?>
			</select>
			<br>
			<br>
			<input type="submit" name="ver" value="Ver historial">
			<input type="submit" name="ver_primero" value="Ver primero">
			<input type="submit" name="ver_ultimo" value="Ver último">
		</form>
		
		<hr>
		<table border="1" id="dataTable" width="100%" cellspacing="0">
			<thead>
				<tr>
					<th>Producto</th>
					<th>Unidades</th>
					<th>Fecha</th>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<th>Producto</th>
					<th>Unidades</th>
					<th>Fecha</th>
				</tr>
			</tfoot>
			<tbody>
				<?php
				if(isset($_POST['ver']) || isset($_POST['ver_primero']) || isset($_POST['ver_ultimo'])){
					$id = $_POST['id'];
					$condicion = "";
					$limit = "";
					$order = "DESC";
					if(isset($_POST['ver'])){
						if($id != ""){
							$condicion = "WHERE id_producto = ".$id;
						}
					}else if(isset($_POST['ver_primero'])){
						if($id != ""){
							$condicion = "WHERE id_producto = ".$id;
							$limit = "LIMIT 1";
							$order = "ASC";
						}else{
							$limit = "LIMIT 1";
							$order = "ASC";
						}
					}else if(isset($_POST['ver_ultimo'])){
						if($id != ""){
							$condicion = "WHERE id_producto = ".$id;
							$limit = "LIMIT 1";
							$order = "DESC";
						}else{
							$limit = "LIMIT 1";
							$order = "DESC";
						}
					}else{
						$condicion = "";
						$limit = "";
					}
					$sql2 = "SELECT a.nombre, i_g.cantidad, i_g.creacion FROM ingreso_egreso i_g ".
					"INNER JOIN articulos a ON a.id = i_g.id_producto ".$condicion." ORDER BY i_g.id ".$order." ".$limit;
					$result2 = mysqli_query($conn, $sql2);
					while($mostrar2=mysqli_fetch_array($result2)){
					?>
					<tr>
						<td width="40%"><?php echo utf8_encode($mostrar2['nombre'])?></td>
						<td width="20%"><?php echo $mostrar2['cantidad']?></td>
						<td width="40%"><?php echo $mostrar2['creacion']?></td>
					</tr>
					<?php } ?>
				<?php } ?>
			</tbody>
		</table>
		
		<br>
		
		<a href="index.php">
			Volver
		</a>
		
		<script>
			
		</script>
		
	</body>
</html>
