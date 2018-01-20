<?php

//Descomentar de Acordo com o Ambiente que o arquivo estiver
try {

	//Servidor hospedado, 
	//$pdo = new PDO("mysql:host=localhost;dbname=u230569690_teste;charset=utf8", "u230569690_teste", "MAw!nC0op7F3~JV", 
	// 	array( PDO::MYSQL_ATTR_INIT_COMMAND => 'set lc_time_names="pt_BR"') );

	//Servidor Local - USBW
	$pdo = new PDO("mysql:host=localhost;dbname=teste;charset=utf8", "root", "root", 
		array( PDO::MYSQL_ATTR_INIT_COMMAND => 'set lc_time_names="pt_BR"') );

	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$pdo->exec("SET CHARACTER SET UTF8");
  	date_default_timezone_set('UTC');
} catch(PDOException $e) {
    echo 'ERROR PDO: ' . $e->getCode();
}

?>