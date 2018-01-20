<!DOCTYPE html>
<html lang="pt-br">

<head>

  <!-- Metas Tags -->
  <?php include "includes/verifica.php"; ?>

  <!-- Metas Tags -->
  <?php include "../_assets/inc/metas.php"; ?>

  <!-- Title -->
  <?php include "../_assets/inc/title_adm.php"; ?>

  <!-- Head -->
  <?php include "../_assets/inc/head.php"; ?>

  <!-- Style DataTables -->
  <?php include "../_assets/inc/datatablesStyles.php"; ?>
  
  <!-- JS -->
  <?php include "../_assets/inc/js.php"; ?>

  <!--Input Bootstrap-->
  <?php include "../_assets/inc/js_input.php"; ?>

  <script type="text/javascript" src="includes/js/manterMusicas.js"></script>

  <style type="text/css">
    td.details-control {
      background: url('images/plus.png') no-repeat center center;
      cursor: pointer;
      background-size: 25px 25px;
    }
    tr.shown td.details-control {
      background: url('images/minus_02.png') no-repeat center center;
      cursor: pointer;
      background-size: 25px 25px;
    }
  </style>

</head>

<body class="nav-md">
  <div id="maskLoad"></div>
  <div class="container body">
    <div class="main_container">

      <?php include "includes/menu.php"; ?>

      <div class="right_col" role="main">

        <p class="text-center"><img  id="loadPublicacao" src="../_assets/images/gif/loading.gif" style="max-width: 150px; display:scroll;position:fixed;right: 0px; bottom: 0px; z-index: 10; display: none;"></p>
        <div class="">
          
          <div class="page-title">
            <div class="title_left">
              <h3>Minhas Músicas</h3>
            </div>
            <div class="title_right">
              <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                <div class="input-group">

                </div>
              </div>
            </div>
          </div>
          <div class="clearfix"></div>

          <div class="row">

            <!-- Form de cadastro-->
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Cadastrar Música<small>* Informe uma música para que ela seja salva</small></h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                      <ul class="dropdown-menu" role="menu">
                        <li><a href="#">Configuração 1</a>
                        </li>
                        <li><a href="#">Configuração 2</a>
                        </li>
                      </ul>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <br />
                  <form id="formCadastrar" data-parsley-validate class="form-horizontal form-label-left">

                    
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="icone">Música <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                        <input id="musicaUpload" name="musicaUpload" type="file" class="file-loading" required>
                        </div> 
                      </div>
                    </div>
                    
                    
                    <div class="ln_solid"></div>

                  </form>
                </div>
              </div>
            </div><!--Form de cadastro-->

            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Gerenciar Músicas <small>* Aqui você acompanha os dados dos Uploads das músicas.</small></h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                      <ul class="dropdown-menu" role="menu">
                        <li><a href="#">Settings 1</a>
                        </li>
                        <li><a href="#">Settings 2</a>
                        </li>
                      </ul>
                    </li>
                    <li><a href="#"><i class="fa fa-close"></i></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">

                  
                  

                  <div class="" role="tabpanel" data-example-id="togglable-tabs">
                    <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                      <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Músicas Ativas</a>
                      </li>
                      <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Músicas Inativas</a>
                      </li>
                    </ul>

                    <div id="myTabContent" class="tab-content">
                      <!--Ativos-->
                      <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
  
                        <table id="datatable-music-active" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                          <thead>
                            <tr>
                              <th></th>
                              <th>Nome</th>
                              <th>Artista</th>
                              <th>Album</th>
                              <th>Data - Upload</th>
                              <th>Ações</th>
                            </tr>
                          </thead>
                        </table>
                      </div><!--tab_content1-->

                      <!--inativos-->
                      <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">
                        <table id="datatable-music-inactive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                          <thead>
                            <tr>
                              <th></th>
                              <th>Nome</th>
                              <th>Artista</th>
                              <th>Album</th>
                              <th>Data - Upload</th>
                              <th>Ações</th>
                            </tr>
                          </thead>
                        </table>
                      </div><!--tab_content2-->
                    
                    </div><!--myTabContent-->
                  </div><!--tabpanel-->


              </div>
            </div>

          </div>

        </div>
      </div>
    </div>

  </div>
</div>


<?php include "includes/alertas.php"; ?>
<?php include "../_assets/inc/datatables.php"; ?>
<?php include "../_assets/inc/js_footer.php"; ?>

</body>

</html>
