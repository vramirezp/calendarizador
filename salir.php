<?php 
	include('header.php');
?>
<?php 
session_destroy();
$_SESSION = array();
//Redireccion
header('Location: login.php');

?>

