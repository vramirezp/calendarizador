<?php

    $user=$_REQUEST["user"];
    $pass=$_REQUEST["pass"];


    if ($resultset = getSQLResultSet("SELECT us_user, us_pass FROM usuario WHERE us_user='$user' && us_pass='$pass'")) 
    {
    	if($resultset->fetch_array(MYSQLI_NUM) == "") 
    	{
    		echo 0;
    	}
        else
        {
            echo 1;
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