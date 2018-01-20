<?php

  // Verifica se houve POST e se o usuário ou a senha é(são) vazio(s)
  if (empty($_POST) AND (empty($_POST['login']) OR empty($_POST['senha']))) {
      header("Location: index.php"); exit;
  }

 //Receber dados pelo Post   
 //$senha = mysql_real_escape_string($_POST['senha']);
  $nome = $_POST["nome"];
  $login = $_POST["login"];
  $senha = $_POST['senha'];

 try{
      include 'system/_db/conecta.php';

        $sql = $pdo->prepare("INSERT INTO usuarios 
          (user_name, user_login, user_senha)
          VALUES (?, ?, SHA1(?))"); 
        $sql->bindParam(1, $nome , PDO::PARAM_STR);
        $sql->bindParam(2, $login , PDO::PARAM_STR);
        $sql->bindParam(3, $senha , PDO::PARAM_STR);
        $sql->execute();

        echo 1;
      
   }
   catch(PDOException $e){
      echo $e->getCode();
      //echo "\nPDO::errorCode(): ", $pdo->errorCode();
   }


?>