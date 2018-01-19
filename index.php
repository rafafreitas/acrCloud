<!DOCTYPE html>
<html lang="pt-br">
  <head>
    
    <title>MyMusic - Login</title>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php include "system/_assets/inc/favicon.php"; ?>

    <link href="system/_assets/css/bootstrap.min.css" rel="stylesheet">

    <link href="system/_assets/fonts/css/font-awesome.min.css" rel="stylesheet">
    <link href="system/_assets/css/animate.min.css" rel="stylesheet">

    <!-- Custom styling plus plugins -->
    <link href="system/_assets/css/custom.min.css" rel="stylesheet">
    <link href="system/_assets/css/icheck/flat/green.css" rel="stylesheet">


    <script src="system/_assets/js/jquery.min.js"></script>





    <script>
        $(document).ready(function(){
        $('#erroLogin').hide(); //Esconde o elemento com id errolog
        $('#erroBanco').hide();
            $('#formAcesso').submit(function(){  //Ao submeter formulário
                $('#erroLogin').hide();
                $('#erroBanco').hide();
                var login=$('#email').val();    //Pega valor do campo Login
                var senha=$('#senha').val();    //Pega valor do campo senha
                $.ajax({            //Função AJAX
                    url:"validacao.php",                    //Arquivo php
                    type:"post",                            //Método de envio
                    data: "login="+login+"&senha="+senha,   //Dados
                    success: function (result){             //Sucesso no AJAX
                        if(result==1){                      
                            location.href='red.php'    //Redireciona
                        }if(result==2){
                            $('#erroLogin').addClass('animated shake');
                            $('#erroLogin').show();
                            $("#erroLogin").html("<p class='text-center'>Dados incorretos! Tente novamente.</p>");
                        }if (result !=1 && result != 2){
                            $('#erroBanco').addClass('animated shake');
                            $('#erroBanco').show();
                            $("#erroBanco").html("<p class='text-center'>Erro: "+ result+ "</p>");
                            //Está retornando o erro apenas para testes, depois será exibido uma mensagem amigável.
                        }  
                    }
                })
            return false;   //Evita que a página seja atualizada
            })
        })
    </script>


  </head>

  <body class="login" style="background:#F7F7F7;">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
             <form id="formAcesso" action="validacao.php" method="post">
              <h1>Área Restrita</h1>
              <div>
                <input type="text" class="form-control" id="email" name="email" placeholder="E-Mail" required="" />
              </div>
              <div>
                <input type="password" class="form-control" id="senha" name="senha" placeholder="Senha" required="" />
              </div>
              <p id="erroLogin"></p>
              <div>
                <input type="submit" class="btn btn-default" value="Entrar">
                <a class="reset_pass" href="#signup">Esqueceu a senha?</a>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">Novo no whatMusic?
                  <a href="#" class="to_register"> Cadastre-se </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div>
                  <img src="system/_assets/images/logo.png" style="max-width: 200px; margin-bottom: 20px;">
                  <!--h1><i class="fa fa-paw" style="font-size: 26px;"></i> Eu Doei</h1-->
                  <p>©2017 Todos os direitos reservados. <br/>Desenvolvido por <a href="http://www.google.com/">Rafael Freitas</a></p>
                </div>
              </div>
            </form>
          </section>
        </div>

        <div id="register" class="animate form registration_form">
          <section class="login_content">
            <form>
              <h1>Reset sua senha</h1>
              <div>
                <input type="text" class="form-control" placeholder="Informe seu Login" required="" />
              </div>
              <div>
                <input type="date" class="form-control" placeholder="Data de Nascimento" required="" />
              </div>
              <div>
                <a class="btn btn-default submit" href="index.html">Solicitar</a>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">Já é membro?
                  <a href="#signin" class="to_register"> Login </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div>
                  <img src="system/_assets/images/logo.png" style="max-width: 200px; margin-bottom: 20px;">
                  <!--h1><i class="fa fa-paw" style="font-size: 26px;"></i> Eu Doei</h1-->
                  <p>©2017 Todos os direitos reservados. <br/>Desenvolvido por <a href="http://www.google.com/">Rafael Freitas</a></p>
                </div>
              </div>
            </form>
          </section>
        </div>
      </div>
    </div>
  </body>
</html>
