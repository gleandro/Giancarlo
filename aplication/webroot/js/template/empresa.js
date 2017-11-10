/*EMPRESAS*/
var $tableEmpresa = $('#bootstrap-table-empresas');

function operateFormatter(value, row, index) {
    return [
        '<div class="table-icons">',
            '<!--<a rel="tooltip" title="View" class="btn btn-simple btn-info btn-icon table-action view" href="javascript:void(0)">',
                '<i class="ti-image"></i>-->',
            '</a>',
            '<a rel="tooltip" title="Edit" class="btn btn-simple btn-warning btn-icon table-action edit" href="javascript:void(0)">',
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
        'click .view': function (e, value, row, index) {
            info = JSON.stringify(row);

            swal('En desarrollo...: ', info);
            console.log(info);
        },
        'click .edit': function (e, value, row, index) {
            info = JSON.stringify(row);
            location.href="empresas.php?action=edit&id="+row.id;
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
                data: "&action=borrarEmpresa&id="+row.id,
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
              $tableEmpresa.bootstrapTable('remove', {
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

            


            /**/

        }
    };

    $tableEmpresa.bootstrapTable({
        toolbar: ".toolbar",
        clickToSelect: true,
        showRefresh: true,
        search: true,
        showToggle: true,
        showColumns: true,
        showAddButton: true,
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
        $tableEmpresa.bootstrapTable('resetView');
    });
});

function addEmpresa() {
    location.href="empresas.php?action=add";
}

/*addempresa*/
$().ready(function(){
    $('#formAddEmpresa').validate();
    
});

$().ready(function(){
    $('#formEditEmpresa').validate(); 
});

$("#formAddEmpresa").submit(function(e) {
    e.preventDefault();

    var $form = $(this);

    if(! $form.valid()) return false;

    /*alert($("#formAddEmpresa").serialize()+'&action=registrarEmpresa');*/

    $.ajax({
        type : "GET",
        url :"ajax.php",
        data: $("#formAddEmpresa").serialize()+'&action=registrarEmpresa',
        beforeSend: function(){
                //$("#load_contacto").slideUp(500);
                //$(".load_process").slideDown(500);
        },
        success: function(datos){
               //$("#contenedor_recarga").html(datos);
               //$(".load_process").slideUp(500);
               swal({
                  title: 'Registrado!',
                  text: datos,
                  type: 'success',
                  confirmButtonText: 'Ok!',
                  allowOutsideClick: false,
                  allowEscapeKey: false,
                  onClose: function(){
                    location.href="empresas.php";
                  }
                })
               /*$("#correcto_email").slideDown(500);
               setTimeout('$("#correcto_email").slideUp(500)', 8000);
               document.getElementById('form').reset();*/
        }
    });
    return false;
});

$("#formEditEmpresa").submit(function(e) {
    e.preventDefault();

    var $form = $(this);

    if(! $form.valid()) return false;

    /*alert($("#formEditEmpresa").serialize()+'&action=modificarEmpresa');*/

    $.ajax({
        type : "GET",
        url :"ajax.php",
        data: $("#formEditEmpresa").serialize()+'&action=modificarEmpresa',
        beforeSend: function(){

        },
        success: function(datos){

               swal({
                  title: 'Empresa Editada!',
                  type: 'success',
                  confirmButtonText: 'Ok!',
                  allowOutsideClick: false,
                  allowEscapeKey: false,
                  onClose: function(){
                    location.href="empresas.php";
                  }
                })
        }
    });
    return false;
});

function cancelarRegistro(url) {
    location.href=url+".php";
}
/*addempresa*/   
/*EMPRESAS*/