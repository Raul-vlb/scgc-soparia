<?php 

date_default_timezone_set('America/Fortaleza'); 
header('Content-type: text/html; charset=UTF-8');
 
// Dados para conexão
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "asopariabd";

// Cria a conexão
$ConnectDB = new mysqli($servername, $username, $password, $dbname);

if($ConnectDB->connect_error){		
	die("Connection failed: " . $ConnectDB->connect_error);		
}else{		
	$ConnectDB->set_charset("utf8");	
}

?>