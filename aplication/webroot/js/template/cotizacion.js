  /*SERVICIO*/
var $tableCotizacion = $('#bootstrap-table-cotizaciones');
var tr_global;

function operateFormatter(value, row, index) {
  return [
    '<div class="table-icons">',
    '<a rel="tooltip" title="Cotizar" class="btn btn-simple btn-success btn-icon table-action cotizar" href="javascript:void(0)">',
    '<i class="ti-money"></i>',
    '</a>',
    '<a rel="tooltip" title="View" class="btn btn-simple btn-info btn-icon table-action view" href="javascript:void(0)">',
    '<i class="ti-image"></i>',
    '</a>',
    // '<a rel="tooltip" title="Edit" class="btn btn-simple btn-warning btn-icon table-action edit" href="javascript:void(0)">',
    // '<i class="ti-pencil-alt"></i>',
    // '</a>',
    '<a rel="tooltip" title="Eliminar" class="btn btn-simple btn-danger btn-icon table-action remove" href="javascript:void(0)">',
    '<i class="ti-close"></i>',
    '</a>',
    '</div>',
  ].join('');
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

function cargar_listas(){
  if ($('#list_paquetes').length > 0) {
    $('#list_paquetes').multiselect({
      enableFiltering: true,
    });
    $('#list_paquetes').multiselect('disable');

    $('#list_paquetes').change(function(event) {
      var id = $(this).val();
      if (id != 0) {
        $.ajax({
          url: 'ajax.php',
          type: 'GET',
          data: '&action=obtenerPaqueteCotizacion&id='+id,
          dataType : 'json',
          beforeSend: function(){
          },
          success: function(datos){

            $("#nombre").val(datos.nombre);
            $("#descripcion").val(datos.descripcion);
            $($('.selectpicker')[0]).selectpicker('val',datos.departamentos);
            if (datos.imagen) {
              $("#list").html('<img class="thumb" src="../aplication/webroot/imgs/'+datos.imagen+'" alt="">');
            }else {
              $("#list").html("");
            }

            $("#accordion").html("");

            for (var i = 0; i < datos.itinerario.length; i++) {
              var for_itinerario = datos.itinerario[i];
              var html =
                '<div class="panel panel-default" style="border: 1px;border-color: #0003;border-style: solid;background-color:white">'+
                  '<div class="panel-heading" style="background-color:white" role="tab" id="heading'+for_itinerario["dia"]+'">'+
                		'<h4 class="panel-title">'+
                			'<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse'+for_itinerario["dia"]+'" aria-expanded="false" aria-controls="collapseOne"> '+
                				'<h4 class="card-title">Día '+for_itinerario["dia"];
                          if (for_itinerario["dia"]!=1) {
                            html +='<span><a class="text-danger" onclick="eliminarPaquete('+for_itinerario["dia"]+',);" style=""><i class="fa fa-trash-o"></i></a></span>';
                          };
                html += '</h4>'+
                			'</a>'+
                		'</h4>'+
                	'</div>'+
                	'<div id="collapse'+for_itinerario["dia"]+'" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading'+for_itinerario["dia"]+'">'+
                		'<div class="panel-body">'+
                			'<div class="card card-'+for_itinerario["dia"]+'">'+
                				'<input type="hidden" class="listaservicio-1" value="1"/>'+
                				'<input type="hidden" class="listahoteles-1" value="1"/>'+
                				'<div class="card-content">'+
                					'<div class="row">'+
                						'<div class="col-md-12">'+
                							'<div class="form-group">'+
                								'<label class="control-label">Nombre</label>'+
                								'<input class="form-control" type="text" name="nombreDia['+(for_itinerario["dia"]-1)+']" placeholder="Nombre para Identificar el Día" value="'+for_itinerario["nombre"]+'"/>'+
                							'</div>'+
                						'</div>'+
                					'</div>'+
                					'<div class="row">'+
                						'<div class="col-md-12">'+
                							'<div class="form-group">'+
                								'<label class="control-label">Itinerario</label>'+
                								'<textarea class="form-control" name="descripcion['+(for_itinerario["dia"]-1)+']" rows="5" cols="5">'+for_itinerario["descripcion"]+'</textarea>'+
                							'</div>'+
                						'</div>'+
                					'</div>'+
                          '<div class="contenedor-hoteles-apend-container">'+
                          '</div>'+
                          '<div class="contenedor-servicios-apend-container">'+
                          '</div>'+
                				'</div>'+
                			'</div>'+
                		'</div>'+
                  '</div>'+
              	'</div>';
                $("#accordion").append(html);
                addServicioPaquete(for_itinerario["dia"],'',for_itinerario["id"]);
                addHotelPaquete(for_itinerario["dia"],'');

            }

            window.setTimeout("crear_table()",1000);

            if (datos.inclusiones) {
              $("#incluye").html("");
              for (var i = 0; i < datos.inclusiones.length; i++) {
                var for_inclusiones = datos.inclusiones[i]
                var html = '<li class="list-group-item list-group-item-success">'+for_inclusiones+'<input name="incluye[]" value="'+for_inclusiones+'" type="hidden"><button type="button" class="close" onclick="javascript:eliminar_inclusiones(this)" aria-label="Close"><span aria-hidden="true">×</span></button></li>';
                $("#incluye").append(html);
              }
            }
            if (datos.exclusiones) {
              $("#excluye").html("");
              var html = '<li class="list-group-item list-group-item-danger">'+for_inclusiones+'<input name="excluye[]" value="'+for_inclusiones+'" type="hidden"><button type="button" class="close" onclick="javascript:eliminar_inclusiones(this)" aria-label="Close"><span aria-hidden="true">×</span></button></li>';
              $("#excluye").append(html);
            }
            $(".card-dia").val(datos.itinerario.length);
            $("#editarpaquete").val('1');
          }
        });
      }
    });
  }

  if ($('#list_clientes').length > 0) {
    $('#list_agencias').multiselect({
      enableFiltering: true
    });
  }

  if ($('#list_clientes').length > 0) {
    $('#list_clientes').multiselect({
      enableFiltering: true
    });

    $('#list_clientes').change(function(event) {
      var id = $(this).val();
      if (id != 0) {
        $.ajax({
          url: 'ajax.php',
          type: 'GET',
          dataType : 'json',
          data: '&action=obtenerDatosCliente&id='+id,
          beforeSend: function(){
          },
          success: function(datos){
            $("#ajax_Documento").val(datos.documento);
            $("#ajax_Telefono").val(datos.telefono);
            $("#ajax_Email").val(datos.email);
            if (datos.sexo == 0) {
              $("#ajax_Sexo").val("Masculino");
            }else{
              $("#ajax_Sexo").val("Femenino");
            }
            $('#list_fuentes').multiselect('select', [datos.id_fuente], true);
            if (datos.nacionalidad == 1) {
              $("#ajax_Nacionalidad").val("Nacional");
            }else {
              $("#ajax_Nacionalidad").val("Extranjera");
            }
            $('#list_paquetes').multiselect('enable');
          }
        });
      }
    });
  }

  if ($('#list_fuentes').length > 0) {
    $('#list_fuentes').multiselect({
      enableFiltering: true
    });
  }

  var dias = $(".card-dia").val();

  for (var i = 0; i < dias; i++) {
    $('#list-hotel-'+(i+1)).multiselect({
      enableFiltering: true
    });
  }

}

function agregarCliente(){

  var html =
  '<form id="sweelFormCliente" method="post" novaelidate="" enctype="multipart/form-data">'+
  '<input type="hidden" name="action" value="sweelAgregarCliente"/>'+
  '<div class="form-group">'+
  '<input class="form-control" type="text" name="nombre" placeholder="Nombre"/>'+
  '</div>'+
  '<div class="form-group">'+
  '<input class="form-control" type="text" name="documento" placeholder="Documento"/>'+
  '</div>'+
  '<div class="form-group">'+
  '<input class="form-control" type="number" name="telefono" placeholder="Telefono"/>'+
  '</div>'+
  '<div class="form-group">'+
  '<input class="form-control" type="email" name="email" placeholder="Email"/>'+
  '</div>'+
  '<div class="form-group">'+
  '<select class="form-control" data-style="btn-info btn-fill btn-block" name="sexo">'+
  '<option value="0">Masculino</option>'+
  '<option value="1">Femenino</option>'+
  '</select>'+
  '<div class="form-group">'+
  '<select class="form-control" data-style="btn-info btn-fill btn-block" name="nacionalidad">'+
  '<option value="1">Nacional</option>'+
  '<option value="2">Extranjero</option>'+
  '</select>'+
  '</div>'+
  '<div class="form-group">'+
  '<select class="form-control" data-style="btn-info btn-fill btn-block" name="fuente">'+
  '<option value="1">Radio</option>'+
  '<option value="2">Cliente Referido</option>'+
  '<option value="3">Web Rasgos</option>'+
  '<option value="4">Cliente Antiguo</option>'+
  '<option value="5">Paso por la Sucursal</option>'+
  '<option value="6">E-mailing</option>'+
  '<option value="7">Facebook Rasgos</option>'+
  '<option value="8">Feria</option>'+
  '</select>'+
  '</div>'+
  '</form>';

  swal({
    title: 'Registrar Nuevo Cliente',
    html: html,
    showCancelButton: true,
    confirmButtonText: 'Registrar',
    showLoaderOnConfirm: true,
    preConfirm: () => {
      return new Promise((resolve) => {
        setTimeout(() => {resolve()}, 1000)
      })
    },
    allowOutsideClick: false
  }).then((result) => {

    $.ajax({
      url: 'ajax2.php',
      type: 'POST',
      dataType: 'json',
      data: $("#sweelFormCliente").serialize(),
      beforeSend: function(){
      },
      error: function (error) {
        swal({
          type: 'error',
          title: 'No se registro el cliente!',
          html: 'Ingresar todos los datos solicitados.'
        });
      },
      success: function(datos){
        $("#ajax_Documento").val(datos.documento);
        $("#ajax_Telefono").val(datos.telefono);
        $("#ajax_Email").val(datos.email);
        if (datos.sexo == 0) {
          $("#ajax_Sexo").val("Masculino");
        }else{
          $("#ajax_Sexo").val("Femenino");
        }
        $('#list_fuentes').multiselect('select', [datos.id_fuente], true);
        $('#list_clientes').append('<option value="'+datos.id_cliente+'">'+datos.nombres+'</option>');
        $('#list_clientes').multiselect('rebuild');
        $('#list_clientes').multiselect('select', [datos.id_cliente]);
        swal({
          type: 'success',
          title: 'Excelente!',
          html: 'Cliente registrado correctamente.'
        });
        $('#list_paquetes').multiselect('enable');
      }
    });
  });
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

function habitacion_update(input){
  if ($(input).val() != "" && $(input).val() > 0) {
    $(input).parents('tr').find(".checkbox").prop('checked', true);
  }else {
    $(input).parents('tr').find(".checkbox").prop('checked', false);
    $(input).val('');
    $(input).parents('tr').find("a").css("color","#66615b");
  };
}

function valida_pasajero(element){
  var contenedor = $(element).parents(".panel");
  var Nombres_pasajero = contenedor.find(".Nombres_pasajero").val();
  var Documento_pasajero = contenedor.find(".Documento_pasajero").val();
  var WhatsApp_pasajero = contenedor.find(".WhatsApp_pasajero").val();
  var email_pasajero = contenedor.find(".email_pasajero").val();

  if (contenedor.find(".collapsed").length == 0) {
    if (Nombres_pasajero=="") {

    }
  }

}

function viewpasajero(element,id){
  var tr = $(element).parents("tr");
  tr_global = tr;
  var bl_pasajero = tr.find("#bl_pasajero").val();
  var alcanse = parseInt(tr[0].children[2].innerHTML);
  var html_swel = tr.find(".detalle_pasajeros").html();
  var cantidad = parseInt(tr.find("#cantidad_habitacion").val());
  var tr_cantidad_habitacion = parseInt(tr.find("#bl_cantidad").val());
  var html = '';

  if (bl_pasajero == 1) {
    if (tr_cantidad_habitacion < cantidad) {
      //Se tiene que agregar habitaciones
      var select_pasajeros = tr.find(".detalle_pasajeros");
      var get_html = select_pasajeros.children().first().html();
      for (var i = tr_cantidad_habitacion; i < cantidad; i++) {
        var html_insert = '<div class="list_pasajeros_'+i+'">'+get_html+'</div>';
        html_insert = html_insert.replace("Habitación 1","Habitación "+(i+1));
        // html_insert = html_insert.replace("id_pasajero_hotel[1][36][0]","id_pasajero_hotel[1][36][0]");
        html_swel +=html_insert;
        html = html_swel;
      }
    }
    else if (tr_cantidad_habitacion > cantidad) {
      //Se tiene que quitar habitaciones
      var select_pasajeros = tr.find(".detalle_pasajeros");
      for (var i = tr_cantidad_habitacion; i > cantidad; i--) {
        select_pasajeros.children().last().remove();
      }
      html = select_pasajeros.html();
    }
    else {
      //Se usa las habitaciones ocultas
      html = html_swel;
    }
  }else{
    for (var i = 0; i < cantidad; i++) {
      // html_swel = html_insert.replace("id_pasajero_hotel[1][36][0]","id_pasajero_hotel[1][36][0]");
      var html_alterado = html_swel;
      for (var j = 0; j < alcanse ;j++) {
        html_alterado = html_alterado.replace("[0][]","["+i+"][]");
      }
      html += '<div class="list_pasajeros_'+i+'"><h3>Habitación '+(i+1)+'</h3>'+html_alterado+'</div>';
    }
  }
  swal({
    title: 'Habitación x Pasajero',
    showCancelButton: true,
    confirmButtonText: 'Registrar',
    showLoaderOnConfirm: false,
    allowOutsideClick: false,
    html: html,
    preConfirm: () => {
      var get_html_register = $(".swal2-content").html();
      var cant_habitacion = tr_global.find("#cantidad_habitacion").val();
      tr_global.find(".detalle_pasajeros").html(get_html_register);
      tr_global.find("#bl_pasajero").val(1);
      tr_global.find("#bl_cantidad").val(cant_habitacion);
      tr_global.find("a").css("color","limegreen");
      tr_global = "";
      swal.close();
    },
    onClose: function(){
      var bl_pasajero = tr_global.find("#bl_pasajero").val();
      var cantidad = tr_global.find("#bl_cantidad").val();
      if (bl_pasajero == 1) {
        tr_global.find("#cantidad_habitacion").val(cantidad);
      }
      tr_global = "";
    }
  })
}

function select_simple(element){
  var valor = element.value;
  $(element).find("option").removeAttr('selected');
  $(element).find('option[value="'+valor+'"]').attr("selected",true);
}

$(document).ready(function(){
  crear_table();
  cargar_listas();

  $('#ajax_Fecha').datetimepicker({
    format: 'YYYY-MM-DD'
});

  //1->nacional  2->extranjero

  $('#add_inclusion').click(function(){
    var nombre = $("#nombre_inclusion").val();
    var tipo = $("#inclusiones").val();
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

  $('#wizardCotizacion').bootstrapWizard({
    tabClass: 'nav nav-pills',
    nextSelector: '.btn-next',
    previousSelector: '.btn-back',
    onNext: function(tab, navigation, index) {
      var $valid = $('#wizardFormCotizacion').valid();
      if(!$valid) {
        $validator.focusInvalid();
        return false;
      }
      if (index == 1) {
        var pasajeros = $("#pasajeros").val();
        var lista_pasajeros = $("#lista_pasajeros");
        lista_pasajeros.html("");
        for (var i = 0; i < pasajeros; i++) {
        var html =
          '<div class="panel panel-default" style="border: 1px;border-color: #0003;border-style: solid;">'+
            '<div class="panel-heading" role="tab" id="heading_p'+i+'">'+
              '<h4 class="panel-title" onclick="valida_pasajero(this)">'+
                '<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse_p'+i+'" aria-expanded="false" aria-controls="collapseOne">'+
                  '<h4 class="card-title">Pasajero '+(i+1)+'</h4>'+
                '</a>'+
              '</h4>'+
            '</div>'+
            '<div id="collapse_p'+i+'" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading_p'+i+'">'+
              '<div class="panel-body">'+
                '<input class="form-control pasajero" type="hidden" value="'+i+'"/>'+
                '<div class="card card-p-'+i+'">'+
                  '<div class="card-content">'+
                  	'<div class="row">'+
                  	  '<div class="col-md-6">'+
                    		'<div class="form-group">'+
                    		  '<label class="control-label">Nombres</label>'+
                    		  '<input class="form-control Nombres_pasajero" name="list_pasajeros['+i+'][Nombres]" type="text" placeholder="Nombres" required="required"/>'+
                    		'</div>'+
                  	  '</div>'+
                  	  '<div class="col-md-6">'+
                    		'<div class="form-group">'+
                    		  '<label class="control-label">Documento (DNI/Pasaporte)</label>'+
                    		  '<input class="form-control Documento_pasajero" name="list_pasajeros['+i+'][Documento]" type="text" placeholder="Documento (DNI/Pasaporte)" required="required"/>'+
                    		'</div>'+
                  	  '</div>'+
                  	  '<div class="col-md-6">'+
                    		'<div class="form-group">'+
                    		  '<label class="control-label">WhatsApp</label>'+
                    		  '<input class="form-control WhatsApp_pasajero" name="list_pasajeros['+i+'][WhatsApp]" type="text" placeholder="WhatsApp" required="required"/>'+
                    		'</div>'+
                  	  '</div>'+
                      '<div class="col-md-6">'+
                        '<div class="form-group">'+
                          '<label class="control-label">Sexo</label>'+
                          '<select class="tipo_nacionalidad" name="list_pasajeros['+i+'][sexo]">'+
                            '<option value="0">Masculino</option>'+
                            '<option value="1">Femenino</option>'+
                          '</select>'+
                        '</div>'+
                      '</div>'+
                      '<div class="col-md-6 col-md-offset-3">'+
                        '<div class="form-group">'+
                          '<label class="control-label">Nacionalidad</label>'+
                          '<select class="tipo_nacionalidad" name="list_pasajeros['+i+'][nacionalidad]">'+
                            '<option value="0">Nacional</option>'+
                            '<option value="1">Extranjero</option>'+
                          '</select>'+
                        '</div>'+
                      '</div>'+
                  	'</div>'+
                  '</div>'+
                '</div>'+
              '</div>'+
            '</div>'+
          '</div>';
          lista_pasajeros.append(html);
          $(".tipo_nacionalidad").selectpicker();
          $("#collapse_p"+(i)).collapse('toggle');
          }
      }

      // if (index == 1 && $("#editarpaquete").val() == '1') {
      //   var dias = $(".card-dia").val();
      //   for (var i = 0; i < dias; i++) {
      //     $("#collapse"+(i+1)).collapse('toggle');
      //   }
      // }
      // if (index == 1 && $("#editarpaquete").val() != '1') {
      //   addServicioPaquete(1,'');
      //   addHotelPaquete(1,'');
      //   window.setTimeout("crear_table()",1000);
      // }
      if (index == 3) {
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
                                    '<th>Precio Nacional</th>'+
                                    '<th>Precio Extranjero</th>'+
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
            var precio_n = $(servicios[k]).find("td")[4].innerHTML;
            var precio_e = $(servicios[k]).find("td")[5].innerHTML;
            html_servicio += '<tr>';
            html_servicio += '<td>'+nombre+'</td>';
            html_servicio += '<td>'+departamento+'</td>';
            html_servicio += '<td>'+tipo_servicio+'</td>';
            html_servicio += '<td>'+alcance+'</td>';
            html_servicio += '<td>'+precio_n+'</td>';
            html_servicio += '<td>'+precio_e+'</td>';
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
      $('.navbar-default').get(0).scrollIntoView();
    }
  });

  $('#wizardEditarCotizacion').bootstrapWizard({
    tabClass: 'nav nav-pills',
    nextSelector: '.btn-next',
    previousSelector: '.btn-back',
    onNext: function(tab, navigation, index) {
      var $valid = $('#wizardFormEditarCotizacion').valid();
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
          location.href="pdf_cotizacion.php?id="+row.id+"&tipo="+dato;
        }
      })

      $(".tipo_documento").selectpicker();

    },
    'click .edit': function (e, value, row, index) {
      info = JSON.stringify(row);
      location.href="cotizaciones.php?action=edit&id="+row.id;
    },
    'click .cotizar': function (e, value, row, index) {
      if ($($(this).parents("tr").children("td")[8]).html() == "Vendido") {
        swal('Lo sentimos', 'Esta cotizacion ya fue Vendida');
      }else {

        var html = '<form id="form_vender_cotizacion" action="index.html" method="post">'+
                      '<div class="row">'+
                        '<input hidden name="id" type="text" value="'+row.id+'" />'+
                        '<input hidden name="action" type="text" value="VenderCotizacion" />'+
                        '<div class="col-md-10 col-md-offset-1">'+
                          '<div class="form-group">'+
                            '<label class="control-label">Forma de Pago</label>'+
                            '<select id="list_forma_pago" name="id_tipo_pago">'+
                              '<option value="0">Pago Efectivo</option>'+
                              '<option value="1">Pago Tarjeta 5%</option>'+
                              '<option value="2">Pago tarjeta 7%</option>'+
                            '</select>'+
                          '</div>'+
                        '</div>'+
                        '<div class="col-md-12">'+
                          '<div class="form-group">'+
                            '<label class="control-label">Observaciones</label>'+
                            '<textarea style="max-width: 100%;" name="observacion" class="form-control" rows="5"></textarea>'+
                          '</div>'+
                        '</div>'+
                      '</div>'+
                    '</form>';

        swal({
            title: 'Vender Cotizacion',
            html: html,
            showCancelButton: true,
            confirmButtonText: 'Vender',
            showLoaderOnConfirm: false,
            allowOutsideClick: false,
            preConfirm: () => {
              var formData = new FormData($("#form_vender_cotizacion")[0]);
              $.ajax({
                url: 'ajax2.php',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(datos){
                  alert(datos);
                  swal({
                    title: 'Vendido!',
                    text: "Cotizacion Vendida",
                    type: 'success',
                    confirmButtonText: 'Ok!',
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    onClose: function(){
                      location.href="cotizaciones.php";
                    }
                  })
                }
              });
              swal.close();
            }
          });
          $("#list_forma_pago").selectpicker();
      }
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
          data: "&action=borrarCotizacion&id="+row.id,
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
        $tableCotizacion.bootstrapTable('remove', {
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

  $tableCotizacion.bootstrapTable({
    toolbar: ".toolbar",
    clickToSelect: true,
    showRefresh: true,
    search: true,
    showToggle: true,
    showColumns: true,
    showAddButtonCotizacion: true,
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
    $tableCotizacion.bootstrapTable('resetView');
  });

});

//INICIO AGREGAR DIAS Y SERVICIOS
function addHabitaciones(dia,item,id){
  var panel_pasajeros = $("#lista_pasajeros").find(".panel-body");

  var pasajeros = [];

  for (var i = 0; i < panel_pasajeros.length; i++) {
    var id_pasajero = $(panel_pasajeros[i]).find(".pasajero").val();
    var nombre = $(panel_pasajeros[i]).find(".Nombres_pasajero").val();
    var documento = $(panel_pasajeros[i]).find(".Documento_pasajero").val();
    pasajeros[id_pasajero] = nombre;
  }

  $.ajax({
    type : "POST",
    url :"ajax2.php",
    data: "&action=agregarHabitaciones&dia="+dia+"&id="+id+"&item="+item+"&pasajero="+pasajeros,
    beforeSend: function(){
    },
    success: function(datos){
      //alert(datos);
      $(".select-container-"+dia).html('');
      $(".select-container-"+dia).append(datos);
    }
  });
}

numeroDia=1;
function addServicioPaquete(dia,id,id_itinerario){
  $.ajax({
    type : "POST",
    url :"ajax2.php",
    data: $("#wizardFormCotizacion").serialize()+"&action=agregarServicioCotizacion&dia="+dia+"&id="+id+"&id_itinerario="+id_itinerario,
    beforeSend: function(){
    },
    success: function(datos){
      //alert(datos);
      $(".card-"+dia+" .contenedor-servicios-apend-container").html(datos);
    }
  });
}
function addHotelPaquete(dia,id){

  var listahotel = $(".card-"+dia+" .listahoteles-"+dia).val();
  //alert(listahotel);
  var listahoteltem = parseInt(listahotel)+1;
  $(".card-"+dia+" .listahoteles-"+dia).val(listahoteltem);

  $.ajax({
    type : "POST",
    url :"ajax2.php",
    data: $("#wizardFormCotizacion").serialize()+"&action=agregarHotelCotizacion&dia="+dia+"&id="+id+"&itemhotel="+listahotel,
    beforeSend: function(){
    },
    success: function(datos){
      $(".card-"+dia+" .contenedor-hoteles-apend-container").html(datos);
      $("#list-hotel-"+dia).multiselect({
        enableFiltering: true
      });
    }
  });
}
function addDiaServicioPaquete(dia,id){
  $.ajax({
    type : "POST",
    url :"ajax2.php",
    data: $("#wizardFormCotizacion").serialize()+"&action=agregarDiaCotizacion&dia="+dia+"&id="+id+"&="+id,
    beforeSend: function(){
    },
    success: function(datos){
      $(".contenedor-card-apend-container .panel-group").append(datos);

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

        $('#list-hotel-'+dia).multiselect({
          enableFiltering: true
        });
    }
  });
}
function addCotizacion(){
  location.href="cotizaciones.php?action=add";
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
function addOneMoreHotel(dia,id){
  //var listahotel = $(".card-"+dia+" .listahotel-"+dia).val();
  //var listahoteltem = parseInt(listahotel)+1;
  //$(".card-"+dia+" .listahotel-"+dia).val(listahoteltem);
  addHotelPaquete(dia,id);
}
function eliminarPaquete(dia,id) {
  var dia_maximo = $(".card-dia").val();
  if (dia == dia_maximo) {
    $(".card-"+dia).parents(".panel-default").remove();
    var dias = parseInt($(".card-dia").val());
    $(".card-dia").val(dias-1);
  }else {
    swal(
      'No se pudo eliminar el día '+dia,
      'No debe tener dias superiores a el que se desea eliminar',
      'info'
    )
  }
}
$("#wizardFormCotizacion").submit(function(e) { //AGREGAR UN PAQUETE
  e.preventDefault();
  var $form = $(this);
  if(! $form.valid()) return false;
  var formData = new FormData($("#wizardFormCotizacion")[0]);
  var ruta = "ajax2.php";

  var dias = $(".card-dia").val();

  for (var i = 0; i < dias; i++) {
    var dia = $(".card-"+(i+1));
    var servicios = dia.find(".table_servicio").find(".selected");
    for (var k = 0; k < servicios.length; k++) {
      formData.append('servicios['+i+']['+k+'][id]', servicios[k].children[6].innerHTML);
      var precio_n = parseFloat(servicios[k].children[4].innerHTML.substr(1));
      var precio_e = parseFloat(servicios[k].children[5].innerHTML.substr(1));
      formData.append('servicios['+i+']['+k+'][precio_n]', precio_n);
      formData.append('servicios['+i+']['+k+'][precio_e]', precio_e);
    }
  }


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
        text: "",
        type: 'success',
        confirmButtonText: 'Ok!',
        allowOutsideClick: false,
        allowEscapeKey: false,
        onClose: function(){
          location.href="cotizaciones.php";
        }
      })
    }
  });
  return false;
});
$("#wizardFormEditarCotizacion").submit(function(e) {
  e.preventDefault();

  var $form = $(this);

  if(! $form.valid()) return false;

  var formData = new FormData($("#wizardFormEditarCotizacion")[0]);
  var ruta = "ajax2.php";

  var dias = $(".card-dia").val();

  for (var i = 0; i < dias; i++) {
    var dia = $(".card-"+(i+1));
    var servicios = dia.find(".table_servicio").find(".selected .id");
    for (var k = 0; k < servicios.length; k++) {
      formData.append('servicios['+i+']['+k+']', servicios[k].innerHTML);
    }
  }

  $.ajax({
    url: ruta,
    type: "POST",
    data: formData,
    contentType: false,
    processData: false,
    success: function(datos){
      swal({
        title: 'Actualizado!',
        text: datos,
        type: 'success',
        confirmButtonText: 'Ok!',
        allowOutsideClick: false,
        allowEscapeKey: false,
        onClose: function(){
          location.href="cotizaciones.php";
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
    data: $("#wizardFormEditarCotizacion").serialize()+"&action=actualizarPaquete",
    beforeSend: function(){
    },
    success: function(datos){
      alert(datos);
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
