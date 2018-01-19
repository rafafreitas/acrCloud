<?php
	
session_start(); 	//A seção deve ser iniciada em todas as páginas
if (!isset($_SESSION['UsuarioID']) || !isset($_SESSION['UsuarioNome']) || !isset($_SESSION['UsuarioLogin']) ) {
    session_destroy();						//Destroi a seção por segurança
    header("Location: index.php"); exit;	//Redireciona o visitante para o login
}else {
    
    header("Location: system/adm/index.php");

    /*
	switch ($_SESSION['UsuarioNivel']) {
    case 1:
        header("Location: system/adm/index.php");
        break;
    case 2:
        header("Location: system/ong/index.php");
        break;
    case 3:
        header("Location: system/doa/index.php");
        break;
	}
    */

}

?>