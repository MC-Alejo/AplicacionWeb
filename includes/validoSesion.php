<?php
session_start();
if(!isset($_SESSION['login'])||($_SESSION['login']!=true)){
	echo '<script type="text/javascript">
		alert("USTED DEBE LOGEARSE");
		window.location.assign("index.php");
		</script>';
}
?>