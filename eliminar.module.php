<?php
	require('config.php');
	$data = '';
	

	$user = @$_POST['user'];

	if(isset($user))
	{
		$sql = mysqli_query($conexion, "DELETE FROM evento WHERE us_user = '".$user."'");
		$sql = mysqli_query($conexion, "DELETE FROM usuario WHERE us_user = '".$user."' LIMIT 1");
		$data = '1';
	}
			
	echo $data;
?>