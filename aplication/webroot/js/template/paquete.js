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

$().ready(function(){

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
          addHotelPaquete(activar,'');
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
      },
      success: function(datos){
        //alert(datos);
        $(".card-"+dia+" .contenedor-servicios-apend-container").append(datos);
      }
    });
}
function addHotelPaquete(dia,id){

    $.ajax({
      type : "POST",
      url :"ajax2.php",
      //data: $("#wizardFormEditarPaquete").serialize()+"&action=agregarHotelPaquete&dia="+dia+"&id="+id,
      data: $("#wizardForm").serialize()+"&action=agregarHotelPaquete&dia="+dia+"&id="+id,
      beforeSend: function(){
      },
      success: function(datos){
        //alert(datos);
        $(".card-"+dia+" .contenedor-hoteles-apend-container").append(datos);
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
        //alert(datos);
        $(".contenedor-card-apend-container").append(datos);
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
        //alert(datos);
        //$(".contenedor-card-apend-container").append(datos);
      }
    });
}
function addPaquete(){
	location.href="paquetes.php?action=add";
}
function addOneMoreDay() {
  numeroDia++;
  //$( ".card-"+numeroDia).removeClass( "hidden" );
  addDiaServicioPaquete(numeroDia,'');
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
    var listahotel = $(".card-"+dia+" .listahotel-"+dia).val();
    var listahoteltem = parseInt(listahotel)+1;
    $(".card-"+dia+" .listahotel-"+dia).val(listahoteltem);
    addHotelPaquete(dia,id);
}
function eliminarPaquete(dia,id) {
  $(".card-"+dia).remove();
  deletePaqueteItinerario(id);
}
$("#wizardForm").submit(function(e) { //AGREGAR UN PAQUETE
    e.preventDefault();
    var $form = $(this);
    if(! $form.valid()) return false;
    var formData = new FormData($("#wizardForm")[0]);
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

    alert(formData);

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

    alert('hola');

    $.ajax({
	    type : "GET",
	    url :"ajax.php",
	    data: $("#wizardFormEditarPaquete").serialize()+"&action=actualizarPaquete",
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
document.getElementById('files').addEventListener('change', archivo, false);
