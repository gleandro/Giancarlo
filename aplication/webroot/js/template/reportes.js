var $table = $('#bootstrap-table-ventas');

function reservar(element,id){
  var input = $(element).parents(".row").first().find(".codigo_reserva");
  var codigo = input.val();

  if (codigo == "") {
    alert("El campo codigo reserva no puede estar vacio");
    input.focus();
  }else{
    $.ajax({
      url: 'ajax2.php',
      type: 'POST',
      data: '&action=reservarServicio&id='+id+'&codigo='+codigo,
      success: function(result){
        $(element).hide(800, function() {
          input.prop('disabled', true);
        });
      }
    });
  }
}

  function changeFecha(){
    var fecha = $("#fecha_search").val();
    var rows = [];

    $.ajax({
      url: 'ajax2.php',
      type: 'POST',
      data: '&action=getventasxFecha&fecha='+fecha,
      dataType : 'json',
      beforeSend: function(){
        $("#loader").show();
      },
      success: function(result){
        for (var i = 0; i < result.length; i++) {
          rows.push({
            id: result[i].id,
            id_itinerario: result[i].id_itinerario,
            id_servicio: result[i].id_servicio,
            tipo: result[i].tipo,
            cliente: result[i].cliente,
            documento: result[i].documento,
            fecha_reserva: result[i].fecha_reserva,
            nombre: result[i].nombre
          });
        }
        $("#bootstrap-table-ventas").bootstrapTable('load', rows);
        $("#loader").hide();
      }
    });
  }
  function operateFormatter(value, row, index) {
      return [
  '<div class="table-icons">',
            // '<a rel="tooltip" title="Descargar" class="btn btn-simple btn-info btn-icon table-action view" href="javascript:void(0)">',
            // '<i class="ti-image"></i>',
            // '</a>',
            // '<a rel="tooltip" title="Reservar" class="btn btn-simple btn-success btn-icon table-action reserve" href="javascript:void(0)">',
            //     '<i class="ti-calendar"></i>',
            // '</a>',
            '<a rel="tooltip" title="Cancelar" class="btn btn-simple btn-danger btn-icon table-action remove" href="javascript:void(0)">',
                '<i class="ti-close"></i>',
            '</a>',
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
          'click .reserve': function (e, value, row, index){
            info = JSON.stringify(row);
            if (row.id_estado < 2) {
              location.href="ventas.php?action=reserve&id="+row.id;
            }else {
              swal('No puede Continuar', 'Esta venta fue cancelada','info');
            }

          },
          'click .remove': function (e, value, row, index) {
              info = JSON.stringify(row);

              var fecha_actual = moment().format("YYYY-MM-DD");

              var dias = moment(row.fecha_reserva).diff(moment(fecha_actual), 'days');

              if (row.id_estado >= 2) {
                if (row.id_estado == 2) {
                  var texto = "cancelada";
                }else {
                  var texto = "cancelada con penalidad";
                }
                swal('No puede Continuar', 'Esta venta se encuentra '+texto+'.','info');
                return;
              }if (dias <= 0) {
                return;
              }

              if (dias > 60) {
                var titulo = "Cancelar";
                var titulo_salida = "Cancelada";
                var estado = 2;
              }else {
                var titulo = "Cancelar con penalidad";
                var titulo_salida = "Cancelada con penalidad";
                var estado = 3;
              }

              swal({
                  title: titulo,
                  type: 'info',
                  text: 'Esta acción no se puede deshacer,¿Desea continuar?',
                  showCancelButton: true,
                  confirmButtonText: 'Continuar',
                  showLoaderOnConfirm: false,
                  allowOutsideClick: false
                }).then((result) => {
                  $.ajax({
                    url: 'ajax2.php',
                    type: 'POST',
                    data: '&action=updateEstadoCotizacion&id='+row.id+'&estado='+estado,
                    beforeSend: function(){
                    },
                    success: function(datos){
                      swal({
                        title: 'Felicidades!',
                        text: "Venta "+titulo_salida,
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
          }
      };


      $("#wizardFormReservarVentas").submit(function(e) { //AGREGAR UN PAQUETE
          e.preventDefault();
          var cantidad_reserva = $(".codigo_reserva:enabled").length;
          if (cantidad_reserva == 0) {
            $("#estado").val(1);
            var formData = new FormData(this);
            $.ajax({
                url: "ajax2.php",
                type: "POST",
                data:  formData,
                contentType: false,
                processData: false,
                success: function(datos){
                  // alert(datos);
                   swal({
                      title: 'Excelente!',
                      text: "Todos los servicios tienen Codigo de reserva",
                      type: 'success',
                      confirmButtonText: 'Ok!',
                      allowOutsideClick: false,
                      allowEscapeKey: false,
                      onClose: function(){
                        location.href="ventas.php";
                      }
                    })
                }
            });
          }else {
            swal({
               title: 'Hasta luego!',
               text: 'Aun quedan Servicios sin codigo de reserva.',
               type: 'info',
               confirmButtonText: 'Ok!',
               allowOutsideClick: false,
               allowEscapeKey: false,
               onClose: function(){
                 location.href="ventas.php";
               }
             })
          }
          return false;
      });

      $('#wizardFormReservarVentas').bootstrapWizard({
        tabClass: 'nav nav-pills',
        nextSelector: '.btn-next',
        previousSelector: '.btn-back',
        onNext: function(tab, navigation, index) {
          var $valid = $('#wizardFormReservarVentas').valid();
          if(!$valid) {
            $validator.focusInvalid();
            return false;
          }
          if (index == 1) {
            var dias = $(".card-dia").val();
            for (var i = 0; i < dias; i++) {
              $("#collapse"+(i+1)).collapse('toggle');
            }
          }
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

      $table.bootstrapTable({
          toolbar: ".toolbar",
          clickToSelect: false,
          search: true,
          detailView: true,
          showToggle: true,
          pagination: true,
          searchAlign: 'left',
          pageSize: 8,
          seachDate: true,
          pageList: [8,10,25,50,100],
          formatShowingRows: function(pageFrom, pageTo, totalRows){
              //do nothing here, we don't want to show the text "showing x of y from..."
          },
          formatRecordsPerPage: function(pageNumber){
              return pageNumber + " Filas Visibles";
          },
          onExpandRow: function (index, row, $detail) {
            $.ajax({
              url: 'ajax2.php',
              type: 'POST',
              data: '&action=getServiciosXVenta&id='+row.id_itinerario+'&tipo='+row.tipo+'&servicio='+row.id_servicio,
              success: function(result){
                $detail.hide().html(result).fadeIn('slow');
              }
            });
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
