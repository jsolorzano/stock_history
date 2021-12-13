<?php
require_once 'config/config.php';
require_once 'config/conexion.php';

if(isset($_POST['registrar'])){
	//~ echo "<pre>";
	//~ print_r($_POST);
	$nombre = utf8_decode($_POST['nombre']);
	$detalle = utf8_decode($_POST['detalle']);
	$precio = $_POST['monto'];
	$cantidad = $_POST['cantidad'];
	
	if($nombre == "" || is_numeric($nombre)){
		echo '{"message":"El nombre del producto está vacío o no es válido.","message_type":"warning"}';
		header("refresh:2;url=index.php");
	}else if($detalle == "" || is_numeric($detalle)){
		echo '{"message":"La descripción del producto está vacío o no es válido.","message_type":"warning"}';
		header("refresh:2;url=index.php");
	}else if($precio == "" || !is_numeric($precio)){
		echo '{"message":"El precio del producto está vacío o no es válido.","message_type":"warning"}';
		header("refresh:2;url=index.php");
	}else if($cantidad == "" || !is_numeric($cantidad)){
		echo '{"message":"Las unidades del producto está vacío o no es válido.","message_type":"warning"}';
		header("refresh:2;url=index.php");
	}else{
		$sql = "INSERT INTO articulos (nombre, detalle, monto, cantidad, creacion) VALUES".
		"('$nombre', '$detalle', $precio, $cantidad, now())";

		if($result = mysqli_query($conn, $sql)){
			// Ahora registramos la operación en la table de historial
			$last_id = mysqli_insert_id($conn);
			$sql = "INSERT INTO ingreso_egreso (id_producto, cantidad, creacion) VALUES".
			"($last_id, $cantidad, now())";
			$result2 = mysqli_query($conn, $sql);
				
			echo '{"message":"Producto registrado con éxito.","message_type":"success"}';
			header("refresh:1;url=index.php");
		}else{
			echo '{"message":"Ha ocurrido un error en la operación, consulte con el administrador.","message_type":"warning"}';
			header("refresh:1;url=index.php");
		}
		/* close connection */
		mysqli_close($conn);
	}	
}else{
	echo '{"message":"Ha ocurrido un error inesperado, consulte con el administrador.","message_type":"warning"}';
	header("refresh:1;url=index.php");
}
?>
