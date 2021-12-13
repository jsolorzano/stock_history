<?php
require_once 'config/config.php';
require_once 'config/conexion.php';

// Datos del producto
if(isset($_GET['prod']) && $_GET['prod'] != ''){
	$id = $_GET['prod'];
	$sql = "SELECT * FROM articulos WHERE id = ".$id;
	$result = mysqli_query($conn, $sql);
	$mostrar = mysqli_fetch_assoc($result);
	?>
	<html>
		<head>
			<meta charset="utf-8">
			<title>Proyecto Inventario</title>
		</head>
		<body>
			<a href="index.php">Volver</a>
			<br>
			<br>
			<form name="form_product" method="post" action="ingresar.php">
				<label for="nombre">Producto</label>
				<input type="hidden" name="id" value="<?php echo $mostrar['id']; ?>">
				<input type="text" name="nombre" readonly="true" value="<?php echo $mostrar['nombre']; ?>">
				<br>
				<br>
				<label for="nombre">Cantidad</label>
				<input type="text" name="cantidad" autofocus>
				<br>
				<br>
				<input type="submit" name="ingresar" value="Ingresar">
			</form>
			
			<script>
				
			</script>
			
		</body>
	</html>
<?php
}else{
	echo '{"message":"Ha ocurrido un error inesperado, consulte con el administrador.","message_type":"warning"}';
	header("refresh:1;url=index.php");
}
?>
