/*SERVICIO*/
var $tablePaquete = $('#bootstrap-table-paquetes');

function operateFormatter(value, row, index) {
  return [
    '<div class="table-icons">',
    '<a rel="tooltip" title="Copy" class="btn btn-simple btn-success btn-icon table-action copy" href="javascript:void(0)">',
    '<i class="ti-clipboard"></i>',
    '</a>',
    '<a rel="tooltip" title="View" class="btn btn-simple btn-info btn-icon table-action view" href="javascript:void(0)">',
    '<i class="ti-image"></i>',
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

function eliminar_inclusiones(dato){
  swal({
    title: '¿Estás Seguro?',
    text: "No se pueden recuperar los registros!",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Si, borralo!',
    cancelButtonText: 'No, Cancelar!',
    confirmButtonClass: 'btn btn-success',
    cancelButtonClass: 'btn btn-danger',
    allowOutsideClick: false,
    allowEscapeKey: false
  }).then(function () {
    dato.parentElement.remove();
    if ($("#incluye")[0].childElementCount == 0) {
      $("#incluye").append('<li id="vacio" class="list-group-item list-group-item-success"><p>No se ingresaron</p><p>Inclusiones</p></li>');
    }
    if ($("#excluye")[0].childElementCount == 0) {
      $("#excluye").append('<li id="vacio" class="list-group-item list-group-item-danger"><p>No se ingresaron</p><p>Exclusiones</p></li>');
    }
  })
}

function eliminar_opciones_hoteles(dato){
  swal({
    title: '¿Estás Seguro?',
    text: "No se pueden recuperar los registros!",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Si, borralo!',
    cancelButtonText: 'No, Cancelar!',
    confirmButtonClass: 'btn btn-success',
    cancelButtonClass: 'btn btn-danger',
    allowOutsideClick: false,
    allowEscapeKey: false
  }).then(function () {
    dato.parentElement.remove();
    // $("#incluye").append('<li id="vacio" class="list-group-item list-group-item-success"><p>No se ingresaron</p><p>Inclusiones</p></li>');
  })
}

function crear_table(){
  var dias_edit = $(".card-dia").val();
  for (var i = 0; i < dias_edit; i++) {
      var table_s = $('#table_s_'+i).DataTable({
        "paging":   false
      });
    $('#table_s_'+i+' tbody').on( 'click', 'tr', function () {
      $(this).toggleClass('selected');
    } );

    $('#button').click( function () {
      alert( table_s.rows('.selected').data().length +' row(s) selected' );
    } );
  }
}


$().ready(function(){
  crear_table();

  if ($(".select_hoteles_inline").length>0) {
    $('.select_hoteles_inline').multiselect({
      enableFiltering: true
    });
  }

  $(".agregar_opcion_inline").click(function(event) {
    var input_dia = $(this).parents(".input-group").children(".index_dia_inline");
    var dia = input_dia.val();

    var hotel = $(this).parents(".panel").find(".select_hoteles_inline option:selected").html();
    var id_hotel = $(this).parents(".panel").find(".select_hoteles_inline option:selected").val();
    var contenedor_p = $(this).parents(".panel").find(".panel-body");
    var list_p = contenedor_p.find("p");
    var cantidad = list_p.length;
    var input_id = $(this).parents(".panel").children("input");
    var valor = input_id.val();

    if (dia > cantidad) {
      dia = "";
    }

    if (dia == "") {
      input_id.val(valor+","+id_hotel);
      contenedor_p.append('<p> Dia <span class="dia_inline">'+(cantidad+1)+'</span> :'+hotel+'</p>');
    }else if(dia<=0){
      swal({
        title: 'No se puede continuar ',
        text: "Ingrese un dia valido.",
        type: 'warning'
      });
      input_dia.val("");
      return false;
    }else{

      var array_id = valor.split(",");
      for (var i = 0; i < array_id.length; i++) {
        if (i == 0) {
          if ((i+1)==dia) {
            var dato_id = id_hotel;
            dato_id += ","+array_id[i];
          }else {
            var dato_id = array_id[i];
          }
        }else {
          if ((i+1)==dia) {
            dato_id += ","+id_hotel;
            dato_id += ","+array_id[i];
          }else {
            dato_id += ","+array_id[i];
          }
        }
      }
      input_id.val(dato_id);

      var list_p_dia = contenedor_p.find("p .dia_inline");
      var html_p_inline = '<p>Dia <span class="dia_inline">'+dia+'</span> :'+hotel+'</p>';

      for (var i = cantidad; i > 0; i--) {
        var dia_inline = list_p_dia[i-1];
        var valor_dia = dia_inline.innerHTML;
        dia_inline.innerHTML = parseInt(valor_dia)+1;
        if(valor_dia==dia){
          $(dia_inline).parents("p").before(html_p_inline);
          break;
        }
      }
    }
    swal({
      title: 'Listo!',
      text: "Se ingreso el dia correctamente.",
      type: 'success',
      onClose: function(){
        input_dia.val("");
      }
    });
  });

  $(".eliminar_opcion_inline").click(function(event) {
    var input_dia = $(this).parents(".input-group").children(".index_dia_inline");
    var dia = input_dia.val();
    var contenedor_p = $(this).parents(".panel").find(".panel-body");
    var list_p = contenedor_p.find("p");
    var cantidad = list_p.length;
    var input_id = $(this).parents(".panel").children("input");
    var valor = input_id.val();

    if (dia == "") {
      swal({
        title: 'No puede continuar ',
        text: "Debe ingresar el dia a eliminar.",
        type: 'warning'
      });
    }
    else if(dia > cantidad || dia<=0){
      swal({
        title: 'No se puede continuar ',
        text: "Ingrese un dia valido.",
        type: 'warning'
      });
      input_dia.val("");
    }else{
      var bl_estado =false;
      var array_id = valor.split(",");
      for (var i = 0; i < array_id.length; i++) {
        if (i == 0) {
          if ((i+1)==dia) {
            bl_estado = true;
          }else {
            var dato_id = array_id[i];
          }
        }else {
          if (bl_estado) {
              var dato_id = array_id[i];
              bl_estado=false;
          }else {
            if ((i+1)!=dia) {
              dato_id += ","+array_id[i];
            }
          }
        }
      }
      input_id.val(dato_id);

      var list_p_dia = contenedor_p.find("p .dia_inline");

      for (var i = cantidad; i > 0; i--) {
        var dia_inline = list_p_dia[i-1];
        var valor_dia = dia_inline.innerHTML;

        if(valor_dia==dia){
          $(dia_inline).parents("p").remove();
          break;
        }
        dia_inline.innerHTML = parseInt(valor_dia)-1;
      }
      swal({
        title: 'Listo!',
        text: "Se elimino el dia correctamente.",
        type: 'success',
        onClose: function(){
          input_dia.val("");
        }
      });
    }
  });

  $('#add_inclusion').click(function(){
    var nombre_v = $("#nombre_inclusion").val();
    nombre = nombre_v.replace(/\n/g, "<br />");
    var tipo = $("#inclusiones").val();
    if (tipo == 0) {
      swal('No puede continuar ', 'El campo search de servicios debe estar vacio.');
      return;
    }
    if (tipo == 1) {
      if ($("#incluye").find("#vacio").length > 0) {
        $("#incluye").find("#vacio").remove();
      }
      $("#incluye").append('<li class="list-group-item list-group-item-success">'+nombre+'<input type="hidden" name="incluye[]" value="'+nombre+'"><button type="button" class="close eliminar_inclusiones" onclick="javascript:eliminar_inclusiones(this)" aria-label="Close"><span aria-hidden="true">&times;</span></button></li>');
    }else {
      if ($("#excluye").find("#vacio").length > 0) {
        $("#excluye").find("#vacio").remove();
      }
      $("#excluye").append('<li class="list-group-item list-group-item-danger">'+nombre+'<input type="hidden" name="excluye[]" value="'+nombre+'"><button type="button" class="close eliminar_inclusiones" onclick="javascript:eliminar_inclusiones(this)" aria-label="Close"><span aria-hidden="true">&times;</span></button></li>');
    }
    $("#nombre_inclusion").val('');
  });

  $('#wizardPaquete').bootstrapWizard({
    tabClass: 'nav nav-pills',
    nextSelector: '.btn-next',
    previousSelector: '.btn-back',
    onNext: function(tab, navigation, index) {
      var $valid = $('#wizardForm').valid();
      if(!$valid) {
        $validator.focusInvalid();
        return false;
      }
      if (index==3) {
        var dias = $(".card-dia").val();
          $.ajax({
            type : "POST",
            url :"ajax2.php",
            data: $("#wizardForm").serialize()+"&action=getHotelesOpciones&dias="+dias,
            beforeSend: function(){
            },
            success: function(datos){
              $("#opciones_hoteles").html(datos);
              var html_boton = '<div class="row">'+
                                  '<div class="col-xs-6 col-sm-6 col-md-6 text-left">'+
                                    '<a class="btn btn-danger btn-fill" style="cursor: pointer;" onclick="clearHotelOpcion()">&nbsp;&nbsp;&nbsp;&nbsp;limpiar opciones&nbsp;&nbsp;&nbsp;&nbsp;</a>'+
                                  '</div>'+
                                  '<div class="col-xs-6 col-sm-6 col-md-6 text-right">'+
                                    '<a class="btn btn-success btn-fill" style="cursor: pointer;" onclick="addHotelOpcion()">&nbsp;&nbsp;&nbsp;&nbsp;Agregar opción&nbsp;&nbsp;&nbsp;&nbsp;</a>'+
                                  '</div>'+
                                '</div>';
              $("#opciones_hoteles").append(html_boton);
              var dias = $(".card-dia").val();
              var cantidad_opciones = $("#lista_opciones_hoteles").find(".panel-default").first().find("p").length;
              if (dias != cantidad_opciones && cantidad_opciones != 0) {
                var html_text = '<div class="alert btn-warning alert-dismissable">'+
                                                '<strong>Informe! Se cambio la cantidad de dias en este paquete por favor vueva a registrar las opciones para hoteles. Presione el boton "limpiar opciones" </strong>'+
                                              '</div>';
                $("#tab4").append(html_text);
              }
              $('.select_hoteles').multiselect({
                enableFiltering: true
              });
            }
          });
      }

      if (index == 2) {
        var datos =$(".dataTables_filter").find("input");
        for (var i = 0; i < datos.length; i++) {
          if ($(datos[i]).val() != '') {
            // swal('No puede continuar ', 'El campo search de servicios debe estar vacio.');
            swal({
              title: 'No puede continuar ',
              text: "El campo search de servicios debe estar vacio.",
              type: 'warning',
              showCancelButton: false,
              confirmButtonColor: '#3085d6',
              confirmButtonText: 'Ok'
            }).then((result) => {
              $(datos[i]).parents(".panel-collapse").collapse('show');
              $(datos[i]).focus();
              $(datos[i]).animate({ scrollTop: $(datos[i])[0].scrollHeight}, 1000);
            })
            return false;
          };
        }
        var dias = $(".card-dia").val();
        var html_servicio = '<h5 class="text-center">Lista de Servicios seleccionados por dia.</h5>'+
        '<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">';
        for (var i = 0; i < dias; i++) {
          html_servicio +='<div class="panel panel-default" style="border: 1px;border-color: #0003;border-style: solid">'+
                            '<div class="panel-heading" role="tab" id="heading_s'+i+'">'+
                              '<h4 class="panel-title">'+
                                '<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse_s'+i+'" aria-expanded="false" aria-controls="collapse_s'+i+'">'+
                                  '<h4 class="card-title">Lista de Servicios -> Dia '+(i+1)+"</h4>"+
                                '</a>'+
                              '</h4>'+
                            '</div>'+
                            '<div id="collapse_s'+i+'" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading_s'+i+'">'+
                              '<div class="panel-body">'+
                              '<table id="lista_servicios_'+i+'" class="display" width="100%" cellspacing="0">'+
                              '<thead>'+
                                '<tr>'+
                                    '<th>Nombre</th>'+
                                    '<th>Departamento</th>'+
                                    '<th>Tipo Servicio</th>'+
                                    '<th>Alcance</th>'+
                                    '<th>Precio</th>'+
                                '</tr>'+
                              '</thead>'+
                              '<tbody>';
          var dia = $(".card-"+(i+1));
          var servicios = dia.find(".table_servicio").find(".selected");
          for (var k = 0; k < servicios.length; k++) {
            var nombre = $(servicios[k]).find("td")[0].innerHTML;
            var departamento = $(servicios[k]).find("td")[1].innerHTML;
            var tipo_servicio = $(servicios[k]).find("td")[2].innerHTML;
            var alcance = $(servicios[k]).find("td")[3].innerHTML;
            var precio = $(servicios[k]).find("td")[4].innerHTML;
            html_servicio += '<tr>';
            html_servicio += '<td>'+nombre+'</td>';
            html_servicio += '<td>'+departamento+'</td>';
            html_servicio += '<td>'+tipo_servicio+'</td>';
            html_servicio += '<td>'+alcance+'</td>';
            html_servicio += '<td>'+precio+'</td>';
            html_servicio += '</tr>';
          }
          html_servicio += '</tbody></table></div></div></div>';
        }
        html_servicio += '</div>';
        $("#lista_servicios_dia").html(html_servicio);
        for (var i = 0; i < dias; i++) {
          $("#collapse_s"+i).collapse('toggle');
          $('#lista_servicios_'+i).DataTable( {
            "paging":   false,
            "ordering": false,
            "info":     false,
            "searching": false
            } );
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

  $('#wizardEditarPaquete').bootstrapWizard({
    tabClass: 'nav nav-pills',
    nextSelector: '.btn-next',
    previousSelector: '.btn-back',
    onNext: function(tab, navigation, index) {
      var $valid = $('#wizardFormEditarPaquete').valid();
      if(!$valid) {
        $validator.focusInvalid();
        return false;
      }
      if (index == 3) {
        var dias = $(".card-dia").val();
          $.ajax({
            type : "POST",
            url :"ajax2.php",
            data: $("#wizardFormEditarPaquete").serialize()+"&action=getHotelesOpciones&dias="+dias,
            beforeSend: function(){
            },
            success: function(datos){
              $("#opciones_hoteles").html(datos);
              var html_boton = '<div class="row">'+
                                  '<div class="col-xs-6 col-sm-6 col-md-6 text-left">'+
                                    '<a class="btn btn-danger btn-fill" style="cursor: pointer;" onclick="clearHotelOpcion()">&nbsp;&nbsp;&nbsp;&nbsp;limpiar opciones&nbsp;&nbsp;&nbsp;&nbsp;</a>'+
                                  '</div>'+
                                  '<div class="col-xs-6 col-sm-6 col-md-6 text-right">'+
                                    '<a class="btn btn-success btn-fill" style="cursor: pointer;" onclick="addHotelOpcion()">&nbsp;&nbsp;&nbsp;&nbsp;Agregar opción&nbsp;&nbsp;&nbsp;&nbsp;</a>'+
                                  '</div>'+
                                '</div>';
              $("#opciones_hoteles").append(html_boton);
              var dias = $(".card-dia").val();
              var cantidad_opciones = $("#lista_opciones_hoteles").find(".panel-default").first().find("p").length;
              if (dias != cantidad_opciones && cantidad_opciones != 0) {
                var html_text = '<div class="alert btn-warning alert-dismissable">'+
                                                '<strong>Informe! Se cambio la cantidad de dias en este paquete por favor vueva a registrar las opciones para hoteles. Presione el boton "limpiar opciones" </strong>'+
                                              '</div>';
                $("#tab4").append(html_text);
              }
              // $("#opciones_hoteles").append('<span class="text-info"><br>Verificar si los hoteles seleccionados se encuentran disponibles</span>');
              $('.select_hoteles').multiselect({
                enableFiltering: true
              });
            }
          });
      }
      if (index == 2) {
        var datos =$(".dataTables_filter").find("input");
        for (var i = 0; i < datos.length; i++) {
          if ($(datos[i]).val() != '') {
            // swal('No puede continuar ', 'El campo search de servicios debe estar vacio.');
            swal({
              title: 'No puede continuar ',
              text: "El campo search de servicios debe estar vacio.",
              type: 'warning',
              showCancelButton: false,
              confirmButtonColor: '#3085d6',
              confirmButtonText: 'Ok'
            }).then((result) => {
              $(datos[i]).parents(".panel-collapse").collapse('show');
              $(datos[i]).focus();
              $(datos[i]).animate({ scrollTop: $(datos[i])[0].scrollHeight}, 1000);
            })
            return false;
          };
        }
        var dias = $(".card-dia").val();
        var html_servicio = '<h5 class="text-center">Lista de Servicios seleccionados por dia.</h5>'+
        '<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">';
        for (var i = 0; i < dias; i++) {
          html_servicio +='<div class="panel panel-default" style="border: 1px;border-color: #0003;border-style: solid">'+
                            '<div class="panel-heading" role="tab" id="heading_s'+i+'">'+
                              '<h4 class="panel-title">'+
                                '<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse_s'+i+'" aria-expanded="false" aria-controls="collapse_s'+i+'">'+
                                  '<h4 class="card-title">Lista de Servicios -> Dia '+(i+1)+"</h4>"+
                                '</a>'+
                              '</h4>'+
                            '</div>'+
                            '<div id="collapse_s'+i+'" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading_s'+i+'">'+
                              '<div class="panel-body">'+
                              '<table id="lista_servicios_'+i+'" class="display" width="100%" cellspacing="0">'+
                              '<thead>'+
                                '<tr>'+
                                    '<th>Nombre</th>'+
                                    '<th>Departamento</th>'+
                                    '<th>Tipo Servicio</th>'+
                                    '<th>Alcance</th>'+
                                    '<th>Precio</th>'+
                                '</tr>'+
                              '</thead>'+
                              '<tbody>';
          var dia = $(".card-"+(i+1));
          var servicios = dia.find(".table_servicio").find(".selected");
          for (var k = 0; k < servicios.length; k++) {
            var nombre = $(servicios[k]).find("td")[0].innerHTML;
            var departamento = $(servicios[k]).find("td")[1].innerHTML;
            var tipo_servicio = $(servicios[k]).find("td")[2].innerHTML;
            var alcance = $(servicios[k]).find("td")[3].innerHTML;
            var precio = $(servicios[k]).find("td")[4].innerHTML;
            html_servicio += '<tr>';
            html_servicio += '<td>'+nombre+'</td>';
            html_servicio += '<td>'+departamento+'</td>';
            html_servicio += '<td>'+tipo_servicio+'</td>';
            html_servicio += '<td>'+alcance+'</td>';
            html_servicio += '<td>'+precio+'</td>';
            html_servicio += '</tr>';
          }
          html_servicio += '</tbody></table></div></div></div>';
        }
        html_servicio += '</div>';
        $("#lista_servicios_dia").html(html_servicio);
        for (var i = 0; i < dias; i++) {
          $("#collapse_s"+i).collapse('toggle');
          $('#lista_servicios_'+i).DataTable( {
            "paging":   false,
            "ordering": false,
            "info":     false,
            "searching": false
            } );
        }
      }

      if (index == 1) {
        var dias = $(".card-dia").val();
        for (var i = 0; i < dias; i++) {
          $("#collapse"+(i+1)).collapse('toggle');
        }
      }

      $(".panel-default .text-danger").hide();
      $(".panel-default .text-danger").last().show();

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


  window.operateEvents = {
    'click .copy': function (e, value, row, index) {
      info = JSON.stringify(row);

      swal({
        title: '¿Estas seguro?',
        text: "Se realizará una copia de este paquete",
        type: 'info',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, Copiar!',
        cancelButtonText: 'No, Cancelar!',
        confirmButtonClass: 'btn btn-success',
        cancelButtonClass: 'btn btn-danger',
        allowOutsideClick: false,
        allowEscapeKey: false,
        buttonsStyling: false
      }).then((result) => {
          $.ajax({
            type: "POST",
            url: "ajax2.php",
            data: "&action=paqueteCopy&id="+row.id,
            beforeSend: function(){
              $("#loader").show();
            },
            success: function(datos){
              $("#loader").hide();
              swal(
                'Listo!',
                'El programa fué copiado.',
                'success'
              ).then(function (email) {
                location.href="paquetes.php";
              })
            }
          });
      })
    },
    'click .view': function (e, value, row, index) {
      info = JSON.stringify(row);
      // location.href="paquetes.php?action=edit&id="+row.id;

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
          location.href="pdf.php?id="+row.id+"&tipo="+dato;
        }
      })

      $(".tipo_documento").selectpicker();



    },
    'click .edit': function (e, value, row, index) {
      info = JSON.stringify(row);
      location.href="paquetes.php?action=edit&id="+row.id;
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
          data: "&action=borrarPaquete&id="+row.id,
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
        $tablePaquete.bootstrapTable('remove', {
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

  $tablePaquete.bootstrapTable({
    toolbar: ".toolbar",
    clickToSelect: true,
    showRefresh: true,
    search: true,
    showToggle: true,
    showColumns: true,
    showAddButtonPaquete: true,
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
  activar=1;
  $(".btn-next-add").click(function(e){
    if (activar=='1') {
      addServicioPaquete(activar,'');
      window.setTimeout("crear_table()",2000);
    }
    activar++;
  })

});

//INICIO AGREGAR DIAS Y SERVICIOS
numeroDia=1;
function addServicioPaquete(dia,id){
  $.ajax({
    type : "POST",
    url :"ajax2.php",
    data: $("#wizardForm").serialize()+"&action=agregarServicioPaquete&dia="+dia+"&id="+id,
    beforeSend: function(){
      // swal({
      //   title: 'Un momento',
      //   text: 'Estamos generando la vista.',
      //   imageUrl: 'http://develowebapps.com/proyectos/d5/rasgos/aplication/webroot/imgs/admin/loading.gif',
      //   imageWidth: 300,
      //   imageHeight: 200,
      //   imageAlt: 'Cargando',
      //   animation: false
      // })
    },
    success: function(datos){
      //alert(datos);
      $(".card-"+dia+" .contenedor-servicios-apend-container").html(datos);
      // $(".selectpicker").selectpicker();
    }
  });
}

function addDiaServicioPaquete(dia,id){
  $.ajax({
    type : "POST",
    url :"ajax2.php",
    data: $("#wizardForm").serialize()+"&action=agregarDiaPaquete&dia="+dia+"&id="+id,
    beforeSend: function(){
    },
    success: function(datos){
      $(".panel-group").append(datos);
      var dia_v = dia-1;
          var table_s = $('#table_edit_s_'+dia_v).DataTable({
            "paging":   false
          });
        $('#table_edit_s_'+dia_v+' tbody').on( 'click', 'tr', function () {
          $(this).toggleClass('selected');
        } );

        $('#button').click( function () {
          alert( table_s.rows('.selected').data().length +' row(s) selected' );
        } );

      if(id.length == 0){
        $(".card-dia").val(dia);
      }
      $(".panel-default .text-danger").hide();
      $(".panel-default .text-danger").last().show();
    }
  });
}
function addHotelOpcion(){
  var selected = $(".select_hoteles option:selected");
  var html = '<div class="panel panel-default"><button type="button" class="close eliminar_opciones_hoteles" onclick="javascript:eliminar_opciones_hoteles(this)" aria-label="Close"><span aria-hidden="true">×</span></button><div class="panel-body">';
  var ids='';
  for (var i = 0; i < selected.length; i++) {
    var id = $(selected[i]).val();
    if (i == 0) {
      ids += id;
    }else {
      ids += ","+id;
    }
    var valor = $(selected[i]).html();
    html +='<p>Dia '+(i+1)+':'+valor+'</p>';
  }
  html +='<input type="hidden" name="opciones_hoteles[]" value="'+ids+'">';
  $("#lista_opciones_hoteles").append(html);
  swal({
    title: 'Hoteles registrados',
    type: 'success',
    confirmButtonText: 'Ok!',
    allowOutsideClick: false,
    allowEscapeKey: false,
  })
}

  function  clearHotelOpcion(){
    swal({
      text: 'Lista de Opcion de Hoteles Limpia',
      type: 'success',
      confirmButtonText: 'Ok!',
      allowOutsideClick: false,
      allowEscapeKey: false,
      onClose: function(){
        $("#lista_opciones_hoteles").html("");
        $(".alert").remove();
      }
    })
  }

function addPaquete(){
  location.href="paquetes.php?action=add";
}
function addOneMoreDay() {
  var dia = $(".card-dia").val();
  var diatem = parseInt(dia)+1;
  $(".card-dia").val(diatem);
  addDiaServicioPaquete(diatem,'');
}
function addOneMoreDayEdit(id) {
  var dia = $(".card-dia").val();
  var diatem = parseInt(dia)+1;
  $(".card-dia").val(diatem);
  addDiaServicioPaquete(diatem,id);
}
function addOneMoreService(dia,id){
  var listaservicio = $(".card-"+dia+" .listaservicio-"+dia).val();
  var listaserviciotem = parseInt(listaservicio)+1;
  $(".card-"+dia+" .listaservicio-"+dia).val(listaserviciotem);
  addServicioPaquete(dia,id);
}
function eliminarPaquete(dia,id) {
  $(".card-"+dia).parents(".panel-default").remove();
  var dias = parseInt($(".card-dia").val());
  $(".card-dia").val(dias-1);
  $(".panel-default .text-danger").hide();
  $(".panel-default .text-danger").last().show();
}
$("#wizardForm").submit(function(e) { //AGREGAR UN PAQUETE
  e.preventDefault();
  var $form = $(this);
  if(! $form.valid()) return false;
  var formData = new FormData($("#wizardForm")[0]);

  var dias = $(".card-dia").val();

  for (var i = 0; i < dias; i++) {
    var dia = $(".card-"+(i+1));
    var servicios = dia.find(".table_servicio").find(".selected .id");
    for (var k = 0; k < servicios.length; k++) {
      formData.append('dias['+i+'][1]['+k+']', servicios[k].innerHTML);
    }
  }

  var ruta = "ajax2.php";
  //alert(formData);
  $.ajax({
    url: ruta,
    type: "POST",
    data: formData,
    contentType: false,
    processData: false,
    beforeSend: function(){
      $("#loader").show();
    },
    success: function(datos){
      $("#loader").hide();
      swal({
        title: 'Registrado!',
        text: datos,
        type: 'success',
        confirmButtonText: 'Ok!',
        allowOutsideClick: false,
        allowEscapeKey: false,
        onClose: function(){
          location.href="paquetes.php";
        }
      })
    }
  });
  return false;
});
$("#wizardFormEditarPaquete").submit(function(e) {
  e.preventDefault();

  var $form = $(this);

  if(! $form.valid()) return false;

  var formData = new FormData($("#wizardFormEditarPaquete")[0]);

  var dias = $(".card-dia").val();

  for (var i = 0; i < dias; i++) {
    var dia = $(".card-"+(i+1));
    var servicios = dia.find(".table_servicio").find(".selected .id");
    for (var k = 0; k < servicios.length; k++) {
      formData.append('dias['+i+'][1]['+k+']', servicios[k].innerHTML);
    }
  }

  var ruta = "ajax2.php";
  //alert('envio a ajax2');

  $.ajax({
    url: ruta,
    type: "POST",
    data: formData,
    contentType: false,
    processData: false,
    beforeSend: function(){
      $("#loader").show();
    },
    success: function(datos){
      $("#loader").hide();
      swal({
        title: 'Actualizado!',
        text: datos,
        type: 'success',
        confirmButtonText: 'Ok!',
        allowOutsideClick: false,
        allowEscapeKey: false,
        onClose: function(){
          location.href="paquetes.php";
        }
      })

    }
  });
  return false;
});

$("#wizardFormEditarPaquete__").submit(function(e) {
  e.preventDefault();

  var $form = $(this);

  if(! $form.valid()) return false;

  var formData = new FormData($("#wizardFormEditarPaquete")[0]);
  var ruta = "ajax2.php";

  // alert(formData);

  $.ajax({
    url: ruta,
    type: "POST",
    data: formData,
    contentType: false,
    processData: false,
    success: function(datos){
      //alert(datos);
      swal({
        title: 'Registrado!',
        text: datos,
        type: 'success',
        confirmButtonText: 'Ok!',
        allowOutsideClick: false,
        allowEscapeKey: false,
        onClose: function(){
          location.href="paquetes.php";
        }
      })
    }
  });
  return false;
});
function onFinishWizardPaquetes(){
  //CUANDO FINALIZA EL FORM WIZARD GUARDAMOS LOS DATOS Y MOSTRAMOS ALERTA
  $.ajax({
    type : "GET",
    url :"ajax.php",
    data: $("#wizardFormEditarPaquete").serialize()+"&action=actualizarPaquete&ja=a",
    beforeSend: function(){
    },
    success: function(datos){
      // alert(datos);
      swal({
        title: 'Listo!',
        text: 'El Paquete fué registrado con éxito',
        type: 'success',
        allowOutsideClick: false,
        allowEscapeKey: false
      }).then(function (email) {
        location.href="paquetes.php";
      })
    }
  });
}
//FIN AGREGAR DIAS Y SERVICIOS


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
if ($("#files").length > 0) {
    document.getElementById('files').addEventListener('change', archivo, false);
}
