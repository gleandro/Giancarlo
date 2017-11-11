/*SERVICIO*/
var $tableEmpresa = $('#bootstrap-table-servicios');

function onFinishWizardAdd(){
    //CUANDO FINALIZA EL FORM WIZARD GUARDAMOS LOS DATOS Y MOSTRAMOS ALERTA
    /*alert($("#wizardFormNuevoServicio").serialize());*/
    $.ajax({
	    type : "GET",
	    url :"ajax.php",
	    data: $("#wizardFormNuevoServicio").serialize()+"&action=registrarSevicio",
	    beforeSend: function(){
	    },
	    success: function(datos){
	      swal({
	      	title: 'Listo!',
	      	text: 'El servicio fué registrado con éxito',
	      	type: 'success',
	      	allowOutsideClick: false,
            allowEscapeKey: false
	      }).then(function (email) {
	      	location.href="servicios.php";
	      })
	    }
	  });
}

function onFinishWizardEdit(){
    //CUANDO FINALIZA EL FORM WIZARD GUARDAMOS LOS DATOS Y MOSTRAMOS ALERTA
    /*alert($("#wizardFormEditarServicio").serialize());*/
    $.ajax({
	    type : "GET",
	    url :"ajax.php",
	    data: $("#wizardFormEditarServicio").serialize()+"&action=cambiarServicio",
	    beforeSend: function(){
	    },
	    success: function(datos){
	      swal({
	      	title: 'Listo!',
	      	text: datos,
	      	type: 'success',
	      	allowOutsideClick: false,
            allowEscapeKey: false
	      }).then(function (email) {
	      	location.href="servicios.php";
	      })
	    }
	  });
}

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

	/*NUEVO SERVICIO*/
	var $validator = $("#wizardFormNuevoServicio").validate();

	$('#wizardCardNuevoServicio').bootstrapWizard({
		tabClass: 'nav nav-pills',
		nextSelector: '.btn-next',
	    previousSelector: '.btn-back',
		onNext: function(tab, navigation, index) {
			var $valid = $('#wizardFormNuevoServicio').valid();

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
	        } else if($current == 1){
	            $(wizard).find('.btn-back').hide();
	        } else {
	            $(wizard).find('.btn-back').show();
	            $(wizard).find('.btn-next').show();
	            $(wizard).find('.btn-finish').hide();
	        }
	    }

	});

	/*NUEVO SERVICIO*/
	/*EDITAR SERVICIO*/
	var $validator = $("#wizardFormEditarServicio").validate();

	$('#wizardCardEditarServicio').bootstrapWizard({
		tabClass: 'nav nav-pills',
		nextSelector: '.btn-next',
	    previousSelector: '.btn-back',
		onNext: function(tab, navigation, index) {
			var $valid = $('#wizardFormEditarServicio').valid();

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
	        } else if($current == 1){
	            $(wizard).find('.btn-back').hide();
	        } else {
	            $(wizard).find('.btn-back').show();
	            $(wizard).find('.btn-next').show();
	            $(wizard).find('.btn-finish').hide();
	        }
	    }

	});
	/*EDITAR SERVICIO*/
	/*LIST SERVICIO*/
    window.operateEvents = {
        'click .view': function (e, value, row, index) {
            info = JSON.stringify(row);

            swal('You click view icon, row: ', 'vista no disponible');

        },
        'click .edit': function (e, value, row, index) {
            info = JSON.stringify(row);
            location.href="servicios.php?action=edit&id="+row.id;
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
                data: "&action=borrarServicio&id="+row.id,
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
              $tableEmpresa.bootstrapTable('remove', {
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




            /**/

        }
    };

    $tableEmpresa.bootstrapTable({
        toolbar: ".toolbar",
        clickToSelect: true,
        showRefresh: true,
        search: true,
        showToggle: true,
        showColumns: true,
        showAddButtonServicio: true,
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

    /*LIST SERVICIO*/
});

function addServicio(){
	location.href="servicios.php?action=add";
}

/*SERVICIO*/
