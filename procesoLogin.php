<?php
	session_start();
	if (!empty($_POST) )
    {
		$a= $_POST["Usuario"];
		$b= $_POST["Password"];
		$c= md5($b);

        if (!empty($_POST['token']) )
        {
			if ($_POST ['token'] == $_SESSION ['token'])
			{
				if (!empty($_POST['rand_code']) )
				{
					if ( $_POST['rand_code'] == $_SESSION['rand_code'] )
					{

						if (ctype_digit($a[0]))
						{
							echo '<script type="text/javascript">
							alert("El primer caracter del nombre de usuario debe ser una letra");
							window.location.assign("index.php");
							</script>';
						}
						else
						{ 
							if(strlen($b) < 6)
							{ 
								echo '<script type="text/javascript">
								alert("La contraseña debe tener al menos 6 caracteres");
								window.location.assign("index.php");
								</script>';
							}
							else if(strlen($b) > 33){ 
								echo '<script type="text/javascript">
								alert("La contraseña no puede tener más de 33 caracteres");
								window.location.assign("index.php");
								</script>';
							}
							else
							{
								if($a != htmlspecialchars($a)){
									echo '<script type="text/javascript">
									alert("El usuario no puede contener caracteres especiales");
									window.location.assign("index.php");
									</script>';
								}
								else if($b != htmlspecialchars($b)){
									echo '<script type="text/javascript">
									alert("La contraseña no puede contener caracteres especiales");
									window.location.assign("index.php");
									</script>';
								}
								else
								{
									require_once 'includes/conectar.php';
									mysqli_select_db($mysqli,"despensa");
									$aSaneada=mysqli_escape_string($mysqli,$a);
									$bSaneada=mysqli_escape_string($mysqli,$b);

									if($a != $aSaneada){
										mysqli_close($mysqli);
										echo '<script type="text/javascript"> alert("Usuario inválido");
										window.location.assign("index.php");
										</script>';
									}
									else if($b != $bSaneada){
										mysqli_close($mysqli);
										echo '<script type="text/javascript"> alert("Contraseña inválida");
										window.location.assign("index.php");
										</script>';
									}
									else
									{
										$resultado = mysqli_query($mysqli,"SELECT * FROM usuarios");
										$mostrar=mysqli_fetch_array($resultado);
										$d= $mostrar['user'];
										$e= $mostrar['pass'];
										mysqli_close($mysqli); 
									
										if(($a == $d) && ($c == $e))
										{	
										$_SESSION['login'] = true;
			
										echo '<script type="text/javascript">
										window.location.assign("mostrarLista.php");
										</script>';
										}
										else
										{
										$_SESSION['login'] = false;
			
										echo '<script type="text/javascript">
										alert("DATOS INCORRECTOS");
										window.location.assign("index.php");
										</script>';
			
										}
									}
								}
								
							}
						}
			
					}
					else
					{
						echo '<script type="text/javascript">
						alert("CÓDIGO INCORRECTO O DE ORIGEN DESCONOCIDO");
						window.location.assign("index.php");
						</script>';
					}
			
				}
			}
			else
			{
				echo '<script type="text/javascript">
				alert("LOS DATOS NO PROVIENEN DE NUESTRO FORMULARIO CON TOKEN");
				window.location.assign("index.php");
				</script>';
			}
		}
		
	}
	
?>

