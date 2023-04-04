<?php
// con error_reporting(0) php deshabilita completamente el reporte de errores.
// esto es para que el usuario tenga solamente un texto amigable en caso que falle la conexion
error_reporting(0);

$mysqli=mysqli_connect("localhost","root","","despensa");
if(!$mysqli){
	die('Fallo al conectar con MySQL. '.mysqli_connect_error());
}
?>