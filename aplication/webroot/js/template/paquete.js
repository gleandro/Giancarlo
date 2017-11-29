/*SERVICIO*/
var $tablePaquete = $('#bootstrap-table-paquetes');

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
      var table_h = $('#table_h_'+i).DataTable({
        "paging":   false
      });
      var table_s = $('#table_s_'+i).DataTable({
        "paging":   false
      });
    $('#table_h_'+i+' tbody').on( 'click', 'tr', function () {
      $(this).toggleClass('selected');
    } );

    $('#button').click( function () {
      alert( table_h.rows('.selected').data().length +' row(s) selected' );
    } );

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

  $(".eliminar_inclusiones").on("click",function(){

  });

  $('#wizardPaquete').bootstrapWizard({
    tabClass: 'nav nav-pills',
    nextSelector: '.btn-next',
    previousSelector: '.btn-back',
    onNext: function(tab, navigation, index) {
      var $valid = $('#wizardForm').valid();
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
              $('.select_hoteles').multiselect({
                enableFiltering: true
              });
            }
          });

      }


        var datos =$(".dataTables_filter").find("input");
        for (var i = 0; i < datos.length; i++) {
          if ($(datos[i]).val() != '') {
            swal('No puede continuar ', 'El campo search de servicios debe estar vacio.');
            return false;
          };
        }

      if(!$valid) {
        $validator.focusInvalid();
        return false;
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
            swal('No puede continuar ', 'El campo search de servicios debe estar vacio.');
            return false;
          };
        }
      }


      var $valid = $('#wizardFormEditarPaquete').valid();
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
    'click .view': function (e, value, row, index) {
      info = JSON.stringify(row);
      // location.href="paquetes.php?action=edit&id="+row.id;
      location.href="pdf.php?id="+row.id;
      swal('Espere un momento: ', 'Descargar o abrir el archivo .pdf');

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

      window.setTimeout("crear_table()",1000);
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
      var dias_edit = $(".card-dia").val();
      for (var i = 0; i < dias_edit; i++) {
          var table_h = $('#table_edit_h_'+i).DataTable({
            "paging":   false
          });
          var table_s = $('#table_edit_s_'+i).DataTable({
            "paging":   false
          });
        $('#table_edit_h_'+i+' tbody').on( 'click', 'tr', function () {
          $(this).toggleClass('selected');
        } );

        $('#button').click( function () {
          alert( table_h.rows('.selected').data().length +' row(s) selected' );
        } );

        $('#table_edit_s_'+i+' tbody').on( 'click', 'tr', function () {
          $(this).toggleClass('selected');
        } );

        $('#button').click( function () {
          alert( table_s.rows('.selected').data().length +' row(s) selected' );
        } );

      }
      if(id.length == 0){
        $(".card-dia").val(dia);
        var hoteles = $(".card-1").find("#table_h_0 .selected");
        for (var i = 0; i < hoteles.length; i++) {
          $(".card-"+dia).find(".table_hotel").find("#"+$(hoteles[i]).attr("id")).addClass('selected');
        }
      }
      $(".panel-default .text-danger").hide();
      $(".panel-default .text-danger").last().show();
    }
  });
}
function deletePaqueteItinerario(id){
  $.ajax({
    type : "POST",
    url :"ajax2.php",
    data: $("#wizardForm").serialize()+"&action=deleteDiaPaquete&id="+id,
    beforeSend: function(){
    },
    success: function(datos){
      var dias = parseInt($(".card-dia").val());
      $(".card-dia").val(dias-1);
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
  html +='</div><div>';
  $("#lista_opciones_hoteles").append(html);
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
  deletePaqueteItinerario(id);
}
$("#wizardForm").submit(function(e) { //AGREGAR UN PAQUETE
  e.preventDefault();
  var $form = $(this);
  if(! $form.valid()) return false;
  var formData = new FormData($("#wizardForm")[0]);

  var dias = $(".card-dia").val();

  for (var i = 0; i < dias; i++) {
    var dia = $(".card-"+(i+1));

    var hoteles = dia.find(".table_hotel").find(".selected .id");
    for (var j = 0; j < hoteles.length; j++) {
      formData.append('dias['+i+'][0]['+j+']', hoteles[j].innerHTML);
    }

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
    success: function(datos){
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

    var hoteles = dia.find(".table_hotel").find(".selected .id");

    for (var j = 0; j < hoteles.length; j++) {
      formData.append('dias['+i+'][0]['+j+']', hoteles[j].innerHTML);
    }

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
    success: function(datos){

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
