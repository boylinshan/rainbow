<?php
require "function.php";

    $con = mysqlConnect('localhost','root','123qwe','stock');
    $sql = "select * from price where code = '" . $_GET['name'] . "'";
    $result = mysqlQuery($con,$sql);
    if($row = mysql_fetch_array($result)){
	$diff = $row['time'];
	$diff = time() - $diff;
	$up = true;
    }
    else{
	$diff = 4 * 3600;
	$up = false;
    }
    if($diff >= 4 * 3600){
	$url = sprintf("http://download.finance.yahoo.com/d/quotes.csv?s=%s&f=sl1d1t1c1ohgv&e=.csv",$_GET['name']);
	$handle = fopen($url,"r");
	if($handle !== FALSE){
	    $data = fgetcsv($handle);
	    fclose($handle);
	}
	if(!$up){
	    $sql = "Insert into price (avg,max,min,code,time) values (%s,%s,%s,'%s',%d)";
	    $sql = sprintf($sql,$data[1],$data[6],$data[7],$data[0],time());
	}
	else{
	    $sql ="update price set avg=%s,max=%s,min=%s,time=%s where code = '%s'";
	    $sql = sprintf($sql,$data[1],$data[6],$data[7],time(),$data[0]);
	}
	mysqlQuery($con,$sql);  
	echo $data[1] ." ". $data[6] ." ". $data[7] ." ". $data[0];
    }
    else{
	echo $row['avg'] ." ". $row['max'] ." ". $row['min'] ." ". $row['code'];
    } 
    mysql_close($con);
?>


