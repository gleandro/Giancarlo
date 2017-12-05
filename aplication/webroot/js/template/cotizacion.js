/*SERVICIO*/
var $tableCotizacion = $('#bootstrap-table-cotizaciones');

function operateFormatter(value, row, index) {
  return [
    '<div class="table-icons">',
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
      enableFiltering: true
    });

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
                			'<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse'+for_itinerario["dia"]+'" aria-expanded="false" aria-controls="collapseOne">'+
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
                addServicioPaquete(for_itinerario["dia"],'');
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
            $('#list_fuentes').multiselect('select', [datos.id_fuente], true);
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
      success: function(datos){
        $("#ajax_Documento").val(datos.documento);
        $("#ajax_Telefono").val(datos.telefono);
        $("#ajax_Email").val(datos.email);
        $('#list_fuentes').multiselect('select', [datos.id_fuente], true);
        $('#list_clientes').append('<option value="'+datos.id_cliente+'">'+datos.nombres+'</option>');
        $('#list_clientes').multiselect('rebuild');
        $('#list_clientes').multiselect('select', [datos.id_cliente]);
      }
    });
    swal({
      type: 'success',
      title: 'Ajax request finished!',
      html: 'Submitted email: ' + result
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

$().ready(function(){
  crear_table();
  cargar_listas();

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

      if (index == 1 && $("#editarpaquete").val() == '1') {
        var dias = $(".card-dia").val();
        for (var i = 0; i < dias; i++) {
          $("#collapse"+(i+1)).collapse('toggle');
        }
      }
      if (index == 1 && $("#editarpaquete").val() != '1') {
        addServicioPaquete(1,'');
        addHotelPaquete(1,'');
        window.setTimeout("crear_table()",1000);
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

      swal('You click view icon, row: ', 'vista no disponible');

    },
    'click .edit': function (e, value, row, index) {
      info = JSON.stringify(row);
      location.href="cotizaciones.php?action=edit&id="+row.id;
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
    $tableEmpresa.bootstrapTable('resetView');
  });

});

//INICIO AGREGAR DIAS Y SERVICIOS
function addHabitaciones(dia,item,id){
  // alert('dia: '+dia+' id: '+id);

  $.ajax({
    type : "POST",
    url :"ajax2.php",
    data: $("#wizardFormCotizacion").serialize()+"&action=agregarHabitaciones&dia="+dia+"&id="+id+"&item="+item,
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
function addServicioPaquete(dia,id){
  $.ajax({
    type : "POST",
    url :"ajax2.php",
    data: $("#wizardFormCotizacion").serialize()+"&action=agregarServicioCotizacion&dia="+dia+"&id="+id,
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
      $(".contenedor-card-apend-container").append(datos);

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

      $(".panel-default .text-danger").hide();
      $(".panel-default .text-danger").last().show();
    }
  });
}
function deletePaqueteItinerario(id){
  $.ajax({
    type : "POST",
    url :"ajax2.php",
    data: $("#wizardFormCotizacion").serialize()+"&action=deleteDiaPaquete&id="+id,
    beforeSend: function(){
    },
    success: function(datos){
      var dias = parseInt($(".card-dia").val());
      $(".card-dia").val(dias-1);
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
  $(".card-"+dia).parents(".panel-default").remove();
  deletePaqueteItinerario(id);
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
      //alert(datos);
      swal({
        title: 'Registrado!',
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
$("#wizardFormEditarCotizacion").submit(function(e) {
  e.preventDefault();

  var $form = $(this);

  if(! $form.valid()) return false;

  var formData = new FormData($("#wizardFormEditarCotizacion")[0]);
  var ruta = "ajax2.php";

  //alert('envio a ajax2');

  $.ajax({
    url: ruta,
    type: "POST",
    data: formData,
    contentType: false,
    processData: false,
    success: function(datos){
      alert(datos);
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

  alert('hola');

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
