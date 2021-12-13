<?php
require_once 'config/config.php';
require_once 'config/conexion.php';
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
		<form name="form_product" method="post" action="registrar.php">
			<label for="nombre">Nombre</label>
			<input type="text" name="nombre" autofocus>
			<br>
			<br>
			<label for="nombre">Descripción</label>
			<input type="text" name="detalle">
			<br>
			<br>
			<label for="nombre">Precio</label>
			<input type="text" name="monto">
			<br>
			<br>
			<label for="nombre">Cantidad</label>
			<input type="text" name="cantidad">
			<br>
			<br>
			<input type="submit" name="registrar" value="Registrar">
		</form>
		
		<script>
			
		</script>
		
	</body>
</html>
