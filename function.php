<?php
    function mysqlConnect($host,$user,$password,$db){
	$con = mysql_connect($host,$user,$password) or die("error:" . mysql_error());
    	mysql_select_db($db,$con) or die("error:" . mysql_error());
	return $con;
    }
    
    function mysqlQuery($con,$sql){
	$result	= mysql_query($sql,$con) or die("error:" . mysql_error());
	return $result; 
    }
?>
