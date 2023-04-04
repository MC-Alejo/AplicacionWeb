<?php

require_once 'includes/validoSesion.php';

?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="ISO-8859-1">
<link href="style/PagesStyle.css" type="text/css" rel="stylesheet">
<title>Alta de producto</title>
<script>function productos(p) {
	if (p.Nombre.value == '') { 
		alert ('DEBE INGRESAR UN NOMBRE DE PRODUCTO'); 
		p.Nombre.focus(); 
		return false;
	}
	if (p.Descripcion.value == '') { 
		alert ('DEBE INGRESAR UNA DESCRIPCION DE PRODUCTO');
		p.Descripcion.focus(); 
		return false; 
		} 
	if (p.Precio.value == '') { 
		alert ('DEBE INGRESAR UN PRECIO DE PRODUCTO');
		p.Precio.focus(); 
		return false; 
		} 
	return true; 
}

</script>
</head>
<body class="cuerpo_insertar">
	<h2 align="left">Dar de alta un producto</h2>
	<Form action="alta.php" method="post"
	onsubmit="return productos(this)">
	<label for="Nombre">Nombre:</label>
	<input type="text" name="Nombre" /><br /><br />
	<label for="Descripcion">Descripcion:</label>
	<input type="text" name="Descripcion" /><br /><br />
	<label for="Precio">Precio:</label>
	<input type="text" name="Precio" /><br /><br />
	<input type="Submit" value="Enviar"/><br /><br />
	</Form>
	<a href="mostrarLista.php"><input type="submit" value="Volver" name="submit">
	</a>
</body>
</html>
