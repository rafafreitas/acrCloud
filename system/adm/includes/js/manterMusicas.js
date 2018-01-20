var flag = false;
var array_id  = [];
$(document).ready(function(){

  //alert(getTime());
  var tableAt;
  var tableIn;
  initPage(tableAt);
  initTable(tableAt, tableIn);

});

function initPage(tableAt) {

  $('#loadPublicacao').hide();
  
}//initPage

function resetForm(form) {
  $('#'+form).each(function(){
    this.reset(); 
  });
}//ResetForm

function initTable(tableAt, tableIn) {

  tableAt = 
  $('#datatable-music-active').DataTable( {
    //serverSide: false,
    processing: true,
    responsive: true,
    ajax: {
        url: 'manter.php',
        type: "POST",
        data : {
            acao : "manterMusicas",
            tipoAcao: "listAll",
            tableStatus: "A",
        },
        dataSrc: ''
    },
    columns: [
            {
                "className":      'details-control',
                "orderable":      false,
                "data":           null,
                "defaultContent": ''
            },
            { data: "music_name" },
            { data: "music_artista" },
            { data: "music_album" },
            { data: "music_data_envio" },
            { 
              //data: "id_admin", 
              defaultContent: "<button type='button' class='btn btn-warning' id='ouvir' title='Ouvir'><span class='fa fa-play'></button>&nbsp;"+
                              "<button type='button' class='btn btn-danger' id='desativar' title='Desativar'><span class='fa fa-ban'></button>"
            }
        ],
    fixedHeader: true,
    "language": {
      "lengthMenu": "Exibir _MENU_ por página",
      "zeroRecords": "Nada encontrado, desculpe.",
      "processing": "Buscando novos pedidos...",
      "info": "Exibindo página _PAGE_ de _PAGES_",
      "infoEmpty": "Nenhum registro disponível",
      "infoFiltered": "(Filtrado de _MAX_ registros totais)",
      "search": "Buscar: ",
      "paginate": {
        "first":      "Primeiro",
        "last":       "Último",
        "next":       "Prox",
        "previous":   "Anterior"
      }
    }
  });//DataTable-active

  tableIn =
  $('#datatable-music-inactive').DataTable( {
    //serverSide: false,
    processing: true,
    responsive: true,
    ajax: {
        url: 'manter.php',
        type: "POST",
        data : {
            acao : "manterMusicas",
            tipoAcao: "listAll",
            tableStatus: "I",
        },
        dataSrc: ''
    },
    columns: [
            {
                "className":      'details-control',
                "orderable":      false,
                "data":           null,
                "defaultContent": ''
            },
            { data: "music_name" },
            { data: "music_artista" },
            { data: "music_album" },
            { data: "music_data_envio" },
            { 
              //data: "id_admin", 
              defaultContent: "<button type='button' class='btn btn-warning' id='ouvir' title='Ouvir'><span class='fa fa-play'></button>&nbsp;"+
                              "<button type='button' class='btn btn-danger' id='desativar' title='Desativar'><span class='fa fa-ban'></button>"
            }
        ],
    fixedHeader: true,
    "language": {
      "lengthMenu": "Exibir _MENU_ por página",
      "zeroRecords": "Nada encontrado, desculpe.",
      "processing": "Buscando novos pedidos...",
      "info": "Exibindo página _PAGE_ de _PAGES_",
      "infoEmpty": "Nenhum registro disponível",
      "infoFiltered": "(Filtrado de _MAX_ registros totais)",
      "search": "Buscar: ",
      "paginate": {
        "first":      "Primeiro",
        "last":       "Último",
        "next":       "Prox",
        "previous":   "Anterior"
      }
    }
  });//DataTable-active

  $('#datatable-music-active tbody').on( 'click', 'button', function () {
    var data = tableAt.row( $(this).parents('tr') ).data();
    var idClick = $(this).attr('id');
    switch(idClick) {
      case 'ouvir':
          //updateObj(data, 'A');
          break;
      case 'desativar':
          enabDisabled(data.music_id, tableAt, tableIn, 'I');
          break;
      default:
          $('#alertaErro').show();
            setTimeout(function() {
            $('#alertaErro').hide();
          }, 1000);  
    }
    //console.log(data);
    //alert(data.id_admin);
    //table.fnClearTable();//table.clear().draw();
  });//onClick

  $('#datatable-music-inactive tbody').on( 'click', 'button', function () {
    var data = tableIn.row( $(this).parents('tr') ).data();
    var idClick = $(this).attr('id');
    switch(idClick) {
      case 'ouvir':
          //updateObj(data, 'I');
          break;
      case 'ativar':
          enabDisabled(data.music_id, tableAt, tableIn, 'A');
          break;
      default:
          $('#alertaErro').show();
            setTimeout(function() {
            $('#alertaErro').hide();
          }, 1000);  
    }
    //console.log(data);
    //alert(data.id_admin);
    //table.fnClearTable();//table.clear().draw();
  });//onClick

  //plusClick
  $('#datatable-music-active tbody').on('click', 'td.details-control', function () {
    var data = tableAt.row( $(this).parents('tr') ).data();
    var tr = $(this).closest('tr');
    var row = tableAt.row(tr);

    if ( row.child.isShown() ) {
      //var index = array_id.indexOf(data.id_pedido);
      //array_id.splice(index,1);
      // Fecha a linha
      row.child.hide();
      tr.removeClass('shown');
    }
    else {
      //array_id.push(data.id_pedido);
      openChild(data.id_pedido, row, tr);
    }
  });//plusClick

  $("#musicaUpload").fileinput({
    overwriteInitial: false,
    initialPreviewAsData: true, 
    initialPreviewFileType: 'music', 

    uploadUrl: '/system/adm/manter.php',
    uploadExtraData: {acao:'manterMusicas', tipoAcao: 'adicionar', id: "1"},
    language: "pt-BR",
    'showUpload':true, 
    allowedFileExtensions: ["mp3","wav","wma","ogg"],
    maxFilePreviewSize: 10240//10MB
    }).on('fileuploaded', function(event, data, id, index) {
    
      console.log(data.response);
      if (data.response.status == 'OK') {
        $('#alertaSuccess').show();
        tableAt.ajax.reload();
        setTimeout(function() {
          $('#alertaSuccess').hide();
        }, 2000);

      }else{
        $('#alertaErro').show();
        setTimeout(function() {
          $('#alertaErro').hide();
        }, 2000);    
      }

  });

}//initTable

