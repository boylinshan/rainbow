<?php
    $url = sprintf("http://download.finance.yahoo.com/d/quotes.csv?s=%s&f=sl1d1t1c1ohgv&e=.csv",$_GET['name']);

    $handle = fopen($url,"r");
    if($handle !== FALSE){
	$data = fgetcsv($handle);
	echo $data[0] ." ". $data[1];
	    
	fclose($handle);
    }
?>


