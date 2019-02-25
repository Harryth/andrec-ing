<?php

    //Avoid insecure code injecting to SQL queries
    function sanitizeString($mysqli,$var)
	{
		$var = strip_tags($var);
		$var = htmlentities($var);
		$var = stripslashes($var);
		return $mysqli->real_escape_string($var);
	}

    //Evaluates page permissions and return it to user
    function permissions($user,$page_perm,$mysqli){
		$mysqli -> query("SET NAMES 'utf8'");
		$result = $mysqli -> query("SELECT `permissions` FROM users WHERE user = '$user';");
		$row = $result -> fetch_array(MYSQLI_BOTH);
		$user_perm = $row['permissions'];
		
		return ($user_perm & $page_perm) == $page_perm;
	}
?>
