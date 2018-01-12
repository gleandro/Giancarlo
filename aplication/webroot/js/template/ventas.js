var $table = $('#bootstrap-table-ventas');

var estados = new Array('En espera', 'Reservado', 'Reservado 2', 'Cancelar', 'Vender');

  function operateFormatter(value, row, index) {
      return [
  '<div class="table-icons">',
            '<a rel="tooltip" title="Descargar" class="btn btn-simple btn-info btn-icon table-action view" href="javascript:void(0)">',
            '<i class="ti-image"></i>',
            '</a>',
            '<a rel="tooltip" title="Editar" class="btn btn-simple btn-warning btn-icon table-action edit" href="javascript:void(0)">',
                '<i class="ti-more-alt"></i>',
            '</a>',
            // '<a rel="tooltip" title="Eliminar" class="btn btn-simple btn-danger btn-icon table-action remove" href="javascript:void(0)">',
            //     '<i class="ti-close"></i>',
            // '</a>',
  '</div>',
      ].join('');
  }

$("#formAddAgencia").submit(function(e) { //AGREGAR UN PAQUETE
    e.preventDefault();
    var $form = $(this);
    if(! $form.valid()) return false;
    var formData = new FormData($("#formAddAgencia")[0]);
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
                location.href="agencias.php";
              }
            })

        }
    });
    return false;
});


$("#formEditAgencia").submit(function(e) {
    e.preventDefault();
    var $form = $(this);
    if(! $form.valid()) return false;
    var formData = new FormData($("#formEditAgencia")[0]);
    var ruta = "ajax2.php";
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
                location.href="agencias.php";
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
            var html = '<h4>Selecciona un Tipo de Documento</4>'+
                        '<select class="tipo_documento">'+
                          '<option value ="0">PDF</option>'+
                          '<option value ="1">WORD</option>'+
                        '</select>';
            swal({
              type: 'info',
              html: html,
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Descargar',
              cancelButtonText: 'Cancelar',
              confirmButtonClass: 'btn btn-success',
              cancelButtonClass: 'btn btn-danger',
              allowOutsideClick: false,
              allowEscapeKey: false,
              buttonsStyling: false,
              preConfirm: () => {
                var dato = $("select.tipo_documento").val();
                if (dato == 0) {
                  swal('', 'Se descargo el archivo pdf','success');
                }else {
                  swal('', 'Se descargo el archivo word','success');
                }
                $.ajax({
                  url: 'ajax2.php',
                  type: 'POST',
                  data: '&action=getIdCotizacion&id='+row.id,
                  success: function(datos){
                    var id_cotizacion = datos.replace("	","");
                    location.href="pdf_cotizacion.php?id="+id_cotizacion+"&tipo="+dato;

                  }
                });

              }
            })

            $(".tipo_documento").selectpicker();

          },
          'click .edit': function (e, value, row, index) {
              info = JSON.stringify(row);
              var estado = parseInt(row.id_estado);
              var html = '<h4>Selecciona una acción</4>'+
                          '<select class="tipo_action" data-size="5">';
              for (var i = estado+1 ; i < estados.length; i++) {
                html += '<option value ="'+i+'">'+estados[i]+'</option>';
              }
              html +='</select>';
              swal({
                type: 'info',
                html: html,
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Seleccionar',
                cancelButtonText: 'Cancelar',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                allowOutsideClick: false,
                allowEscapeKey: false,
                buttonsStyling: false,
                preConfirm: () => {
                  var dato = $("select.tipo_action").val();
                  var id_venta = parseInt(row.id);
                  $.ajax({
                    url: 'ajax2.php',
                    type: 'POST',
                    data: '&action=updateEstadoCotizacion&id='+id_venta+'&estado='+dato,
                    success: function(datos){
                      location.href="ventas.php";
                    }
                  });
                }
              })
              $(".tipo_action").selectpicker();
              // location.href="ventas.php?action=edit&id="+row.id;
          }
      };

      $table.bootstrapTable({
          toolbar: ".toolbar",
          clickToSelect: true,
          showRefresh: true,
          search: true,
          showToggle: true,
          showColumns: true,
          showAddButtonAgencia: true,
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

      $('#wizardEditarVentas').bootstrapWizard({
        tabClass: 'nav nav-pills',
        nextSelector: '.btn-next',
        previousSelector: '.btn-back',
        onNext: function(tab, navigation, index) {
        },
        onInit : function(tab, navigation, index){

          //check number of tabs and fill the entire row
          var $total = navigation.find('li').length;
          $width = 100/$total;

          $display_width = $(document).width();

          if($display_width < 600 && $total > 3){
            $width = 50;
          }

          navigation.find('li').css('width',$width + '%');
        },
        onTabClick : function(tab, navigation, index){
          // Disable the posibility to click on tabs
          return false;
        },
        onTabShow: function(tab, navigation, index) {
          var $total = navigation.find('li').length;
          var $current = index+1;

          var wizard = navigation.closest('.card-wizard');

          // If it's the last tab then hide the last button and show the finish instead
          if($current >= $total) {
            $(wizard).find('.btn-next').hide();
            $(wizard).find('.btn-finish').show();
            $(wizard).find('.btn-back').show();
          } else if($current == 1){
            $(wizard).find('.btn-back').hide();
            $(wizard).find('.btn-next').show();
            $(wizard).find('.btn-finish').hide();
          } else {
            $(wizard).find('.btn-back').show();
            $(wizard).find('.btn-next').show();
            $(wizard).find('.btn-finish').hide();
          }
        }
      });
      //activate the tooltips after the data table is initialized
      $('[rel="tooltip"]').tooltip();

      $(window).resize(function () {
          $table.bootstrapTable('resetView');
      });
});

function addAgencias() {
    location.href="ventas.php?action=add";
}

function cancelarRegistro(url) {
    location.href=url+".php";
}
