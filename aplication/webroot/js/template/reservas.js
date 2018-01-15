var $table = $('#bootstrap-table-reservas');

  function operateFormatter(value, row, index) {
      return [
  '<div class="table-icons">',
            // '<a rel="tooltip" title="Descargar" class="btn btn-simple btn-info btn-icon table-action view" href="javascript:void(0)">',
            // '<i class="ti-image"></i>',
            // '</a>',
            '<a rel="tooltip" title="Reservar" class="btn btn-simple btn-warning btn-icon table-action reserve" href="javascript:void(0)">',
                '<i class="ti-calendar"></i>',
            '</a>',
            // '<a rel="tooltip" title="Eliminar" class="btn btn-simple btn-danger btn-icon table-action remove" href="javascript:void(0)">',
            //     '<i class="ti-close"></i>',
            // '</a>',
  '</div>',
      ].join('');
  }

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
          'click .reserve': function (e, value, row, index) {
              info = JSON.stringify(row);
              swal({
                  title: 'Cambio de estado',
                  text: 'Se cambiara el estado de la venta a reservada,¿Desea continuar?',
                  showCancelButton: true,
                  confirmButtonText: 'Continuar',
                  showLoaderOnConfirm: false,
                  allowOutsideClick: false
                }).then((result) => {
                  $.ajax({
                    url: 'ajax2.php',
                    type: 'POST',
                    data: '&action=updateEstadoCotizacion&id='+row.id+'&estado=1',
                    beforeSend: function(){
                    },
                    success: function(datos){
                      swal({
                        title: 'Felicidades!',
                        text: "Venta Reservada",
                        type: 'success',
                        confirmButtonText: 'Ok!',
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        onClose: function(){
                          location.href="ventas.php";
                        }
                      })
                    }
                  })
                })


              // location.href="ventas.php?action=edit&id="+row.id;
          }
      };

      $table.bootstrapTable({
          toolbar: ".toolbar",
          clickToSelect: true,
          search: true,
          showToggle: true,
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
