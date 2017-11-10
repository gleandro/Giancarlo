$(document).ready(function(){
    demo.initStatsDashboard();
});

var $tableTipo = $('#bootstrap-table-tipo-servicios');

function operateFormatter(value, row, index) {
    return [
        '<div class="table-icons">',
            '<a rel="tooltip" title="Editar" class="btn btn-simple btn-warning btn-icon table-action edit" href="javascript:void(0)">',
                '<i class="ti-pencil-alt"></i>',
            '</a>',
            '<a rel="tooltip" title="Eliminar" class="btn btn-simple btn-danger btn-icon table-action remove" href="javascript:void(0)">',
                '<i class="ti-close"></i>',
            '</a>',
        '</div>',
    ].join('');
}

$().ready(function(){
    window.operateEvents = {
        'click .edit': function (e, value, row, index) {
            info = JSON.stringify(row);
            console.log(row);
            console.log(info);
            swal({
              title: 'Modificar Nombre',
              input: 'text',
              inputValue: row.nombre,
              showCancelButton: true,
              inputValidator: function (value) {
                return new Promise(function (resolve, reject) {
                  if (value) {
                    resolve()
                  } else {
                    reject('Necesitas escribir algo!')
                  }
                })
              }
            }).then(function (result) {

              $.ajax({
                type : "GET",
                url :"ajax.php",
                data: "&action=cambiarTipoServicio&id="+row.id+"&nombre="+result,
                beforeSend: function(){
                },
                success: function(datos){
                  /*alert(datos);*/
                  swal({
                    title:'Listo!',
                    text: 'El registro fué modificado.',
                    type: 'success',
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                  }).then(function (result) {
                        location.href="tipo_servicios.php"
                  });
                }
              });

            })

            /*location.href="tipo_servicios.php?action=edit&id="+row.id;*/
        },
        'click .remove': function (e, value, row, index) {
            console.log(row);

            swal({
              title: '¿Estás Seguro?',
              text: "No se pueden recuperar los registros!",
              type: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Si, Borralo!',
              cancelButtonText: 'No, Cancelar!',
              confirmButtonClass: 'btn btn-success',
              cancelButtonClass: 'btn btn-danger',
              allowOutsideClick: false,
              allowEscapeKey: false,
              buttonsStyling: false
            }).then(function () {
              $.ajax({
                type : "GET",
                url :"ajax.php",
                data: "&action=borrarTipoServicio&id="+row.id,
                beforeSend: function(){
                },
                success: function(datos){
                  swal(
                    'Listo!',
                    'El registro fué borrado.',
                    'success'
                  )
                }
              });
              $tableTipo.bootstrapTable('remove', {
                field: 'id',
                values: [row.id]
              });
            }, function (dismiss) {
              // dismiss can be 'cancel', 'overlay',
              // 'close', and 'timer'
              if (dismiss === 'cancel') {
                swal(
                  'Cancelado',
                  'La eliminación fué cancelada',
                  'error'
                )
              }
            })

        }
    };
    $tableTipo.bootstrapTable({
        toolbar: ".toolbar",
        clickToSelect: true,
        showRefresh: true,
        search: true,
        showToggle: true,
        showColumns: true,
        showAddButtonTipoServicio: true,
        pagination: true,
        searchAlign: 'left',
        pageSize: 8,
        clickToSelect: false,
        pageList: [8,10,25,50,100],

        formatShowingRows: function(pageFrom, pageTo, totalRows){
            //do nothing here, we don't want to show the text "showing x of y from..."
        },
        formatRecordsPerPage: function(pageNumber){
            return pageNumber + " Filas Visibles";
        },
        icons: {
            add: 'fa fa-plus',
            refresh: 'fa fa-refresh',
            toggle: 'fa fa-th-list',
            columns: 'fa fa-columns',
            detailOpen: 'fa fa-plus-circle',
            detailClose: 'ti-close'
        }
    });

    //activate the tooltips after the data table is initialized
    $('[rel="tooltip"]').tooltip();

    $(window).resize(function () {
        $tableTipo.bootstrapTable('resetView');
    });
});

function addTipoServicios() {
    location.href="tipo_servicios.php?action=add";
}

$("#formAddTipoServicio").submit(function(e) {
    e.preventDefault();

    var $form = $(this);

    if(! $form.valid()) return false;

    /*alert($("#formAddTipoServicio").serialize()+'&action=registrarTipoServicio');*/

    $.ajax({
        type : "GET",
        url :"ajax.php",
        data: $("#formAddTipoServicio").serialize()+'&action=registrarTipoServicio',
        beforeSend: function(){

        },
        success: function(datos){

           swal({
              title: 'Tipo de Servicio Registrado!',
              type: 'success',
              confirmButtonText: 'Ok!',
              allowOutsideClick: false,
              allowEscapeKey: false,
              onClose: function(){
                location.href="tipo_servicios.php";
              }
            })
        }
    });
    return false;
});

function cancelarRegistro(url) {
location.href=url+".php";
}