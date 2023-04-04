<?php
require_once 'includes/validoSesion.php';
require_once 'includes/conectar.php';
mysqli_select_db($mysqli,"despensa");

if(isset($_POST["submit"])){

	if(!isset($_POST['id_prod'])){
		$id_prod="";
	}else{
		$id_prod=$_POST["id_prod"];
	}

	$Nombre=$_POST['nombre'];
	$Descripcion=$_POST['descripcion'];
	$Precio=$_POST["precio"];

	if(!ctype_digit($id_prod) OR $id_prod<=0){
		echo '<script type="text/javascript"> alert("No fue posible realizar la accion solicitada");
		window.location.assign("mostrarlista.php");
		</script>';
	}
	else{
	//Rechazamos codigo html ej: <script>
	if(($Nombre != htmlspecialchars($Nombre))){
		echo '<script type="text/javascript"> alert("El nombre no puede contener caracteres especiales");
		window.location.assign("modificacion.php?id_prod='.$id_prod.'");
		</script>';
	}
	else if(($Descripcion != htmlspecialchars($Descripcion))){
		echo '<script type="text/javascript"> alert("La descripcion no puede contener caracteres especiales");
		window.location.assign("modificacion.php?id_prod='.$id_prod.'");
		</script>';
	}
	else if((!is_numeric($Precio)) OR ($Precio<=0)){
		echo '<script type="text/javascript"> alert("El precio del producto no es correcto, ingrese los datos nuevamente");
		window.location.assign("modificacion.php?id_prod='.$id_prod.'");
		</script>';
	}
	else{

		//Saneamiento para sql injection:
		$nombreSaneado=mysqli_escape_string($mysqli,$Nombre);
		$descripcionSaneada=mysqli_escape_string($mysqli,$Descripcion);

		if($Nombre != $nombreSaneado){
			echo '<script type="text/javascript"> alert("Nombre inválido");
			window.location.assign("modificacion.php?id_prod='.$id_prod.'");
			</script>';
		}
		else if($Descripcion != $descripcionSaneada){
			echo '<script type="text/javascript"> alert("Descripcion inválida");
			window.location.assign("modificacion.php?id_prod='.$id_prod.'");
			</script>';
		}
		else{
			$result= mysqli_query($mysqli,"UPDATE productos SET nombre='".$Nombre."',
			descripcion='".$Descripcion."', precio='".$Precio."' WHERE id_prod='".$id_prod."'")
			or die("Error: ".mysqli_error($mysqli));
	
			echo '<script type="text/javascript"> alert("El registro fue modificado con exito");
			window.location.assign("mostrarLista.php");
			</script>';
		}
	}
}

}else{

	if(!isset($_GET['id_prod'])){
		$id_prod="";
	}else{
		$id_prod=$_GET["id_prod"];
	}

	if((!ctype_digit($id_prod)) OR ($id_prod<=0)){
		echo '<script type="text/javascript"> alert("No fue posible realizar la accion solicitada");
		window.location.assign("mostrarLista.php");
		</script>';
	}
	else{
		echo '<!DOCTYPE html>
		<html lang="es">
		<head>
		<meta charset="ISO-8859-1">
		<link rel="stylesheet" type="text/css" href="style/PagesStyle.css"/>
		<title>Modificar Producto</title>
		<head>
		<body class="cuerpo_editar">';

	$result=mysqli_query($mysqli,"SELECT * FROM productos WHERE id_prod='".$id_prod."'") 
	or die("Error: ".mysqli_error($mysqli));
	 
	if(mysqli_num_rows($result) > 0){

	while($Rs=mysqli_fetch_array($result)) {
	 
	?>
	<form  method=Post name=form action="modificacion.php">
	    <table>
		<tr>
		<td colspan=2><strong> MODIFICAR UN REGISTRO </strong><br /><br /></td>
	    </tr><br /><br />
	  <tr>
	    <td> Id_prod: </td>
	    <td class='columna'><input name='id_prod'  type='text' maxlength='20' value="<?php echo $Rs['id_prod']; ?>" readonly="readonly"></td>
	    </tr>
	  <tr>
	    <td> Nombre: </td>
	    <td><input name='nombre'  type='text' maxlength='20' value="<?php echo $Rs['nombre']; ?>"></td>
	    </tr>
	  <tr>
	    <td> Descripcion: </td>
	    <td><input name='descripcion'  type='text' maxlength='140' value="<?php echo $Rs['descripcion']; ?>"></td>
	    </tr>
	  <tr>
	    <td> Precio: </td>
	    <td><input name='precio'  type='text' maxlength='20' value="<?php echo $Rs['precio']; ?>"></td>
	    </tr>
	   <tr>
	    <td><br /><input name='submit' type='submit' value='Enviar'></td>
	  </tr>
	</table>
	</form>
	<a href="mostrarLista.php"><input type="submit" value="Volver" name="submit">
	</a>
	<?php
	}
	echo "</body>
		</html>";
	   
	}else{
	    echo '<script type="text/javascript"> alert("No fue posible realizar la accion solicitada");
				window.location.assign("mostrarLista.php");
				</script>';
	}
	}
}
mysqli_close($mysqli);

?>