<?php
	session_start();
	if (!empty($_SESSION['rand_code']))
    {
    	unset($_SESSION['rand_code']);
    }
	$token = "";
    $a = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $length = 20;
    for ($i = 0; $i < $length; $i++)
    {
    $token.= $a[rand(0,61)];
    }
    $_SESSION['token']=$token;
	
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset= "UTF-8">
<link href='https://fonts.googleapis.com/css?family=Abel' rel='stylesheet' type='text/css'>
<link rel="stylesheet" type="text/css" href="style/BodyStyle.css"/>
<link rel="stylesheet" type="text/css" href="style/FooterStyle.css"/>
<link rel="stylesheet" type="text/css" href="style/HeaderStyle.css"/>
<!-- Funcion para no permitir campos vacios -->
<script>function formulario(f) {
	if(checkFormUser() == false){
		return false;
	}
	if(checkFormPass() == false){
		return false;
	}
	if (f.Usuario.value == '') { 
		alert ('DEBE INGRESAR UN NOMBRE DE USUARIO');
		f.Usuario.focus(); 
		return false;
	}
	if (f.Password.value == '') { 
		alert ('DEBE INGRESAR UNA CONTRASEÑA');
		f.Password.focus(); 
		return false; 
	} 
	if (f.rand_code.value == '') { 
		alert ('DEBE INGRESAR EL CAPTCHA');
		f.Password.focus(); 
		return false; 
	} 
	return true; 
}
</script>
</head>
<body>
	<header>
		<img src="imagen.png"><div class="contenedorC"><h1>Despensa</h1> <h1 class="nom">9 de Julio</h1></div>
	</header>

	<div class="titulo"><h2 class="h2" align="left">Iniciar Sesión</h2></div>

	<Form action="procesoLogin.php" method="post" id="form"
	onsubmit="return formulario(this)">

	<input type="hidden" name="token" value="<?php echo $token?>">

	<div class="User" id="User">
	<label for="Usuario">Usuario</label>
	<input type="text" class="Usuario" name="Usuario" onkeyup="ComienzaCon()"/>
	<p class="input-error"></p>
	</div><br /><br />

	<div class="Pass" id="Pass"> 
	<label for="Password">Password</label>
	<input type="Password" class="Password" name="Password" onkeyup="PasswCheck()"/>
	<p class="input-error"></p>
	</div><br /><br />

	<!-- Agregamos el captcha en el formulario -->
	<label for="Ingresar codigo">Ingresar código
	<img src="captcha.php"/></label><br /><br />
	<input type="text" name="rand_code" value=""><br /><br />
	<input class="enviar" type="Submit" name="procesa_form" value="Enviar"/>
	</Form>

	<footer>
	
		<div class="contenedorRedes">
			<h3 class="redes">Redes Sociales</h3>
			<li><a href=""><img src="icon/face.png"></a></li>
			<li><a href=""><img src="icon/insta.png"></a></li>
			<li><a href=""><img src="icon/twitter.jpg"></a></li>
		</div>
		<div class="contenedorContacto">
			<h3>Contacto</h3><h3>Teléfono: 343455555</h3><h3>Email: despensa9dejulio@ghotlook.com</h3>
		</div>
		<h4>Copyright © 2021 | Programación Avanzada </h4> 
	</footer>

	
<!--Javascript-->
<script src="Scripts/validaciones.js"></script>
</body>
</html>

