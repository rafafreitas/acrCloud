<?php

  // Verifica se houve POST e se o usuário ou a senha é(são) vazio(s)
  if (empty($_POST) AND (empty($_POST['login']) OR empty($_POST['senha']))) {
      header("Location: index.php"); exit;
  }

 //Receber dados pelo Post   
 //$senha = mysql_real_escape_string($_POST['senha']);
  $login = $_POST["login"];
  $senha = $_POST['senha'];


 try{
      include 'system/_db/conecta.php';

      $sql = $pdo->prepare("select user_id, user_name, user_login FROM usuarios 
                            WHERE (user_login = ?) AND (user_senha = sha1(?)) LIMIT 1");
      $sql->bindParam(1, $login , PDO::PARAM_STR);
      $sql->bindParam(2, $senha , PDO::PARAM_STR);
      $res = $sql->execute();
      if ($reg = $sql->fetch(PDO::FETCH_OBJ)) {
          
        // Levanta a sessão 
        if (!isset($_SESSION)) session_start();
        //Salva os dados encontrados na sessão
        $_SESSION['UsuarioID'] = $reg->user_id;
        $_SESSION['UsuarioNome'] = $reg->user_name;
        $_SESSION['UsuarioLogin'] = $reg->user_login;

        //No futuro para o sistema resetar a senha do usuário
        //$_SESSION['Reset'] = $reg->Us_Reset;

        echo 1;
      
      }else{
        echo 2;
      }
      
  
   }
   catch(PDOException $e){
      echo $e->getCode();
      //echo "\nPDO::errorCode(): ", $pdo->errorCode();
   }


?>