<?php

require_once 'includes/validoSesion.php';
require_once 'includes/conectar.php';

if(!isset($_GET['id_prod'])){
	$id_prod="";
}else{
	$id_prod=$_GET["id_prod"];
}

if((ctype_digit($id_prod)) AND ($id_prod>0)){
mysqli_select_db($mysqli,"despensa");
$result = mysqli_query($mysqli,"DELETE FROM productos WHERE id_prod='".$id_prod."'")	
		or die("Error: ".mysqli_error($mysqli));
mysqli_query($mysqli,"ALTER TABLE `productos` AUTO_INCREMENT=1");
echo '<script type="text/javascript"> alert("El registro fue eliminado con exito");
			window.location.assign("mostrarLista.php");
			</script>';
}
else{
	echo '<script type="text/javascript"> alert("No fue posible realizar la accion solicitada");
			window.location.assign("mostrarLista.php");
			</script>';
}
	
mysqli_close($mysqli);

?>