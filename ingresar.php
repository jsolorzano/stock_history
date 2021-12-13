<?php
require_once 'config/config.php';
require_once 'config/conexion.php';

if(isset($_POST['ingresar'])){
	//~ echo "<pre>";
	//~ print_r($_POST);
	$id = $_POST['id'];
	$nombre = utf8_decode($_POST['nombre']);
	$cantidad = $_POST['cantidad'];
	
	if($cantidad == "" || !is_numeric($cantidad)){
		echo '{"message":"Las unidades a ingresar del producto está vacío o no es válido.","message_type":"warning"}';
		header("refresh:2;url=index.php");
	}else{
		$sql = "UPDATE articulos SET cantidad = cantidad + $cantidad WHERE id = $id";

		if($result = mysqli_query($conn, $sql)){
			// Ahora registramos la operación en la table de historial
			$last_id = mysqli_insert_id($conn);
			$sql = "INSERT INTO ingreso_egreso (id_producto, cantidad, creacion) VALUES".
			"($id, $cantidad, now())";
			$result2 = mysqli_query($conn, $sql);
				
			echo '{"message":"Producto actualizado con éxito.","message_type":"success"}';
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
