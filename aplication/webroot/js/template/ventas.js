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


  function operateFormatter(value, row, index) {
      return [
  '<div class="table-icons">',
            '<a rel="tooltip" title="Pagos" class="btn btn-simple btn-success btn-icon table-action pago" href="javascript:void(0)">',
            '<i class="ti-money"></i>',
            '</a>',
            '<a rel="tooltip" title="Exportar" class="btn btn-simple btn-info btn-icon table-action view" href="javascript:void(0)">',
            '<i class="ti-image"></i>',
            '</a>',
            '<a rel="tooltip" title="Reservar" class="btn btn-simple btn-info btn-icon table-action reserve" href="javascript:void(0)">',
                '<i class="ti-calendar"></i>',
            '</a>',
            '<a rel="tooltip" title="Cancelar" class="btn btn-simple btn-danger btn-icon table-action remove" href="javascript:void(0)">',
                '<i class="ti-close"></i>',
            '</a>',
  '</div>',
      ].join('');
  }

  function exportExcel(){

    // var datos = $table.bootstrapTable('getSelections');
    // var ventas = new Array();
    // for (var i = 0; i < datos.length; i++) {
    //   ventas.push(parseInt(datos[i].id));
    // }
    //
    // $.ajax({
    //   url: 'excel.php',
    //   type: 'POST',
    //   data: {'ventas':JSON.stringify(ventas)},
    //   success: function(result){
    //     alert(result);
    //   }
    // });

  }

  function removeRow(){
    var ids = $.map($table.bootstrapTable('getSelections'), function (row) {
    return row.id;
    });

    $.ajax({
      url: 'ajax2.php',
      type: 'POST',
      data: '&action=removerVenta&ids='+ids,
      success: function(result){
        swal('Venta Removida', '','success');
        $table.bootstrapTable('remove', {
            field: 'id',
            values: ids
        });
      }
    });
  }

  $().ready(function(){

      window.operateEvents = {
          'click .view': function (e, value, row, index) {
            info = JSON.stringify(row);
            var html = '<h4>Descargar vouchers</h4>';
            if (row.id_agencia != "") {
              html += '<div class="row">'+
                '<div class="col-md-8 col-md-offset-2">'+
                    '<label class="control-label">Incentivo x pasajero</label>'+
                    '<div class="input-group">'+
                      '<div class="input-group-addon">$</div>'+
                      '<input type="number" id="incentivo" name="precio" class="form-control" required placeholder="0">'+
                    '</div>'+
                '</div>'+
                '<div class="col-md-8 col-md-offset-2">'+
                  '<label class="control-label">Comision</label>'+
                  '<div class="input-group">'+
                    '<div class="input-group-addon">%</div>'+
                    '<input type="number" id="comision" name="precio" class="form-control" required placeholder="0">'+
                  '</div>'+
                '</div>'+
                '<div class="col-md-8 col-md-offset-2">'+
                  '<label class="control-label">Fecha limite pago</label>'+
                  '<div class="form-group">'+
                    '<input type="text" class="form-control" placeholder="2018-01-13" id="fecha_pago" />'+
                  '</div>'
                '</div>'+
              '</div>';
            }

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
                var incentivo = $("#incentivo").val();
                var comision = $("#comision").val();
                var fecha = $("#fecha_pago").val();
                if (row.id_agencia != "") {
                  location.href="pdf_ventas.php?id="+row.id+"&agencia="+row.id_agencia+"&incentivo="+incentivo+"&comision="+comision+"&fecha="+fecha;
                }else {
                  location.href="pdf_ventas.php?id="+row.id;
                }
              }
            })

            $(".tipo_documento").selectpicker();
            $('#fecha_pago').datetimepicker({
              format: 'YYYY-MM-DD'
            });
          },
          'click .reserve': function (e, value, row, index){
            info = JSON.stringify(row);
            if (row.id_estado < 2) {
              location.href="ventas.php?action=reserve&id="+row.id;
            }else {
              swal('No puede Continuar', 'Esta venta fue cancelada','info');
            }

          },
          'click .pago': function (e, value, row, index){
            location.href="ventas.php?action=pago&id="+row.id;
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

      $("#wizardFormPagosVentas").submit(function(event) {
        event.preventDefault();
        var restante = parseFloat($("#precio_restante").val());
        var pago = parseFloat($("#monto_pago").val());
        var text = $("#text_swal").val();
        if (pago > restante) {
          swal('Ocurrió un problema', 'No puede ingresar un monto superior al restante','error');
        }else {
          if (pago = restante) {
            $("#key_pago").val(1);
          }
          var formData = new FormData(this);
          $.ajax({
            url: 'ajax2.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(result){
              swal({
                 title: 'Excelente!',
                 text: text,
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

        }
      });

      $('#wizardEditarVentas').bootstrapWizard({
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
          clickToSelect: true,
          search: true,
          showToggle: true,
          pagination: true,
          searchAlign: 'left',
          pageSize: 8,
          clickToSelect: false,
          deleteRowButton: true,
          showExportExcelButton: true,
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

      if ($('#lista_pagos').length > 0) {
        $('#lista_pagos').DataTable( {
          "paging":   false,
          "ordering": false,
          "info":     false,
          "searching": false
          } );
      }

      if ($("#list_forma_pago").length > 0) {
        $('#list_forma_pago').multiselect();
      }

      //activate the tooltips after the data table is initialized
      $('[rel="tooltip"]').tooltip();

      $(window).resize(function () {
          $table.bootstrapTable('resetView');
      });
});
