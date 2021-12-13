<?php
require_once 'config/config.php';
require_once 'config/conexion.php';
?>
<html>
	<head>
		<meta charset="utf-8">
		<title>Proyecto Inventario</title>
		<style>
		td {
			padding: 3px;
		}
		</style>
	</head>
	<body>
		<h1 align="center">Lista de productos</h1>
		<a href="nuevo.php">
			Nuevo
		</a>&nbsp;&nbsp;&nbsp;
		<a href="ver_historial.php">
			Ver histórico de operaciones
		</a>
		<br>
		<br>
		<table border="1" id="dataTable" width="100%" cellspacing="0">
			<thead>
				<tr>
					<th>Id</th>
					<th>Nombre Producto</th>
					<th>Descripción</th>
					<th>Precio</th>
					<th>Unidades</th>
					<th>Acciones</th>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<th>Id</th>
					<th>Nombre Producto</th>
					<th>Descripción</th>
					<th>Precio</th>
					<th>Unidades</th>
					<th>Acciones</th>
				</tr>
			</tfoot>
			<tbody>
				<?php
				$sql="SELECT * FROM articulos";

				$result=mysqli_query($conn,$sql);
				while($mostrar=mysqli_fetch_array($result)){
				?>
				<tr>
					<td width="5%"><?php echo $mostrar['id']?></td>
					<td width="20%"><?php echo utf8_encode($mostrar['nombre'])?></td>
					<td width="35%"><?php echo utf8_encode($mostrar['detalle'])?></td>
					<td width="10%"><?php echo $mostrar['monto']?></td>
					<td width="10%"><?php echo $mostrar['cantidad']?></td>
					<td width="20%">
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="form_ingresar.php?prod=<?php echo $mostrar['id']?>"><button>Ingresar</button></a>&nbsp;&nbsp;&nbsp;&nbsp;
						<a href="form_egresar.php?prod=<?php echo $mostrar['id']?>"><button>Egresar</button></a>
					</td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
		
		<script>
			
		</script>
		
	</body>
</html>