function enabDisabled(Id_Update, tableAt, tableIn, status) {
  if (status == 'A') {
    stName = "ativar";
  }if (status == 'I') {
    stName = "inativar";
  }
  bootbox.confirm({
    message: "<h3 class='text-center'>Deseja "+stName+" esta Música?</h3>",
    buttons: {
      confirm: {
        label: 'Sim!',
        className: 'btn-success'
      },
      cancel: {
        label: 'Cancelar!',
        className: 'btn-danger'
      }
    },
    callback: function (confirma) {
      if (confirma == true) {
        $('#loadPublicacao').show();
        var acao = 'manterMusicas';
        var tipoAcao = 'enableDisable'; 
        $.ajax({
          url:"manter.php",                    
          type:"post",                            
          data: "Id_Update="+Id_Update+"&acao="+acao+"&tipoAcao="+tipoAcao+"&status="+status,
          success: function (result){ 
            if (result == 1) {
              $('#loadPublicacao').hide();
              $('#alertaSucessoInfo').show();
              tableAt.ajax.reload();
              tableIn.ajax.reload();
              setTimeout(function() {
                $('#alertaSucessoInfo').hide();
              }, 3000);   
            }if (result !=1){
              $('#loadPublicacao').hide();
              $('#alertaErro').show();
              setTimeout(function() {
                $('#alertaErro').hide();
              }, 3000);                   
            }
          }
        });
      }else{

      }
    }//callback
  });//bootbox
}//delUser

