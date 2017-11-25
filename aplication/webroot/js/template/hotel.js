/* HOTELE*/
$("#formAddHotel").submit(function(e) {
    e.preventDefault();

    var $form = $(this);

    if(! $form.valid()) return false;

    var formData = new FormData($("#formAddHotel")[0]);
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
              title: 'Registrado!',
              text: datos,
              type: 'success',
              confirmButtonText: 'Ok!',
              allowOutsideClick: false,
              allowEscapeKey: false,
              onClose: function(){
                location.href="hoteles.php";
              }
            })
        }
    });
    return false;
});


$("#formEditHotel").submit(function(e) {
    e.preventDefault();

    var $form = $(this);

    if(! $form.valid()) return false;

    var formData = new FormData($("#formEditHotel")[0]);
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
                location.href="hoteles.php";
              }
            })
        }
    });
    return false;
});

var $table = $('#bootstrap-table');

  function operateFormatter(value, row, index) {
      return [
  '<div class="table-icons">',
                '<a rel="tooltip" title="Tarifas" class="btn btn-simple btn-success btn-icon table-action money" href="javascript:void(0)">',
                    '<i class="ti-money"></i>',
                '</a>',
            '<!--<a rel="tooltip" title="View" class="btn btn-simple btn-info btn-icon table-action view" href="javascript:void(0)">',
      '<i class="ti-image"></i>',
    '</a>-->',
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
          'click .money': function (e, value, row, index) {
              info = JSON.stringify(row);

              location.href="hoteles.php?action=rate&id="+row.id;
              console.log(info);
          },
          'click .view': function (e, value, row, index) {
              info = JSON.stringify(row);

              swal('You click view icon, row: ', 'vista no disponible');
              console.log(info);
          },
          'click .edit': function (e, value, row, index) {
              info = JSON.stringify(row);

              location.href="hoteles.php?action=edit&id="+row.id;
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
                    data: "&action=borrarHotel&id="+row.id,
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
            showAddButtonHotel: true,
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

function addHotel() {
    location.href="hoteles.php?action=add";
}

function cancelarRegistro(url) {
    location.href=url+".php";
}

/*TAFIRAS HOTELES*/
$("#formAddHotelTarifa").validate();
$("#formAddHotelTarifa").submit(function(e) {
    e.preventDefault();

    var $form = $(this);

    if(! $form.valid()) return false;
    var idHotel = $('#hotel').val();
    $.ajax({
        type : "GET",
        url :"ajax.php",
        data: $("#formAddHotelTarifa").serialize()+'&action=registrarHotelTarifa',
        beforeSend: function(){
        },
        success: function(datos){
           swal({
              title: 'Tarifa Registrada!',
              text: '',
              type: 'success',
              confirmButtonText: 'Ok!',
              allowOutsideClick: false,
              allowEscapeKey: false,
              onClose: function(){
                location.href='hoteles.php?action=rate&id='+idHotel;
              }
            })
        }
    });
    return false;
});
function eliminarTarifa(id) {
  swal({
    title: '¿Estás Seguro?',
    text: "Se elimiran ambos tipos(Nacionales-Extranjeros) y no se pueden recuperar los registros!",
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
      data: "&action=borrarHotelTarifa&id="+id,
      beforeSend: function(){
      },
      success: function(datos){
        swal(
          'Listo!',
          'La tarifa fué eliminada.',
          'success'
        )
        $('#card'+id).remove();
        location.reload();
      }
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

function editarTarifa(id,habitacion,precio,tipo) {
  $('#modalEditarTarifa').modal('show');
  $('#editprecio').attr("value",precio);
  if (tipo == 1) {
    $("#edittipo").val("Tarifa Nacional");
    $("#tipo").val(tipo);
  }else {
    $("#edittipo").val("Tarifa Extranjera");
    $("#tipo").val(tipo);
  }

  $("#edithabitacion").val(habitacion).change();
  $('#idtarifa').attr("value",id);
}

$("#formEditHotelTarifa").submit(function(e) {
    e.preventDefault();

    var $form = $(this);

    if(! $form.valid()) return false;
    var idHotel = $('#hotel').val();
    $.ajax({
        type : "GET",
        url :"ajax.php",
        data: $("#formEditHotelTarifa").serialize()+'&action=cambiarHotelTarifa',
        beforeSend: function(){
        },
        success: function(datos){
           swal({
              title: 'Tarifa Editada!',
              text: datos,
              type: 'success',
              confirmButtonText: 'Ok!',
              allowOutsideClick: false,
              allowEscapeKey: false,
              onClose: function(){
                location.href='hoteles.php?action=rate&id='+idHotel;
              }
            })
        }
    });
    return false;
});
/*TARIFAS HOTELES*/

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





/*HOTELES*/
