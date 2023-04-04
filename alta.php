<?php

require_once 'includes/validoSesion.php';
require_once 'includes/conectar.php';

$Nombre=$_REQUEST['Nombre'];
$Descripcion=$_REQUEST['Descripcion'];
$Precio=$_REQUEST["Precio"];

if(($Nombre != htmlspecialchars($Nombre))){
	echo '<script type="text/javascript"> alert("El nombre no puede contener caracteres especiales");
	window.location.assign("ingresarDatos.php");
	</script>';
}
else if(($Descripcion != htmlspecialchars($Descripcion))){
	echo '<script type="text/javascript"> alert("La descripcion no puede contener caracteres especiales");
			window.location.assign("ingresarDatos.php");
			</script>';
}
else if((!is_numeric($Precio)) OR ($Precio<=0)){
	echo '<script type="text/javascript"> alert("El precio del producto no es correcto, ingrese los datos nuevamente");
			window.location.assign("ingresarDatos.php");
			</script>';
}
else{
	mysqli_select_db($mysqli,"despensa");
	//Saneamiento para sql injection:
	$nombreSaneado=mysqli_escape_string($mysqli,$Nombre);
	$descripcionSaneada=mysqli_escape_string($mysqli,$Descripcion);

	if($Nombre != $nombreSaneado){
		echo '<script type="text/javascript"> alert("Nombre inválido");
		window.location.assign("ingresarDatos.php");
		</script>';
	}
	else if($Descripcion != $descripcionSaneada){
		echo '<script type="text/javascript"> alert("Descripcion inválida");
		window.location.assign("ingresarDatos.php");
		</script>';
	}
	else{
	$result=mysqli_query($mysqli,"insert into Productos(Nombre,Descripcion,Precio) values
			('$Nombre','$Descripcion','$Precio')")
			or die("Error: ".mysqli_error($mysqli));
	echo '<script type="text/javascript"> alert("El producto fue dado de alta");
				window.location.assign("mostrarLista.php");
				</script>';
	}
}
mysqli_close($mysqli);

?>
