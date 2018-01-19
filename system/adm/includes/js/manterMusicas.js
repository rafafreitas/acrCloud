var flag = false;
var array_id  = [];
$(document).ready(function(){

  //alert(getTime());
  var tableAt;
  var tableIn;
  initPage();
  initTable(tableAt, tableIn);

});

function initPage() {

  $("#musicaUpload").fileinput({
    overwriteInitial: false,
    initialPreviewFileType: 'image', 
    'showUpload':false, 
    language: "pt-BR",
    allowedFileExtensions: ["mp3","wav","wma","ogg"],
    maxFilePreviewSize: 10240//10MB
  });

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
            { data: "music_artista " },
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
            { data: "music_artista " },
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

  

}//initTable


