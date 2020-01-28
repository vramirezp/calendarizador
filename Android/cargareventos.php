<?php
    date_default_timezone_set('America/Santiago');
    $user = $_REQUEST['user'];
    $year=date("Y");
    $month=date("n");
    $day=date("j");
    $fecha = $year."-".$month."-".$day;

    if ($resultset = getSQLResultSet("SELECT ev_nombre,ev_descripcion,ev_fecha,ev_hora FROM evento WHERE us_user='".$user."' AND ev_fecha='".$fecha."'")) 
    {
    	while ($row = $resultset->fetch_array(MYSQLI_NUM)) 
    	{
    		echo json_encode($row);
    	}
   }

    function getSQLResultSet($commando)
    {
 
 		$mysqli = new mysqli("localhost", "inforcon", "blackballoon17", "inforcon_calendario");

		if ($mysqli->connect_errno) 
		{
    		printf("Connect failed: %s\n", $mysqli->connect_error);
    		exit();
		}

		if ( $mysqli->multi_query($commando)) 
		{
			return $mysqli->store_result();
		}

		$mysqli->close();
    }
?>