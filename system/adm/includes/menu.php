<?php include "../_db/conecta.php"; ?>
<div class="col-md-3 left_col">
  <div class="left_col scroll-view">

    <div class="navbar nav_title" style="border: 0;">
      <a href="index.php" class="site_title"><i class="fa fa-gears"></i> <img src="../_assets/images/logo.png" style="max-width: 80px;margin-left: 30px;"></a>
    </div>
    <div class="clearfix"></div>

    <!-- menu prile quick info -->
    <div class="profile">
      <div class="profile_pic">
        <img src="images/img1.png" alt="..." class="img-circle profile_img">
      </div>
      <div class="profile_info">
        <span>Bem Vindo,</span>
        <h2><?php echo "".$NomeLogado[0]." ".end($NomeLogado)."" ?></h2>
        <br/>
      </div>
    </div>
    <!-- /menu prile quick info -->

    <!-- sidebar menu -->
    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
      <div class="menu_section">
        <h3>Índice Geral</h3>
        <ul class="nav side-menu">
          <li><a href="index.php"><i class="fa fa-tachometer"></i> Dashboard </a></li>
          <li><a href="musicas.php"><i class="fa fa-music"></i> Minhas Músicas </a></li>
        </ul>
      </div>

    </div>
    <!-- /sidebar menu -->

    <!-- /menu footer buttons -->
    <div class="sidebar-footer hidden-small">
      <a data-toggle="tooltip" data-placement="top" title="Configurações">
        <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
      </a>
      <a data-toggle="tooltip" data-placement="top" title="Tela Cheia" id="telaCheia">
        <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
      </a>
      <a data-toggle="tooltip" data-placement="top" title="Bloquear">
        <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
      </a>
      <a href="logout.php" data-toggle="tooltip" data-placement="top" title="Sair">
        <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
      </a>
    </div>
    <!-- /menu footer buttons -->
  </div>
</div>

<!-- top navigation -->
<div class="top_nav">

  <div class="nav_menu">
    <nav class="" role="navigation">
      <div class="nav toggle">
        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
      </div>

      <ul class="nav navbar-nav navbar-right">
        <li class="">
          <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
            <img src="images/img1.png" alt=""><?php echo "".$NomeLogado[0]." ".end($NomeLogado)."" ?>
            <span class=" fa fa-angle-down"></span>
          </a>
          <ul class="dropdown-menu dropdown-usermenu animated fadeInDown pull-right">
            <li>
              <a href="javascript:;"><i class="fa fa-user pull-right"></i>Perfil</a>
            </li>
            <li>
              <a href="javascript:;"><i class="fa fa-cogs pull-right"></i>Configurações</a>
            </li>
            <li><a href="logout.php"><i class="fa fa-sign-out pull-right"></i> Sair</a>
            </li>
          </ul>
        </li>

      </ul>
    </nav>
  </div>

</div>
      <!-- /top navigation -->

<script>
$(function() {
  function requestFullScreen(element) {
    // Supports most browsers and their versions.
    var requestMethod = element.requestFullScreen || element.webkitRequestFullScreen || element.mozRequestFullScreen || element.msRequestFullscreen;

    if (requestMethod) { // Native full screen.
      requestMethod.call(element);
    } else if (typeof window.ActiveXObject !== "undefined") { // Older IE.
      var wscript = new ActiveXObject("WScript.Shell");
      if (wscript !== null) {
        wscript.SendKeys("{F11}");
      }
    }
  }

  var elem = $("#full")[0]; // Make the body go full screen.
  $("#telaCheia").click(function() {
    requestFullScreen(elem);
  });
});
</script>