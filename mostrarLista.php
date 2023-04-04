<?php

require_once 'includes/validoSesion.php';
require_once 'includes/conectar.php';
mysqli_select_db($mysqli,"despensa");
$resultado = mysqli_query($mysqli,"SELECT * FROM usuarios");
$mostrar=mysqli_fetch_array($resultado);
mysqli_close($mysqli);

?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="ISO-8859-1">
<link rel="stylesheet" type="text/css" href="style/PagesStyle.css"/>
<link rel="stylesheet" type="text/css" href="style/FooterStyle.css"/>
<link rel="stylesheet" type="text/css" href="style/HeaderStyle.css"/>
<title>Listado de productos</title>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="sweetalert2.min.css">
</head> 
<body class="cuerpo_mostrarlista">
<header>
	<div class="Log">
	<label>
	<?php
  echo "Logueado como: ";
  echo $mostrar['nombre y apellido'];
	?>
	</label>
	</div>
</header>
<div class="cuerpo_lista">
<h2 align="center">LISTADO DE PRODUCTOS</h2>
<div align="center"> 
<table border=1 bordercolor="silver" bgcolor="black">
	         <tr>
			    <td><font color="white">ID_PROD</font></td>
				<td><font color="white">NOMBRE</font></td>
				<td><font color="white">DESCRIPCION</font></td>
				<td><font color="white">PRECIO</font></td>
			 </tr>
<?php 

  require 'includes/conectar.php';
  mysqli_select_db($mysqli,"despensa");
  $result = mysqli_query($mysqli,"SELECT * FROM productos");
  while($row = mysqli_fetch_array($result))
  {
  	echo"<tr bgcolor='white' style='font-size:15px'>
		<td class='columna' ><input readonly='readonly' type='text' name='id_prod' value='".$row['id_prod']."'/></td>
    	<td class='columna'><input readonly='readonly' type='text' name='nombre' value='".$row['nombre']."'/></td>
    	<td class='columna'><input readonly='readonly' type='text' name='descripcion' value='".$row['descripcion']."'/></td>
    	<td class='columna'><input readonly='readonly' type='text' name='precio' value='".$row['precio']."'/></td> 
    	<td width=\"8%\"><a href=modificacion.php?id_prod=".$row["id_prod"].">Editar</a></td>". "
    	<td width=\"8%\"><a onclick='return ConfirmarEliminacion()' href=baja.php?id_prod=".$row["id_prod"].">Borrar</a></td>". "
		</tr>";
  }
  mysqli_close($mysqli);
?>
</table><br /><br /> 
</div>
<div class="botones">
<a href="logout.php"><input type="submit" value="Salir" id="submit" name="submit">
</a>
<a href="ingresarDatos.php"><input type="submit" value="Nuevo Producto" id="submit" name="submit">
</a>
</div>
</div>

<footer class="inifooter">
	<br>
	<br>
</footer>
</body> 
</html>

<script>
  function ConfirmarEliminacion(){
    var confirmacion = confirm('¿Estás seguro que deseas ELIMINAR el producto?');
    
    if(confirmacion==true){
      return true;
    }
    else{
      return false;
    }
  }
</script>