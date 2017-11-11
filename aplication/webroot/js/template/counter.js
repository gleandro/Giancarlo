var $table = $('#bootstrap-table-counter');

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

$("#formAddCounter").submit(function(e) {
    e.preventDefault();
    var $form = $(this);
    if(! $form.valid()) return false;
    var formData = new FormData($("#formAddCounter")[0]);
    var ruta = "ajax2.php";
    $.ajax({
        url: ruta,
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function(datos){
           swal({
              title: 'Registrado!',
              text: datos,
              type: 'success',
              confirmButtonText: 'Ok!',
              allowOutsideClick: false,
              allowEscapeKey: false,
              onClose: function(){
                location.href="counters.php";
              }
            })

        }
    });
    return false;
});


$("#formEditCounter").submit(function(e) {
    e.preventDefault();

    var $form = $(this);

    if(! $form.valid()) return false;

    var formData = new FormData($("#formEditCounter")[0]);
    var ruta = "ajax2.php";

    /*alert(formData);*/

    $.ajax({
        url: ruta,
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function(datos){
           swal({
              title: 'Listo!',
              text: 'Registro Modificado!',
              type: 'success',
              confirmButtonText: 'Ok!',
              allowOutsideClick: false,
              allowEscapeKey: false,
              onClose: function(){
                location.href="counters.php";
              }
            })
        }
    });
    return false;
});

  $().ready(function(){
      window.operateEvents = {
          'click .view': function (e, value, row, index) {
              info = JSON.stringify(row);

              swal('You click view icon, row: ', 'vista no disponible');
              console.log(info);
          },
          'click .edit': function (e, value, row, index) {
              info = JSON.stringify(row);

              location.href="counters.php?action=edit&id="+row.id;
          },
          'click .remove': function (e, value, row, index) {
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
                    data: "&action=borrarCounter&id="+row.id,
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
                  $table.bootstrapTable('remove', {
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

      $table.bootstrapTable({
          toolbar: ".toolbar",
          clickToSelect: true,
          showRefresh: true,
          search: true,
          showToggle: true,
          showColumns: true,
          showAddButtonCounter: true,
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
          $table.bootstrapTable('resetView');
      });
});

function addCounter() {
    location.href="counters.php?action=add";
}

function cancelarRegistro(url) {
    location.href=url+".php";
}

/*IMAGENES*/
function archivo(evt) {
  var files = evt.target.files; // FileList object

    //Obtenemos la imagen del campo "file".
  for (var i = 0, f; f = files[i]; i++) {
       //Solo admitimos imágenes.
       if (!f.type.match('image.*')) {
            continue;
       }

       var reader = new FileReader();

       reader.onload = (function(theFile) {
           return function(e) {
           // Creamos la imagen.
                  document.getElementById("list").innerHTML = ['<img class="thumb" src="', e.target.result,'" title="', escape(theFile.name), '"/>'].join('');
           };
       })(f);

       reader.readAsDataURL(f);
   }
}
document.getElementById('files').addEventListener('change', archivo, false);
/*SERVICIO*/
