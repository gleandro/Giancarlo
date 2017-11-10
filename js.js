/*** INICIO VALIDACIONES - INJECTION ***/
function validarNumero(e) { // 1
    tecla = (document.all) ? e.keyCode : e.which; // 2
    if (tecla==8) return true; // 3
    patron =/[0-9\s]/; // 4
    te = String.fromCharCode(tecla); // 5
    return patron.test(te); // 6
}
function validarTexto(e) { // 1
    tecla = (document.all) ? e.keyCode : e.which; // 2
    if (tecla==8) return true; // 3
    patron =/[A-Za-z\s]/; // 4
    te = String.fromCharCode(tecla); // 5
    return patron.test(te); // 6
}
function validarTextoNumero(e) { // 1
    tecla = (document.all) ? e.keyCode : e.which; // 2
    if (tecla==8) return true; // 3
    patron =/[A-Za-z0-9\s]/; // 4
    te = String.fromCharCode(tecla); // 5
    return patron.test(te); // 6
}
function validarEmail(e) { // 1
    tecla = (document.all) ? e.keyCode : e.which; // 2
    if (tecla==8) return true; // 3
    patron =/[A-Za-z0-9@._-\s]/; // ^A-Za-z0-9
    te = String.fromCharCode(tecla); // 5
    return patron.test(te); // 6
}
/*** FIN VALIDACIONES - INJECTION ***/

/*** INICIO MODAL CONSULTA ***/
function consultaAsesoria(form) {

    //var producto = form.buscador_producto_consulta.value;
    var nombre = form.nombre_consulta.value;
    var apellido = form.apellido_consulta.value;
    var correo = form.correo_consulta.value;
    var telefono = form.telefono_consulta.value;
    var consulta = form.detalle_consulta.value;

    var validardecimales = /^(\d|-)*\.?\d*$/;
    var emailRegex = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;
    /*
    if (producto == "") {
        $(".mensaje-consulta-asesoria").text('Debe ingresar un producto.');
        $("#buscador_producto_consulta").focus();
        return false;
    }
    */
    if (nombre == "") {
        $(".mensaje-consulta-asesoria").text('Debe ingresar un nombre.');
        $("#nombre_consulta").focus();
        return false;
    }
    if (apellido == "") {
        $(".mensaje-consulta-asesoria").text('Debe ingresar un apellido.');
        $("#apellido_consulta").focus();
        return false;
    }
    if (correo == "") {
        $(".mensaje-consulta-asesoria").text('Ingresar su correo electrónico');
        $("#correo_consulta").focus();      
        return false;
    }
    if (!correo.match(emailRegex)) {
        $(".mensaje-consulta-asesoria").text('Ingresar un correo electrónico válido');
        $("#correo_consulta").focus();      
        return false;
    }
    if (telefono == "") {
        $(".mensaje-consulta-asesoria").text('Debe ingresar un teléfono.');
        $("#telefono_consulta").focus();
        return false;
    }
    if (consulta == "") {
        $(".mensaje-consulta-asesoria").text('Debe ingresar su consulta.');
        $("#consulta_consulta").focus();
        return false;
    }

    $.ajax({     
              type  : "POST", 
              url: url_web+"ajax.php?action=enviarConsultaAsesoria",
              data  : $("#form_consulta_asesoria").serialize(),
              success: function(data) {  
                    $(".mensaje-consulta-asesoria").text('');
                    $("#nombre_consulta").val('');
                    $("#apellido_consulta").val('');
                    $("#correo_consulta").val('');
                    $("#telefono_consulta").val('');
                    $("#detalle_consulta").val('');
                    //$("#buscador_producto_calculadora").val('');
                    $('.modal-asesoria-consulta').modal('hide');
                    $('.modal-asesoria-consulta-mensaje').modal('show');
                    setTimeout(function(){
                        $('.modal-asesoria-consulta-mensaje').modal('hide');
                    },10000)
              },
              beforeSend: function(objeto){       
              },
              complete: function(){                
              }
    });
    
    return false;
   
}
/*** INICIO MODAL CONSULTA ***/

/*** INICIO MODAL RECLAMO ***/
function reclamoAsesoria(form) {

    var producto = form.buscador_producto_reclamo.value;
    var color = form.color_reclamo.value;
    var lote = form.numero_lote_reclamo.value;
    var lugar = form.lugar_compra_reclamo.value;

    var nombre = form.nombre_reclamo.value;
    var dni = form.dni_reclamo.value;
    var telefono = form.telefono_reclamo.value;
    var email = form.email_reclamo.value;
    var pais = form.pais_reclamo.value;
    var provincia = form.provincia_reclamo.value;
    var distrito = form.distrito_reclamo.value;
    var direccion = form.direccion_reclamo.value;
    var razon = form.razon_reclamo.value;
    var ruc = form.ruc_reclamo.value;

    var comentario = form.comentario_reclamo.value;

    var acuerdo = form.acuerdo_reclamo.value;

    var copia = form.optionsRadios.value;



    
    if (producto == "") {
        $(".mensaje-reclamo-asesoria").text('Debe ingresar un producto.');
        $("#buscador_producto_reclamo").focus();
        return false;
    }
    
    if (color == "") {
        $(".mensaje-reclamo-asesoria").text('Debe ingresar un color.');
        $("#color_reclamo").focus();
        return false;
    }
    if (lote == "") {
        $(".mensaje-reclamo-asesoria").text('Debe ingresar un número de lote.');
        $("#numero_lote_reclamo").focus();
        return false;
    }
    if (lugar == "") {
        $(".mensaje-reclamo-asesoria").text('Ingresar el lugar donde compró.');
        $("#lugar_compra_reclamo").focus();      
        return false;
    }

    if (nombre == "") {
        $(".mensaje-reclamo-asesoria").text('Ingrese sus nombres y apellidos.');
        $("#nombre_reclamo").focus();      
        return false;
    }
    if (dni == "") {
        $(".mensaje-reclamo-asesoria").text('Ingrese DNI o pasaporte.');
        $("#dni_reclamo").focus();      
        return false;
    }
    if (!/^([0-9])*$/.test(dni)) {
        $(".mensaje-reclamo-asesoria").text('Ingrese un DNI o pasaporte válido.');
        $("#dni_reclamo").focus();      
        return false;
    }
    if (telefono == "") {
        $(".mensaje-reclamo-asesoria").text('Ingrese su teléfono.');
        $("#telefono_reclamo").focus();      
        return false;
    }
    if (!/^([0-9])*$/.test(telefono)) {
        $(".mensaje-reclamo-asesoria").text('Ingrese un número válido.');
        $("#telefono_reclamo").focus();      
        return false;
    }
    if (email == "") {
        $(".mensaje-reclamo-asesoria").text('Ingrese su correo electrónico.');
        $("#email_reclamo").focus();      
        return false;
    }

    if (!email.match(/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/)) {
        $(".mensaje-consulta-asesoria").text('Ingresar un correo electrónico válido');
        $("#email_reclamo").focus();      
        return false;
    }

    if (pais == "") {
        $(".mensaje-reclamo-asesoria").text('Ingresar el nombre del país.');
        $("#pais_reclamo").focus();      
        return false;
    }
    if (provincia == "") {
        $(".mensaje-reclamo-asesoria").text('Ingresar el nombre de la provincia.');
        $("#provincia_reclamo").focus();      
        return false;
    }
    if (distrito == "") {
        $(".mensaje-reclamo-asesoria").text('Ingresar el nombre del distrito.');
        $("#distrito_reclamo").focus();      
        return false;
    }
    if (direccion == "") {
        $(".mensaje-reclamo-asesoria").text('Ingrese su dirección.');
        $("#direccion_reclamo").focus();      
        return false;
    }
    
    if (ruc != "") {
        if (!/^([0-9])*$/.test(ruc)) {
            $(".mensaje-reclamo-asesoria").text('Ingrese un RUC válido.');
            $("#ruc_reclamo").focus();      
            return false;
        }
    }
    
    


    
    if (comentario == "") {
        $(".mensaje-reclamo-asesoria").text('Ingrese el detalle del reclamo.');
        $("#comentario_reclamo").focus();
        return false;
    }

    if (copia == "") {
        $(".mensaje-reclamo-asesoria").text('¿Desea recibir una copia?');
        $("#optionsRadios").focus();
        return false;
    }


    if ($("#acuerdo_reclamo").prop('checked')==false) {
        $(".mensaje-reclamo-asesoria").text('Debe marcar la casilla antes de continuar.');
        $("#acuerdo_reclamo").focus();
        return false;
    }

    

    $.ajax({     
              type  : "POST", 
              url: url_web+"ajax.php?action=enviarReclamoAsesoria",
              data  : $("#form_reclamo_asesoria").serialize(),
              success: function(datos) {  
                    $(".mensaje-reclamo-asesoria").text('');
                    $("#color_reclamo").val('');
                    $("#numero_lote_reclamo").val('');
                    $("#lugar_compra_reclamo").val('');

                    $("#nombre_reclamo").val('');
                    $("#dni_reclamo").val('');
                    $("#telefono_reclamo").val('');
                    $("#email_reclamo").val('');
                    $("#pais_reclamo").val('');
                    $("#provincia_reclamo").val('');
                    $("#distrito_reclamo").val('');
                    $("#direccion_reclamo").val('');
                    $("#razon_reclamo").val('');
                    $("#ruc_reclamo").val('');

                    $("#comentario_reclamo").val('');
                    $("#buscador_producto_reclamo").val('');
                    //$("#buscador_producto_calculadora").val('');
                    $('.modal-asesoria-reclamo').modal('hide');
                    $('#pagina-reclamo').val(datos);
                    $('.modal-asesoria-reclamo-mensaje').modal('show');
                    setTimeout(function(){
                        $('.modal-asesoria-reclamo-mensaje').modal('hide');
                    },100000)
              },
              beforeSend: function(objeto){       
              },
              complete: function(){                
              }
    });
    
    return false;
   
}
/*** INICIO MODAL RECLAMO ***/

function calcularPinturaProyecto(form) {

    var producto = form.buscador_producto_calculadora.value;
    var ancho = form.ancho.value;
    var alto = form.alto.value;
    var numero_puertas = form.numero_puertas.value;
    var numero_ventanas = form.numero_ventanas.value;
    //var numero_manos = form.numero_manos.value;
    var rendimiento = form.rendimiento_producto.value;

    var validardecimales = /^(\d|-)*\.?\d*$/;
    //alert(producto+'-'+ancho+'-'+alto+'-'+numero_puertas+'-'+numero_ventanas);
    
    //alert(producto+'-'+ancho+'-'+alto+'-'+numero_puertas+'-'+numero_ventanas+'-'+numero_manos);
    //return false;

    if (producto == "") {
        $(".mensaje-calculo-pintura").text('Debe ingresar un producto.');
        $("#buscador_producto_calculadora").focus();
        return false;
    }
    if (ancho == "") {
        $(".mensaje-calculo-pintura").text('Debe ingresar un ancho.');
        $("#ancho").focus();
        return false;
    }
    if (!ancho.match(validardecimales)) {
        $(".mensaje-calculo-pintura").text('Debe ingresar un ancho válido.');
        $("#ancho").val('');
        $("#ancho").focus();
        return false;
    }
    if (alto == "") {
        $(".mensaje-calculo-pintura").text('Debe ingresar un alto.');
        $("#alto").focus();
        return false;
    }
    if (!alto.match(validardecimales)) {
        $(".mensaje-calculo-pintura").text('Debe ingresar un alto válido.');
        $("#alto").val('');
        $("#alto").focus();
        return false;
    }
    if (numero_puertas == "") {
        $(".mensaje-calculo-pintura").text('Debe ingresar un número de puertas.');
        $("#numero_puertas").focus();
        return false;
    }
    if (!numero_puertas.match(/^[0-9]+$/)) {
        $(".mensaje-calculo-pintura").text('Debe ingresar un número de puertas válido.');
        $("#numero_puertas").val('');
        $("#numero_puertas").focus();
        return false;
    }
    if (numero_ventanas == "") {
        $(".mensaje-calculo-pintura").text('Debe ingresar un número de ventanas.');
        $("#numero_ventanas").focus();
        return false;
    }
    if (!numero_ventanas.match(/^[0-9]+$/)) {
        $(".mensaje-calculo-pintura").text('Debe ingresar un número de ventanas válido.');
        $("#numero_ventanas").val('');
        $("#numero_ventanas").focus();
        return false;
    }
    /*
    if (numero_manos == "") {
        $(".mensaje-calculo-pintura").text('Debe ingresar un ancho.');
        $("#numero_manos").focus();
        return false;
    }
    if (!numero_manos.match(/^[0-9]+$/)) {
        $(".mensaje-calculo-pintura").text('Debe ingresar un ancho válido.');
        $("#numero_manos").val('');
        $("#numero_manos").focus();
        return false;
    }
    */
    var area_total = Math.round(((ancho*alto)-((1.40*numero_puertas)+(1.44*numero_ventanas))) * 100) / 100;
    var area_rendimiento = Math.round((area_total/rendimiento) * 100) / 100;
    var area_rendimiento_cantidad = Math.ceil(area_rendimiento);
    $(".mensaje-calculo").text(area_rendimiento_cantidad+' galones');
    $("#ancho").val('');
    $("#alto").val('');
    $("#numero_puertas").val('');
    $("#numero_ventanas").val('');
    $("#buscador_producto_calculadora").val('');
    //$("#numero_manos").val('');
    $(".mensaje-calculo-pintura").text('');
    //alert('valor: '+area_total+'-'+area_rendimiento+'-'+area_rendimiento_cantidad);
    $("#calcular_pintura").val(area_rendimiento_cantidad);
    return false;
}
/*** FIN MODAL CALCULAR PINTURA ***/
function eliminar_cesta_cliente(id) {
    //var ruta_producto = $("#valor_url_producto").val();
    //var ruta=$("#ruta_web").val();
    $.ajax({
            type  : "POST",
            url: url_web+"ajax.php?action=eliminarCestaCliente&id_producto_color="+id,
            data  : '',
            success: function(data) {
                //alert('mundo');
                $(".bloque_"+id).css("display", "none");
                $(".bloque_"+id).remove(); //elimino un bloque
            },
            beforeSend: function(objeto){

            },
            complete: function(){
            }
    });
    return false;
                                            
}
function modificar_cesta_cliente(id) {
   $("#cantidad_"+id).css("border", "1px solid rgb(193, 203, 224)");
   $("#cantidad_"+id).focus();
   $("#cantidad_"+id).select();
   return false;                           
}
/*** INICIO MODAL CALCULAR PINTURA
function validarPinturaProyecto(form){
  var res = Math.ceil((((parseFloat($('#calc-gen-alto').val()) * parseFloat($('#calc-gen-ancho').val())) - ((parseFloat($('#calc-gen-puertas').val()) + parseFloat($('#calc-gen-ventanas').val())) * 2)) * (parseFloat($('#calc-gen-pasadas').val()))) / 40.0);
  $('.calc-gen-res').text(isNaN(res) ? '--' : (res == 1 ? res + " galón" : res + " galones"));
  return false;
}
FIN MODAL CALCULAR PINTURA ***/

/*** INICIO MODAL RECOMENDAR A UN AMIGO ***/
function validarMailAmigos(form) {

    var email_cliente = form.email_cliente.value;    
    var email_amigo = form.email_amigo.value; 
    var url_enviar_amigo = $(".url_enviar_amigo").html();
    //alert(url_enviar_amigo);

    var emailRegex = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;

    if (email_cliente == "") {
        $(".mensaje-recomendar-amigo").text('Ingresar su correo electrónico');
        $("#email_cliente_recomendado").focus();      
        return false;
    }
    if (!email_cliente.match(emailRegex)) {
        $(".mensaje-recomendar-amigo").text('Ingresar un correo electrónico válido');
        $("#email_cliente_recomendado").focus();      
        return false;
    }
    if (email_amigo == "") {
        $(".mensaje-recomendar-amigo").text('Ingresar el correo electrónico de su amigo');
        $("#email_amigo_recomendado").focus();      
        return false;
    }
    if (!email_amigo.match(emailRegex)) {
        $(".mensaje-recomendar-amigo").text('Ingresar el correo electrónico de su amigo válido');
        $("#email_amigo_recomendado").focus();         
        return false;
    }
    if(document.getElementById('privacidad_recomendado').checked == false){
        $(".mensaje-recomendar-amigo").text('Debe aceptar los Términos y Condiciones.');
        return false;
    }
    
    //var ruta=$("#ruta_web").val();
    $.ajax({     
              type  : "POST", 
              url: url_web+"ajax.php?action=enviarMailAmigo&url_enviar_amigo="+url_enviar_amigo,
              data  : $("#form_datos_mail").serialize(),
              success: function(data) {  
                    //alert(data);
                    $("#email_cliente_recomendado").val(''); 
                    $("#email_amigo_recomendado").val('');  
                    $(".mensaje-recomendar-amigo").text(''); 
                    document.getElementById('privacidad_recomendado').checked=0; 
                    $('.modal-enviar-amigo').modal('hide');
                    $('.modal-recomendar-mensaje').modal('show');
                    setTimeout(function(){
                        $('.modal-recomendar-mensaje').modal('hide');
                    },10000)
              },
              beforeSend: function(objeto){
                                 
              },
              complete: function(){                
              }
    });
    
    return false;
}
/*** FIN MODAL RECOMENDAR A UN AMIGO ***/
function compartirFacebook(url, width, height) {
    var myWindow = window.open(url, "", "width=480,height=400");
}

function validarAddCesta(form) {
    var id_color_producto_temporal = $("#id_color_producto").val();
    //alert(id_color_producto_temporal);
    $("div ."+id_color_producto_temporal).removeClass("active");
    var id_producto = form.id_producto.value;
    var cantidad_producto = form.cantidad_producto.value;
    var action = form.action.value;
    var estado = $("#estado").val();
    var id_producto_color = $("#id_producto_color").val();

    if (estado == "1") {
      if (id_producto_color == "") {
          $(".mensaje-producto").text('Debe seleccionar un color.');
          return false;
      }
    }

    if (cantidad_producto == "" || cantidad_producto == "0") {
        $(".mensaje-producto").text('Debe ingresar una cantidad válida.');
        $("#cantidad_producto").focus();
        return false;
    }
    if (!cantidad_producto.match(/^[0-9]+$/)) {
        $(".mensaje-producto").text('Debe ingresar una cantidad válida.');
        $("#cantidad_producto").val('');
        $("#cantidad_producto").focus();
        return false;
    }

    //alert('valor de ruta: '+url_web);
    $.ajax({
        type: "POST",
        url: url_web+"ajax.php", //url: "http://develowebapps.com/proyectos/anypsa3/ajax.php",
        data : $("#form_add_producto").serialize(),
        beforeSend: function(objeto){},
        success: function(data){
              //alert(data);
              $(".mensaje-producto").text('');
              $("#id_producto_color,#cantidad_producto").val('');
              $("#unidad_medida").val("1");
              $("#cantidad_producto").val("1");
              $(".lista-cotizacion").hide("100");
              $(".cotizar-cantidad").css("display", "block");
              $(".cotizar-cantidad").text("("+data+")");
              $("#cantidad_pedido_cliente").val("1");
              $(".flotante-cotizacion .cantidad-productos").text(data);
              $(".flotante-cotizacion").show("100");
        },
       complete:function(){
       }
    });
    return false;

}

function validarEmpresaAddCesta() {

    var id_producto = $("#id_producto").val();
    var cantidad_producto = $("#cantidad_producto").val();
    var id_producto_color = $("#id_producto_color").val();
    //var precio_galon_producto = $("#precio_galon_producto").val();
    var unidad_medida = $("#unidad_medida").val();
    var id_moneda = $("#id_moneda").val();
    var action = $("#action").val();
    $(".mensaje-cotizacion-pedido").text('');
    //alert(id_producto+'-'+cantidad_producto+'-'+id_producto_color+'-'+precio_galon_producto+'-'+unidad_medida+'-'+action);

    var estado = $("#estado").val();
    if (estado == "1") {
      if (id_producto_color == "") {
          $(".mensaje-cotizacion-pedido").text('Debe seleccionar un color.');
          return false;
      }
    }

    if (cantidad_producto == "" || cantidad_producto == "0") {
        $(".mensaje-producto").text('Debe ingresar una cantidad válida.');
        $("#cantidad_producto").focus();
        return false;
    }
    if (!cantidad_producto.match(/^[0-9]+$/)) {
        $(".mensaje-producto").text('Debe ingresar una cantidad válida.');
        $("#cantidad_producto").val('');
        $("#cantidad_producto").focus();
        return false;
    }

    //alert('valor de ruta: '+url_web);
    $.ajax({
        type: "POST",
        url: url_web+"ajax.php", //url: "http://develowebapps.com/proyectos/anypsa3/ajax.php",
        data:{ action: action,id_producto: id_producto, id_producto_color: id_producto_color, cantidad_producto: cantidad_producto, unidad_medida: unidad_medida, estado: estado, id_moneda: id_moneda },
        //data : $("#form_add_producto_empresa").serialize(),
        beforeSend: function(objeto){},
        success: function(data){
              //alert(data);
              $(".bloque_color_"+id_producto).css("display", "none");
              $(".bloque_color_"+id_producto).remove(); //elimino un bloque
              $(".mensaje-producto").text('');
              $("#id_producto_color,#id_producto_color,#id_moneda").val('');
              $("#unidad_medida").val("1");
              $("#cantidad_producto").val("1");
              $(".lista-cotizacion").hide("100");
              //$(".flotante-cotizacion .cantidad-productos").text(data);
              //$(".flotante-cotizacion").show("100");
              $.get("ajax.php",{ action:'pedidoProductoEmpresa',id_producto:id_producto, id_producto_color: id_producto_color, cantidad_producto: cantidad_producto, unidad_medida: unidad_medida, estado: estado, id_moneda: id_moneda},function(data){
                //alert('insertantod');
                    $(".bloque-detalle-producto-color").append(data);
              })
        },
       complete:function(){
       }
    });
    
    return false;

}
function validarCotizacionPedido(form) {
    //alert('validando');
    var count = 0;
    $(".bloque-cotizar .bloque-cotizacion-color .producto-cotizado-cliente").each(function(x) {
        count++;
        //alert('contando: '+count);
    });
    if (count==0) {
        $(".mensaje-cotizacion-pedido").text("Debe ingresar al menos un producto para cotizar");
        //alert('intrese al menos un productos: '+count);
        return false;
    }else{
        //alert('enviando el formunlario: '+count);
        $(".mensaje-cotizacion-pedido").text("");
        document.form_pedidos.submit();
    }
    return false;
    //document.form_pedidos.action="productos.php?actioncat="+opcion+"&id="+id;
    //document.form_pedidos.submit();
    //var URLactual = window.location;
    //window.location.replace(URLactual);
}

function validarCotizacionClientePedido(form) {
    //alert('validando');
    var count = 0;
    $(".bloque-info-cotizar .min-bloque .bloque-info-cotizar-interno").each(function(x) {
        count++;
        //alert('contando: '+count);
    });
    if (count==0) {
        $(".mensaje-cotizacion-pedido").text("Debe ingresar al menos un producto para cotizar");
        //alert('intrese al menos un productos: '+count);
        return false;
    }else{
        //alert('enviando el formunlario: '+count);
        $(".mensaje-cotizacion-pedido").text("");
        document.form_pedidos.submit();
    }
    return false;
    
}

function validarLogeoEmpresa_antiguo(form) {

    var ruc = form.ruc.value;
    var email = form.email_logeo.value;

    var emailRegex = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;

    if (ruc == "") {
				$(".mensaje_logeo").text('Usted debe ingresar su ruc.');
				return false;
    }
		if (!ruc.match(/^[0-9]+$/)) {
				$(".mensaje_logeo").text('Usted debe ingresar un ruc válido.');
				$("#ruc").val('');
				$("#ruc").focus();
				return false;
		}
		if (ruc.length < 11 || ruc.length > 12 ) {
				$(".mensaje_logeo").text('Usted debe ingresar un ruc válido.');
				$("#ruc").focus();
				return false;
    }
		if (email == "") {
				$(".mensaje_logeo").text('Usted debe ingresar su email.');
				return false;
    }
    if (!email.match(emailRegex)) {
        $(".mensaje_logeo").text('Usted debe ingresar un email válido.');
        $("#email_logeo").focus();
        return false;
    }

    $.ajax({
              type  : "POST",
              url: 'validateUser.php?logeo_sistema_empresa=1&ruc='+ruc+'&email='+email,
              data  : $("#form_logeo").serialize(),
              success: function(data) {
                  	//alert(data);
                    if(data==1){
												$("#email_logeo").val('');
												$("#ruc").val('');
												var URLactual = window.location;
                      	window.location.replace(URLactual);
                    }else{
												$("#email_logeo").val('');
												$("#ruc").val('');
												$(".mensaje_logeo").text('Los datos ingresados no coinciden.');
												$("#ruc").focus();
												return false;
                    }
              },
              beforeSend: function(objeto){

              },
              complete: function(){
              }
    });
    return false;

}

function validarRegistroPostulante(form) {

    var nombre = $("#nombre").val();
    var apellidos = $("#apellidos").val();
    var dni = $("#dni").val();
    var telefono = $("#telefono").val();
    var direccion = $("#direccion").val();
    var cargo = $("#cargo").val();
    var area = $("#area").val();
    var salario = $("#salario").val();
    var id_bolsa_trabajo = $(".id-bolsa-trabajo").html();
    //alert(id_bolsa_trabajo);
    var file=$("#archivo").val();

    var formData = new FormData(document.getElementById("form_postulante"));
    formData.append("nombre", nombre);
    formData.append("apellidos", apellidos);
    formData.append("cargo", cargo);
    formData.append("area", area);
    formData.append("salario", salario);
    formData.append("id_bolsa_trabajo", id_bolsa_trabajo);
    formData.append("file", file);

    var numeroRegex = /^-?[0-9]*$/;
    var validardecimales = /^(\d|-)*\.?\d*$/;

    var emailRegex = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;

    if (nombre=='') {
        $(".mensaje-bolsa-trabajo").text('Debe ingresar un nombre.');
        $("#nombre").focus();
        return false;
    }

    if (apellidos=='') {
        $(".mensaje-bolsa-trabajo").text('Debe ingresar su apellido.');
        $("#apellidos").focus();
        return false;
    }
    if (dni=='') {
        $(".mensaje-bolsa-trabajo").text('Debe ingresar su dni.');
        $("#dni").focus();
        return false;
     }
    if (!dni.match(/^[0-9]+$/)) {
        $(".mensaje-bolsa-trabajo").text('Debe ingresar un dni válido.');
        $("#dni").val('');
        $("#dni").focus();
        return false;
    }
    if (dni.length < 8 || dni.length > 8 ) {
        $(".mensaje-bolsa-trabajo").text('Usted debe ingresar un dni de 8 dígitos.');
        $("#dni").focus();
        return false;
    }
    if (telefono=='') {
        $(".mensaje-bolsa-trabajo").text('Debe ingresar su teléfono.');
        $("#telefono").focus();
        return false;
    }
    if (salario=='' || !salario.match(validardecimales) || salario<1) {
        $(".mensaje-bolsa-trabajo").text('Debe ingresar un salario válido.');
        $("#salario").val('');
        $("#salario").focus();
        return false;
    }
    if (direccion=='') {
        $(".mensaje-bolsa-trabajo").text('Debe ingresar su dirección.');
        $("#direccion").focus();
        return false;
    }
    if (file=='') {
        $(".mensaje-bolsa-trabajo").text('Debe ingresar su Curriculim Vitae.');
        $("#file").focus();
        return false;
    }

    var formData = new FormData(document.getElementById("form_postulante"));
    formData.append("dato", "valor"); //datos extra
    //formData.append(f.attr("name"), $(this)[0].files[0]);
    $(".validacion_postulante").attr('disabled','disabled');
    $.ajax({
        url: "postulanteInsertar.php?id_bolsa_trabajo="+id_bolsa_trabajo,
        type: "post",
        dataType: "html",
        data: formData,
        cache: false,
        contentType: false,
        processData: false
    })
    .done(function(data){
      //alert(data);
        
        $("#nombre").val('');
        $("#apellidos").val('');
        $("#telefono").val('');
        $("#dni").val('');
        $("#direccion").val('');
        $("#archivo").val('');
        $("#nombre").focus();
        $(".mensaje-bolsa-trabajo").html("");
        $('.modal-registrar-postulante').modal('hide');
        $('.modal-registrar-postulante-mensaje').modal('show');
        setTimeout(function(){
            $('.modal-registrar-postulante-mensaje').modal('hide');
        },10000)
        
    });

    return false;
}

function validarRegistroEmpresa(form) {

    var ruc = form.ruc_empresa.value;
    var email = form.mail_empresa.value;
    var razon_social = form.razon_social_empresa.value;
    var direccion = form.direccion_empresa.value;
	var nombre = form.nombre_cliente_empresa.value;
    var apellido = form.apellido_cliente_empresa.value;
    var dni = form.dni_cliente_empresa.value;
    var telefono = form.telefono_cliente_empresa.value;

    var emailRegex = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;

	if (ruc == "") {
		$(".mensaje_registro_empresa").text('Usted debe ingresar su ruc.');
        $("#ruc_empresa").focus();
		return false;
    }
	if (!ruc.match(/^[0-9]+$/)) {
		$(".mensaje_registro_empresa").text('Usted debe ingresar un ruc válido.');
		$("#ruc_empresa").val('');
		$("#ruc_empresa").focus();
		return false;
	}
	if (ruc.length < 11 || ruc.length > 12 ) {
		$(".mensaje_registro_empresa").text('Usted debe ingresar un RUC de 11 dígitos.');
		$("#ruc_empresa").focus();
		return false;
    }
	if (email == "") {
		$(".mensaje_registro_empresa").text('Usted debe ingresar su email.');
        $("#mail_empresa").focus();
		return false;
    }
    if (!email.match(emailRegex)) {
        $(".mensaje_registro_empresa").text('Usted debe ingresar un email válido.');
        $("#mail_empresa").focus();
        return false;
    }
	if (razon_social == "") {
		$(".mensaje_registro_empresa").text('Usted debe ingresar su razón social.');
        $("#razon_social_empresa").focus();
		return false;
    }
	if (direccion == "") {
		$(".mensaje_registro_empresa").text('Usted debe ingresar su dirección.');
        $("#direccion_empresa").focus();
		return false;
    }
    if (nombre == "") {
	   $(".mensaje_registro_empresa").text('Usted debe ingresar su nombre.');
       $("#nombre_cliente_empresa").focus();
		return false;
    }
    if (apellido == "") {
		$(".mensaje_registro_empresa").text('Usted debe ingresar su apellido.');
        $("#apellido_cliente_empresa").focus();
		return false;
    }
	if (dni == "") {
		$(".mensaje_registro_empresa").text('Usted debe ingresar su dni.');
        $("#dni_cliente_empresa").focus();
		return false;
    }
    if (!dni.match(/^[0-9]+$/)) {
		$(".mensaje_registro_empresa").text('Usted debe ingresar un dni válido.');
		$("#dni_cliente_empresa").val('');
		$("#dni_cliente_empresa").focus();
		return false;
	}
	if (dni.length < 8 || dni.length > 9 ) {
		$(".mensaje_registro_empresa").text('Usted debe ingresar un DNI de 8 dígitos.');
		$("#dni_cliente_empresa").focus();
		return false;
    }
	if (telefono == "") {
		$(".mensaje_registro_empresa").text('Usted debe ingresar su telefono.');
        $("#telefono_cliente_empresa").focus();
		return false;
    }

    $.ajax({
              type  : "POST",
              url   : 'validateUser.php?registro_empresa=1',
              data  : $("#form_registrar_empresa").serialize(),
              success: function(data) {
                    if(data==1){
                        //window.location.replace("/cuenta.php?cuenta=bienvenido");
                        $("#ruc_empresa").val('');
                        $("#mail_empresa").val('');
                        $("#razon_social_empresa").val('');
                        $("#direccion_empresa").val('');
                        $("#nombre_cliente_empresa").val('');
                        $("#apellido_cliente_empresa").val('');
                        $("#dni_cliente_empresa").val('');
                        $("#telefono_cliente_empresa").val('');
                        $(".mensaje_registro_empresa").text('');
                        //var URLactual = window.location;
                      	//window.location.replace(URLactual);
                        $('.close').click();
                        var url_producto = $("#url_producto").val();
                        $('.modal-registro-empresa').modal('hide');
                        $('.modal-cotizar-pedido-empresa').modal('show');
                        $(".bloque-pedido-empresa").html('');
                        $.get("ajax.php",{ action:'pedidoEmpresa'},function(data){
                            $(".bloque-pedido-empresa").append(data);
                        })
                        return false;
                    }else{
                        $("#ruc_empresa").val('');
                        $("#mail_empresa").val('');
                        $("#razon_social_empresa").val('');
                        $("#direccion_empresa").val('');
                        $("#nombre_cliente_empresa").val('');
                        $("#apellido_cliente_empresa").val('');
                        $("#dni_cliente_empresa").val('');
                        $("#telefono_cliente_empresa").val('');
                        $(".mensaje_registro_empresa").text('Su RUC e Email ya fueron registrados.');
						$("#ruc_empresa").focus();
                        return false;
                    }

              },
              beforeSend: function(objeto){
              },
              complete: function(){
              }
    });
    return false;

}

function validarRegistroCliente(form) {

    var nombre = form.nombre_cliente.value;
    var apellidos = form.apellidos_cliente.value;
    var email = form.email_cliente.value;
    var telefono = form.telefono_cliente.value;

	var departamento = form.departamento.value;
    var provincia = form.provincia.value;
    var distrito = form.distrito.value;
    var privacidad = form.privacidad.value;
    var url_producto = $("#url_producto").val();
    //alert(url_producto);

    var emailRegex = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;

    if (nombre == "") {
			$(".mensaje_registro_cliente").text('Usted debe ingresar su nombre.');
      $("#nombre_cliente").focus();
			return false;
    }
    if (apellidos == "") {
			$(".mensaje_registro_cliente").text('Usted debe ingresar su apellido.');
      $("#apellidos_cliente").focus();
			return false;
    }
    if (email == "") {
				$(".mensaje_registro_cliente").text('Usted debe ingresar su email.');
        $("#email_cliente").focus();
				return false;
    }
    if (!email.match(emailRegex)) {
        $(".mensaje_registro_cliente").text('Usted debe ingresar un email válido.');
        $("#email_cliente").focus();
        return false;
    }
    if (telefono == "") {
				$(".mensaje_registro_cliente").text('Usted debe ingresar su teléfono.');
        $("#telefono_cliente").focus();
				return false;
    }
    if (departamento == "") {
				$(".mensaje_registro_cliente").text('Usted debe elegir su Departamento.');
        $("#departamento").focus();
				return false;
    }
    if (provincia == "") {
				$(".mensaje_registro_cliente").text('Usted debe elegir su Provincia.');
        $("#provincia").focus();
				return false;
    }
    if (distrito == "") {
				$(".mensaje_registro_cliente").text('Usted debe elegir su Distrito.');
        $("#distrito").focus();
				return false;
    }
    if($("#privacidad").is(':checked')) {
        var valor_privacidad = '1';
    }else {
        var valor_privacidad = '0';
    }
    if (valor_privacidad == "0") {
        $(".mensaje_registro_cliente").text('Debe aceptar los términos y condiciones.');
        $("#privacidad").focus();
        return false;
    }
    $.ajax({
              type  : "POST",
              url: 'validateUser.php?registro_cliente=1',
              data  : $("#form_registrar_cliente").serialize(),
              success: function(data) {
                    //alert('valor: '+data);
                    
                    if(data==1){
                        //window.location.replace("/cuenta.php?cuenta=bienvenido");
                        $("#nombre_cliente").val('');
                        $("#apellidos_cliente").val('');
                        $("#email_cliente").val('');
                        $("#telefono_cliente").val('');
                        $("#departamento").val('');
                        $("#provincia").val('');
                        $("#distrito").val('');
                        $("#privacidad").val('');
                        $(".mensaje_registro_cliente").text('');
                        
                        $('.close').click();
                        $('.modal-registro-cliente').modal('hide');
                        $('.modal-cotizar-pedido-cliente').modal('show');
                        $(".bloque-pedido-cliente").html('');
                        $.get("ajax.php",{ action:'pedidoCliente',url_producto:url_producto},function(data){
                            $(".bloque-pedido-cliente").append(data);
                        })
                        return false;
                    }else{
                        $("#nombre_cliente").val('');
                        $("#apellidos_cliente").val('');
                        $("#email_cliente").val('');
                        $("#telefono_cliente").val('');
                        $("#departamento").val('');
                        $("#provincia").val('');
                        $("#distrito").val('');
                        $("#privacidad").val('');
                        $(".mensaje_registro_empresa").text('Su RUC e Email ya fueron registrados.');
                        $("#ruc").focus();
                        return false;
                    }
                    

              },
              beforeSend: function(objeto){
              },
              complete: function(){
              }
    });

    return false;
    /*
    $.ajax({
              type  : "POST",
              url: 'validateUser.php?registro_cliente=1',
              data  : $("#form_registrar_cliente").serialize(),
              success: function(data) {
                    //alert(data);
                    if(data==1){
                        //window.location.replace("/cuenta.php?cuenta=bienvenido");
                        $("#nombre_cliente").val('');
                        $("#apellidos_cliente").val('');
                        $("#email_cliente").val('');
                        $("#telefono_cliente").val('');
                        $("#departamento").val('');
                        $("#provincia").val('');
                        $("#distrito").val('');
                        $("#privacidad").val('');
                        $(".mensaje_registro_cliente").text('');
                        var URLactual = window.location;
                      	window.location.replace(URLactual);
                    }else{
                        $("#nombre_cliente").val('');
                        $("#apellidos_cliente").val('');
                        $("#email_cliente").val('');
                        $("#telefono_cliente").val('');
                        $("#departamento").val('');
                        $("#provincia").val('');
                        $("#distrito").val('');
                        $("#privacidad").val('');
                        $(".mensaje_registro_empresa").text('Su RUC e Email ya fueron registrados.');
												$("#ruc").focus();
                        return false;
                    }

              },
              beforeSend: function(objeto){
              },
              complete: function(){
              }
    });

    return false;
    */

}

/*** INICIO MODAL DESCRIPCION DE TRABAJA CON NOSOTROS ***/

function openModalDescripcionCargo(id_bolsa_trabajo) {
    
    $.ajax({
              type  : "GET",
              url: 'ajax.php?action=descripcionCargo&id_bolsa_trabajo='+id_bolsa_trabajo,
              //data  : $("#form_logeo_cliente").serialize(),
              success: function(data) {
                        $('.modal-descripcion-cargo').modal('show');
                        $(".bloque-oportunidad-laboral").html('');
                        $(".bloque-oportunidad-laboral").append(data);
              },
              beforeSend: function(objeto){

              },
              complete: function(){
              }
    });
    return false;

}
/*** FIN MODAL DESCRIPCION DE TRABAJA CON NOSOTROS ***/


/*** INICIO MODAL COTIZACION ***/ 
function validarLogeoCliente(form) {

    var email = form.mail_cliente.value;
    var url_producto = $("#url_producto").val();

    var emailRegex = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;

        if (email == "") {
                $(".mensaje-logeo-cliente").text('Usted debe ingresar su email.');
        $("#mail_cliente").focus();
                return false;
    }
    if (!email.match(emailRegex)) {
        $(".mensaje-logeo-cliente").text('Usted debe ingresar un email válido.');
        $("#mail_cliente").focus();
        return false;
    }

    $.ajax({
              type  : "POST",
              url: 'validateUser.php?logeo_sistema_cliente=1&email='+email,
              data  : $("#form_logeo_cliente").serialize(),
              success: function(data) {
                    //alert(data);
                    if(data==1){
                        $('.modal-logeo-cliente').modal('hide');
                        $('.modal-cotizar-pedido-cliente').modal('show');
                        $(".bloque-pedido-cliente").html('');
                        $.get("ajax.php",{ action:'pedidoCliente',url_producto:url_producto},function(data){
                            $(".bloque-pedido-cliente").append(data);
                        })
                    }else{
                        $("#email_cliente").val('');
                        $(".mensaje-logeo-cliente").text('El email ingresado no existe.');
                        $("#email_cliente").focus();
                        return false;
                    }
              },
              beforeSend: function(objeto){

              },
              complete: function(){
              }
    });
    return false;

}
function validarLogeoEmpresa(form) {

    var email = form.email_empresa.value;
    var ruc = form.ruc.value;
    //var url_producto = $("#url_producto").val();
    var emailRegex = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;

    if (ruc == "") {
        $(".mensaje-logeo-empresa").text('Usted debe ingresar su ruc.');
        $("#ruc_empresa").focus();
        return false;
    }
    if (!ruc.match(/^[0-9]+$/)) {
        $(".mensaje-logeo-empresa").text('Usted debe ingresar un ruc válido.');
        $("#ruc_empresa").val('');
        $("#ruc_empresa").focus();
        return false;
    }
    if (ruc.length < 11 || ruc.length > 12 ) {
        $(".mensaje-logeo-empresa").text('Usted debe ingresar un RUC de 11 dígitos.');
        $("#ruc").focus();
        return false;
    }
    if (email == "") {
        $(".mensaje-logeo-empresa").text('Usted debe ingresar su email.');
        $("#email_empresa").focus();
        return false;
    }
    if (!email.match(emailRegex)) {
        $(".mensaje-logeo-empresa").text('Usted debe ingresar un email válido.');
        $("#email_empresa").focus();
        return false;
    }
    
    $.ajax({
              type  : "POST",
              url   : 'validateUser.php?logeo_sistema_empresa=1&email='+email+'&ruc='+ruc,
              data  : $("#form_logeo_empresa").serialize(),
              success: function(data) {
                    //alert(data);
                    if(data==1){
                        $("#ruc").val('');
                        $("#email_empresa").val('');
                        $(".mensaje-logeo-empresa").text('');
                        $('.modal-logeo-empresa').modal('hide');
                        $('.modal-cotizar-pedido-empresa').modal('show');
                        $(".bloque-pedido-empresa").html('');
                        $.get("ajax.php",{ action:'pedidoEmpresa'},function(data){
                            $(".bloque-pedido-empresa").append(data);
                        })
                    }else{
                        $("#ruc").val('');
                        $("#email_empresa").val('');
                        $(".mensaje-logeo-empresa").text('El ruc e email ingresado deben existir.');
                        $("#ruc").focus();
                        return false;
                        //alert('incorrecto');
                    }
              },
              beforeSend: function(objeto){

              },
              complete: function(){
              }
    });
    return false;

}
function eliminar_bloque_colores(id) {
    $(".bloque_color_"+id).css("display", "none");
    $(".bloque_color_"+id).remove(); //elimino un bloque
    return false;
                                            
}
function modificar_cesta_empresa(id) {
   $("#cantidad_empresa_"+id).css("border", "1px solid rgb(193, 203, 224)");
   $("#cantidad_empresa_"+id).focus();
   $("#cantidad_empresa_"+id).select();
   return false;                           
}
function eliminar_cesta_empresa(id) {
    //var ruta_producto = $("#valor_url_producto").val();
    //var ruta=$("#ruta_web").val();
    $.ajax({
            type  : "POST",
            url: url_web+"ajax.php?action=eliminarCestaCliente&id_producto_color="+id,
            data  : '',
            success: function(data) {
                //alert('mundo');
                $(".bloque_producto_color_"+id).css("display", "none");
                $(".bloque_producto_color_"+id).remove(); //elimino un bloque
            },
            beforeSend: function(objeto){

            },
            complete: function(){
            }
    });
    return false;
                                            
}
function anularCotizacionEmpresa() {
    $('.modal-cotizar-pedido-empresa').modal('hide');
    $.ajax({
            type  : "POST",
            url: url_web+"ajax.php?action=anularCotizacionCliente",
            data  : '',
            success: function(data) {
                //var ruta_producto = $("#url_producto").val();
                //window.location.replace(ruta_producto);
                window.location.reload();
            },
            beforeSend: function(objeto){

            },
            complete: function(){
            }
    });
    return false;
}
/*** FIN MODAL COTIZACION ***/ 

/*** INICIO MODAL COTIZACION FINALIZADA ***/  
function detalleCotizacion() {
    $('.modal-cotizar-pedido-cliente').modal('hide');
    $('.close').click();
    $('.close').click();
    $('.close').click();
    $('.modal-detalle-cotizar-pedido-cliente').modal('show');
    $.get("ajax.php",{ action:'detallePedidoCliente'},function(data){
       $(".bloque-detalle-pedido-cliente").append(data);
    })     
}
/*** FIN MODAL COTIZACION FINALIZADA ***/ 


/*
function validarLogeoCliente(form) {

    var email = form.mail_cliente.value;

    var emailRegex = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;

        if (email == "") {
                $(".mensaje-logeo-cliente").text('Usted debe ingresar su email.');
        $("#mail_cliente").focus();
                return false;
    }
    if (!email.match(emailRegex)) {
        $(".mensaje-logeo-cliente").text('Usted debe ingresar un email válido.');
        $("#mail_cliente").focus();
        return false;
    }

    $.ajax({
              type  : "POST",
              url: 'validateUser.php?logeo_sistema_cliente=1&email='+email,
              data  : $("#form_logeo_cliente").serialize(),
              success: function(data) {
                    //alert(data);
                    if(data==1){
                                                $("#email_cliente").val('');
                        $(".mensaje-logeo-cliente").text('');
                                                //var URLactual = window.location;
                        //window.location.replace(URLactual);
                        $('.close').click();
                        id_bolsa_trabajo='1';
                        $.fancybox.showLoading();
                        $this = $(this);
                        $.ajax({
                          type:"POST",
                          cache:false,
                          url: 'pedido_cotizar.php',
                          //data: $this.parents('form.form').serialize(),
                          //data: $this.parents('form_bolsa_trabajo').serialize(),
                          //data:{ id_actividad: id_actividad, edad: edad, documento: documento, tarifa: tarifa },
                          data:{ id_bolsa_trabajo: id_bolsa_trabajo },
                          success: function(data) {
                            $.fancybox.hideLoading();
                            $.fancybox({
                              content   : data,
                              width   : 500,
                              fitToView : false,
                              autoSize  : true,
                              closeClick  : false,
                              closeBtn  : true,
                              padding   : 0,
                              'autoDimensions':true,
                              'scrolling':'no',
                              afterShow : function(){

                                }
                            });
                          }
                        });
                        return false;
                    }else{
                                                $("#email_cliente").val('');
                                                $(".mensaje-logeo-cliente").text('El email ingresado no existe.');
                                                $("#email_cliente").focus();
                                                return false;
                    }
              },
              beforeSend: function(objeto){

              },
              complete: function(){
              }
    });
    return false;
    
}

function productosController($scope,$http) {
        //Cada vez que modifiquemos el contenido del campo de texto haremos una petición a nuestra base de datos con valores relacionados
        var ruta=$("#ruta_web").val();
        $scope.cargaProductos = function(){
          //alert($scope.producto);
          $http({url: ruta+"json.php",
                 method: "GET",
                 params: {producto: $scope.producto}
          })
          .success(function(productos) {
              //alert(productos[0]['nombre_producto']);
              $scope.productos = productos;
          });
        }

        $scope.cambiaProducto = function(nombre,categoria){
          $scope.producto = nombre;
          $scope.productos = null;
          var producto_guion = nombre.replace(/ /g,'-');
          var producto = producto_guion.toLowerCase();
          var categoria_guion = categoria.replace(/ /g,'-');
          var categoria = categoria_guion.toLowerCase();
          var detalle_producto=ruta+categoria+'/'+producto;
          //$(location).attr('href', 'http://www.medicalaudicion.com/medical/'+producto);
          $(location).attr('href', detalle_producto);
        }
}
*/

function validate_pregunta_maestro(form){

    var nombre = form.nombre.value;
    var apellidos = form.apellidos.value;
    var email = form.email.value;
    var telefono = form.telefono.value;
    var pregunta = form.pregunta.value;
    var departamento = form.departamento.value;
    var distrito = form.distrito.value;
    var provincia = form.provincia.value;
   
    var emailRegex = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;

    if(nombre == "") {
      $(".mensaje-pregunta-maestro").text("Debe ingresar su nombre.");
      $("#nombre_pregunta_maestro").focus();
      return false;
    }
    if(apellidos == "") {
      $(".mensaje-pregunta-maestro").text("Debe ingresar su apellido.");
      $("#apellidos_pregunta_maestro").focus();
      return false;
    }
    if(email == "") {
      $(".mensaje-pregunta-maestro").text("Debe ingresar su Email.");
      $("#email_pregunta_maestro").focus();
      return false;
    }
    if(!email.match(emailRegex)) {
      $(".mensaje-pregunta-maestro").text("Debe ingresar un email válido.");
      $("#email_pregunta_maestro").focus();
      return false;
    }
    if(telefono == "") {
      $(".mensaje-pregunta-maestro").text("Debe ingresar su teléfono.");
      $("#telefono_pregunta_maestro").focus();
      return false;
    }
    if(departamento == "") {
      $(".mensaje-pregunta-maestro").text("Debe ingresar un departamento.");
      $("#departamento_maestro").focus();
      return false;
    }
    if(provincia == "") {
      $(".mensaje-pregunta-maestro").text("Debe ingresar su provincia.");
      $("#provincia_maestro").focus();
      return false;
    }
    if(distrito == "") {
      $(".mensaje-pregunta-maestro").text("Debe ingresar su distrito.");
      $("#distrito_maestro").focus();
      return false;
    }
    if(pregunta == "") {
      $(".mensaje-pregunta-maestro").text("Debe ingresar su pregunta.");
      $("#pregunta_pregunta_maestro").focus();
      return false;
    }

    $.fancybox.showLoading();
    var interval;
    $.ajax({
        type: "GET",
        url: "ajax.php",
        data : $("#form_pregunta_maestro").serialize(),
        beforeSend: function(objeto){ },
        success: function(data){
          //alert(data);
            $('.modal-pregunta').modal('hide');
            $.fancybox.hideLoading();
            $("#nombre_pregunta_maestro,#apellidos_pregunta_maestro,#email_pregunta_maestro,#telefono_pregunta_maestro,#pregunta_pregunta_maestro").val('');
            $('.modal-pregunta-mensaje').modal('show');
            setTimeout(function(){
                $('.modal-pregunta-mensaje').modal('hide');
            },8000)
        },
        complete:function(){
        }
    });

    return false;

}

/*** INICIO VALIDACION DE MODALES ***/

function validarDescargaGuiaDecorativa(form){

    var file = $("#file_download").val();
    var email = $("#email_guia").val();
    var nombre = $("#nombre_guia").val();
    var telefono = $("#telefono_guia").val();
    var filter = /^[0-9-+]+$/;
    var emailRegex = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;

    if(nombre == "") {
      $(".mensaje-descarga-guia-decorativa").text("Debe ingresar un nombre.");
      $("#nombre_guia").focus();
      return false;
    }
    if(telefono == "") {
      $(".mensaje-descarga-guia-decorativa").text("Debe ingresar un teléfono.");
      $("#telefono_guia").focus();
      return false;
    }
    if(!filter.test(telefono)) {
      $(".mensaje-descarga-guia-decorativa").text("Debe ingresar un teléfono válido.");
      $("#telefono_guia").val("");
      $("#telefono_guia").focus();
      return false;
    }
    if(email == "") {
      $(".mensaje-descarga-guia-decorativa").text("Debe ingresar un email.");
      $("#email_guia").focus();
      return false;
    }
    if(!email.match(emailRegex)) {
      $(".mensaje-descarga-guia-decorativa").text("Debe ingresar un email válido.");
      $("#email_guia").focus();
      return false;
    }

    var interval;
    
    $.ajax({
        type: "GET",
        url: url_web+"ajax.php?action=guiaDecorativa", //url: "ajax.php?action=GuardarConsulta",
        data : $("#descarga_guia_decorativa").serialize(),
        beforeSend: function(objeto){
        },
        success: function(data){
            if (parseInt(data)==1){
              $("#nombre_guia").val('');  
              $("#telefono_guia").val('');  
              $("#email_guia").val('');  
              $(".mensaje-descarga-guia-decorativa").text('');  
              $('.modal-guia-decorativa').modal('hide');
              $('.modal-mensaje-guia-decorativa').modal('show');
              //$.fancybox.hideLoading();
              window.location = url_web+"download.php?file=aplication/webroot/archivos/"+file;
              setTimeout(function(){
                 $('.modal-mensaje-guia-decorativa').modal('hide');
              },5000)
            }

        },
       complete:function(){
       }
    });

    return false;
}

function descargarFichaTecnica(ficha_tecnica) {
  //var ruta=$("#ruta_web").val();
  window.location = url_web+"download.php?file=aplication/webroot/archivos/"+ficha_tecnica;
  return false;
}

/*** FIN VALIDACION DE MODALES ***/

function anularCotizacion() {
    $('.modal-cotizar-pedido-cliente').modal('hide');
    $.ajax({
            type  : "POST",
            url: url_web+"ajax.php?action=anularCotizacionCliente",
            data  : '',
            success: function(data) {
            var ruta_producto = $("#url_producto").val();
            window.location.replace(ruta_producto);
            },
            beforeSend: function(objeto){

            },
            complete: function(){
            }
    });
    return false;
}
/*
function cambiaProducto(nombre,color) {

    var pared_temporal = $('#pared_temporal').val();
    $("#nombre_producto").val(nombre);
    if (pared_temporal=='1') {
        $('#color_01_producto').val(color);
    } else {
        $('#color_02_producto').val(color);
    }
    console.log('entro a cambiaProducto');
}
*/
function cambiaProducto(nombre,color) {
    var id  = $('#id_temporal_drog').val();
    $(".move-cuadro-color-"+id).addClass('posicion-base');
    //console.log('entro a cambiaProducto');
}
$(document).ready(function(){
    
    $('.listado-colores').on('click touchstart', function(e) {
        var pared_temporal = $('#pared_temporal').val();
        var nombre  = $(this).data('nombre');
        var color  = $(this).data('color');
        var id  = $(this).data('id');
        $('#id_temporal_drog').val(id);
        //console.log('valores :'+color+'-'+nombre+'-'+pared_temporal);
        $("#nombre_producto").val(nombre);
        if (pared_temporal=='2') {
            $('#color_01_producto').val(color);
            //console.log('entro a 1:'+color);
        } else {
            $('#color_02_producto').val(color);
            //console.log('entro a 0:'+color);
        }
        //alert("touchstart: "+nombre+'-'+color);          
    });
    /*
    $('.cuadro-color').on('click touchstart', function(e) {
        $(this).removeClass('posicion-base');
    });
    */
    
    
    /*** INICIO MODAL BUSCADOR PRODUCTO LIMPIADOR***/
    $('.link-buscador-producto').on('click', function(ev) {
        $(".mensaje-calculo").text('por calcular');
    });

    /*** INICIO MODAL BUSCADOR ASESORIA RECLAMO ***/
    $("#buscador_producto_reclamo").autocomplete({
        //source: "search.php?tipe=id_producto",
        source: "search.php?tipe=rendimiento",
        minLength: 2,
        select: function( event, ui ) {
            cargardatosreclamo(ui.item.id, 1);
        }
    });
    function cargardatosreclamo(datos,id) {
        //var ruta=$("#ruta_web").val();
        var listadatos = new Array();
        listadatos = datos.split('+');
        var cadena=listadatos[0]; //trae el id del producto
        //alert(cadena);
        //$("#id_bloque_producto_color").val(cadena);
    }
    /*** FIN MODAL BUSCADOR ASESORIA RECLAMO ***/

  /*** INICIO MODAL PEDIDO CLIENTE ***/
  $('.link-pedido').on('click', function(ev) {

        var pedido_cliente = $("#cantidad_pedido_cliente").val();
        //alert(pedido_cliente);
        if(pedido_cliente == "0") {
            var cadena=url_web+"línea-decorativa";
            //alert(cadena);
            window.location=cadena;
        }else{
            $('.modal-registro-cliente').modal('show');
        }
        
        
  });
  /*** FIN MODAL PEDIDO CLIENTE ***/  

  /*** INICIO MODAL RECOMENDAR A UN AMIGO ***/
  $('.recomendar-amigo').on('click', function(ev) {
      //var titulo  = $(this).data('titulo');
      var url_compartir_amigo  = $(this).data('url');
      //alert(url_compartir_amigo);
      //$(".modal-correo #titulo").val( titulo );
      $(".modal-enviar-amigo .modal-content .url_enviar_amigo").text( url_compartir_amigo );
  });
  /*** FIN MODAL RECOMENDAR A UN AMIGO ***/

  /*** INICIO MODAL GUIA DECORATIVA ***/
  $('.modal-formulario-guia-decorativa').on('click', function(ev) {
      var url_pdf  = $(this).data('pdf');
      $(".modal-guia-decorativa .guia-decorativa-seccion #file_download").val( url_pdf );
  });
  /*** FIN MODAL GUIA DECORATIVA ***/

  /*** INICIO MODAL REGISTRAR POSTULANTE GENERAL ***/
  $('.registrar-postulante-general').on('click', function(ev) {
      $("#area").val('');
      $("#cargo").val('');
      $(".pages-iframe-total #area").attr("disabled", false);
      $(".pages-iframe-total #cargo").attr("disabled", false);
  });
  /*** FIN MODAL REGISTRAR POSTULANTE GENERAL ***/

  /*** INICIO MODAL REGISTRAR POSTULANTE ***/
  $('.registrar-postulante-new').on('click', function(ev) {
      var id_bolsa_trabajo  = $(this).data('id');
      //alert('hola:'+id_bolsa_trabajo);
      //$(".pages-iframe-total #id_bolsa_trabajo").val( id_bolsa_trabajo );
      $(".pages-iframe-total .id-bolsa-trabajo").text( id_bolsa_trabajo );
      $(".pages-iframe-total #area").val( '' );
      $(".pages-iframe-total #cargo").val( '' );
      $(".pages-iframe-total #area").attr("disabled", false);
      $(".pages-iframe-total #cargo").attr("disabled", false);
      //$(".modal-registrar-postulante .registrar-postulante .id_bolsa_trabajo").text( id_bolsa_trabajo );
      //$(".modal-registrar-postulante .registrar-postulante #id_bolsa_trabajo").val( id_bolsa_trabajo );
  });
  /*** FIN MODAL REGISTRAR POSTULANTE ***/

  /*** INICIO BUSCADOR DE PRODUCTOS ***/
  $("#ac-gn-searchform-input").autocomplete({
                source: "search.php?tipe=dni",
                minLength: 2,
                select: function( event, ui ) { 
                    cargardatos(ui.item.id, 1);
                }
  });
  
  $("#buscador").autocomplete({
                source: "search.php?tipe=dni",
                minLength: 2,
                select: function( event, ui ) { 
                    cargardatos(ui.item.id, 1);
                }
  });
  /*** FIN BUSCADOR DE PRODUCTOS ***/

   function cargardatos(datos,id) {

    //var ruta=$("#ruta_web").val();
    var listadatos = new Array();
    listadatos = datos.split('+');
    var cadena=listadatos[0];
    window.location=url_web+cadena;
    window.location=cadena;
  }

	$("#departamento").change(function(){
        $("#departamento option:selected").each(function () {
            departamento = $(this).val();
            //var ruta=$("#ruta_web").val();
            $.post(url_web+"ajax.php",{seccion: 'ubigeoHabilitadas',action:'ProvinciasHabilitadas', id: departamento }, function(data){
                //alert(data);// data normal se ve como json no se ve
                $(".provincia").slideDown(250);
                $("#distrito").html("<option>Seleccione un distrito ...</option>");
                $("#provincia").children().remove();
                $("#provincia").append('<option value="">Seleccione una provincia ...</option>');
                $.each(data, function(i, item) {
                  $("#provincia").append('<option value="'+item.codprov+'">'+item.nombre+'</option>')
                  //alert(item.nombre);
                });
            //}); //si queremos que sea data normal y el otro si es json formato
            },'json');
        });
    });

	$("#provincia").change(function(){
        $("#provincia option:selected").each(function () {
            provincia = $(this).val();
            var departamento=$("#departamento").val();
            //var ruta=$("#ruta_web").val();
            $.post(url_web+"ajax.php",{seccion: 'ubigeoHabilitadas',action:'DistritosHabilitadas', departamento: departamento, provincia: provincia }, function(data){
                $(".distrito").slideDown(250);
                $("#distrito").children().remove();
                $("#distrito").append('<option value="">Seleccione un distrito ...</option>');
                $.each(data, function(i, item) {
                    $("#distrito").append('<option value="'+item.coddist+'">'+item.nombre+'</option>')
                });
            },'json'); //});
        });
    });

    $("#distrito").change(function(){
        $("#distrito option:selected").each(function () {
						//var ruta=$("#ruta_web").val();
            var departamento=$("#departamento").val();
            var provincia=$("#provincia").val();
            distrito = $(this).val();
						//alert(departamento+'-'+provincia+'-'+distrito); //15 01 03
						document.form_donde_comprar.action=url_web+'donde-comprar';
            document.form_donde_comprar.submit();
        });
    });

    /*** INICIO DE UBIGIO MODAL REGISTRAR CLIENTE ***/

    $("#departamento_cliente").change(function(){
        $("#departamento_cliente option:selected").each(function () {
            departamento = $(this).val();
            //var ruta=$("#ruta_web").val();
            $.post(url_web+"ajax.php",{seccion: 'ubigeo',action:'Provincias', id: departamento }, function(data){
                //alert(data);// data normal se ve como json no se ve
                $(".provincia").slideDown(250);
                $("#distrito_cliente").html("<option>Seleccionar distrito</option>");
                $("#provincia_cliente").children().remove();
                $("#provincia_cliente").append('<option value="">Seleccionar provincia</option>');
                $.each(data, function(i, item) {
                  $("#provincia_cliente").append('<option value="'+item.codprov+'">'+item.nombre+'</option>')
                  //alert(item.nombre);
                });
            //}); //si queremos que sea data normal y el otro si es json formato
            },'json');
        });
    });

    $("#provincia_cliente").change(function(){
        $("#provincia_cliente option:selected").each(function () {
            provincia = $(this).val();
            var departamento=$("#departamento_cliente").val();
            //var ruta=$("#ruta_web").val();
            $.post(url_web+"ajax.php",{seccion: 'ubigeo',action:'Distritos', departamento: departamento, provincia: provincia }, function(data){
                $(".distrito").slideDown(250);
                $("#distrito_cliente").children().remove();
                $("#distrito_cliente").append('<option value="">Seleccionar distrito ...</option>');
                $.each(data, function(i, item) {
                    $("#distrito_cliente").append('<option value="'+item.coddist+'">'+item.nombre+'</option>')
                });
            },'json'); //});
        });
    });

    $("#distrito_cliente").change(function(){
        $("#distrito_cliente option:selected").each(function () {
            //var ruta=$("#ruta_web").val();
            var departamento=$("#departamento_cliente").val();
            var provincia=$("#provincia_cliente").val();
            distrito = $(this).val();
            //alert(departamento+'-'+provincia+'-'+distrito); //15 01 03
            document.form_donde_comprar.action=url_web+'donde-comprar';
            document.form_donde_comprar.submit();
        });
    });

    /*** FIN DE UBIGIO MODAL REGISTRAR CLIENTE ***/

    /*** INICIO DE UBIGIO PREGUNTALE MAESTRO ***/

    $("#departamento_maestro").change(function(){
        $("#departamento_maestro option:selected").each(function () {
            departamento = $(this).val();
            //var ruta=$("#ruta_web").val();
            $.post(url_web+"ajax.php",{seccion: 'ubigeo',action:'Provincias', id: departamento }, function(data){
                //alert(data);// data normal se ve como json no se ve
                $(".provincia").slideDown(250);
                $("#distrito_maestro").html("<option>Seleccionar distrito</option>");
                $("#provincia_maestro").children().remove();
                $("#provincia_maestro").append('<option value="">Seleccionar provincia</option>');
                $.each(data, function(i, item) {
                  $("#provincia_maestro").append('<option value="'+item.codprov+'">'+item.nombre+'</option>')
                  //alert(item.nombre);
                });
            //}); //si queremos que sea data normal y el otro si es json formato
            },'json');
        });
    });

    $("#provincia_maestro").change(function(){
        $("#provincia_maestro option:selected").each(function () {
            provincia = $(this).val();
            var departamento=$("#departamento_maestro").val();
            //var ruta=$("#ruta_web").val();
            $.post(url_web+"ajax.php",{seccion: 'ubigeo',action:'Distritos', departamento: departamento, provincia: provincia }, function(data){
                $(".distrito").slideDown(250);
                $("#distrito_maestro").children().remove();
                $("#distrito_maestro").append('<option value="">Seleccionar distrito ...</option>');
                $.each(data, function(i, item) {
                    $("#distrito_maestro").append('<option value="'+item.coddist+'">'+item.nombre+'</option>')
                });
            },'json'); //});
        });
    });

    /*** FIN DE UBIGIO PREGUNTALE MAESTRO ***/


	$(".descargar-catalogo").click(function(){

/*
		var file = $("#file_download").val();
		var email = $("#email_guia").val();
		var nombre = $("#nombre_guia").val();
		var telefono = $("#telefono_guia").val();

		var filter = /^[0-9-+]+$/;
		var emailRegex = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;


		if(nombre == "") {
			$(".mensaje-descarga-guia-decorativa").text("Usted debe ingresar su nombre.");
			$("#nombre_guia").focus();
			return false;
		}
		if(telefono == "") {
			$(".mensaje-descarga-guia-decorativa").text("Usted debe ingresar su teléfono.");
			$("#telefono_guia").focus();
			return false;
		}
		if(!filter.test(telefono)) {
			$(".mensaje-descarga-guia-decorativa").text("El teléfono ingresado es incorrecto.");
			$("#telefono_guia").val("");
			$("#telefono_guia").focus();
			return false;
		}
		if(email == "") {
			$(".mensaje-descarga-guia-decorativa").text("Usted debe ingresar su Email.");
			$("#email_guia").focus();
			return false;
		}
		if(!email.match(emailRegex)) {
			$(".mensaje-descarga-guia-decorativa").text("Ha introducido una dirección de correo electrónico no válida..");
			$("#email_guia").focus();
			return false;
		}

		$.fancybox.showLoading();

		var interval;
    var ruta=$("#ruta_web").val();
		$.ajax({
			  type: "GET",
			  url: ruta+"ajax.php",
			  data : $("#descarga_guia_decorativa").serialize(),
			  beforeSend: function(objeto){},
	  		success: function(data){

  				  if (parseInt(data)==1){
  						$('.modal-power').modal('hide');
  						$('.modal-mensaje').modal('show');
  						$.fancybox.hideLoading();
              window.location = ruta+"download.php?file=aplication/webroot/archivos/"+file;
  						$("#nombre_guia,#email_guia,#telefono_guia").val('');
  						setTimeout(function(){
                 $('.modal-mensaje').modal('hide');
              },3000)
  					}

	  		},
			 complete:function(){
			 }
		});

  		return false;
      */
	});





});

function validate_promociones(form) {

  var nombre = form_promociones.nombre.value;
  var email = form_promociones.email.value;
  var emailRegex = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;

  if(nombre == "") {
    $("#nombre").focus();
    $(".mensaje_promociones").text('Ingresa Tu Nombre.');
    return false;
  }
  if(email == "") {
    $("#email").focus();
	  $(".mensaje_promociones").text('Ingresa Tu E-mail.');
	  return false;
  }
  if(!email.match(emailRegex)) {
    $("#email").focus();
	  $(".mensaje_promociones").text('Ingresar un E-mail Válido.');
    return false;
  }
  if(document.getElementById('acepto').checked == false){
    $(".mensaje_promociones").text('Acepta nuestra Política de Seguridad y Privacidad.');
    return false;
  }

  var interval;
  //var ruta=$("#ruta_web").val();
  $.ajax({
      type: "POST",
       url: url_web+"ajax.php?action=GuardarConsulta",
      data: $("#form_promociones").serialize(),
      beforeSend: function(objeto){
        $(".mensaje_promociones").text('Enviando el Formulario ...');
      },
      success: function(msg){
        $(".mensaje_promociones").text('Gracias por registrarte, te enviaremos nuestras últimas novedades');
        $(".mensaje_promociones").fadeOut(5000);
      },
     complete:function(data){
       $("#nombre").val("");
       $("#email").val("");
       document.form_promociones.acepto.checked=0;
       $("#nombre").focus();
     }
  });
  return false;

}

/*** INICIO SECCION CONTACTENOS ***/
function validate_contactenos(form) {

  var nombre = form.nombre_contacto.value;
  var apellidos = form.apellidos_contacto.value;
	var email = form.email_contacto.value;
  var telefono = form.telefono_contacto.value;
	//var asunto = form.asunto.value;
	var comentario = form.comentario_contacto.value;

  var emailRegex = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;
	var numeroRegex = /^-?[0-9]*$/;

  if(nombre == "") {
    $("#nombre_contacto").focus();
    $(".mensaje-contactenos").text('Usted debe ingresar su nombre.');
    return false;
  }
	if(apellidos == "") {
    $("#apellidos_contacto").focus();
    $(".mensaje-contactenos").text('Usted debe ingresar su apellido.');
    return false;
  }
  if(email == "") {
    $("#email_contacto").focus();
	  $(".mensaje-contactenos").text('Usted debe ingresar su correo electrónico.');
	  return false;
  }
  if(!email.match(emailRegex)) {
    $("#email_contacto").focus();
	  $(".mensaje-contactenos").text('Ha introducido un correo electrónico inválido.');
    return false;
  }
	if(telefono == "") {
		$("#telefono_contacto").focus();
		$(".mensaje-contactenos").text('Usted debe ingresar su teléfono.');
		return false;
	}
	/*
	if(asunto == "0") {
		$("#asunto").focus();
		$(".mensaje-contactenos").text('Usted debe escoger un asunto.');
		return false;
	}
	*/
	if(comentario == "") {
		$("#comentario_contacto").focus();
		$(".mensaje-contactenos").text('Usted debe ingresar su comentario.');
		return false;
	}
	var interval;
	//var ruta=$("#ruta_web").val();
  $.ajax({
      	type: "POST",
        //url: "enviar_contactenos.php",
				url: url_web+"ajax.php?action=contactenos",
        data: $("#form_contactenos").serialize(),
		    beforeSend: function(objeto){
		        $(".loading-contactenos").text('Enviando el Formulario ...');
						var point = ($(".loading-contactenos").text()).length + 3;
	          interval = window.setInterval(function(){
								var text = $(".loading-contactenos").text();
								if (text.length < point){
									$(".loading-contactenos").text(text + '.');
								}else {
									$(".loading-contactenos").text('Enviando el Formulario ...');
								}
						}, 200);
        },
        success: function(data){
					//alert(data);
	        window.clearInterval(interval);
	      	$(".confirmacion-contactenos").slideDown("slow");
        },
        complete:function(){
					setTimeout("clear_contactenos()",5000)
				}
  });

	return false;

}

function clear_contactenos(){
	$("#nombre_contacto").val("");
	$("#apellidos_contacto").val("");
	$("#email_contacto").val("");
	$("#telefono_contacto").val("");
	$("#comentario_contacto").val("");
	$("#nombre_contacto").focus();
	$(".loading-contactenos").text("").show();
	$(".confirmacion-contactenos").slideUp("fast");
    $(".mensaje-contactenos").text('');
}
/*** FIN SECCION CONTACTENOS ***/

/*RECORRIDO COLUMNAS DE DIV: CAPTURA EL ALTO MAYOR Y AUTOMATICAMENTE SE PONE A TODOS LOS DIV
ESO AYUDA PARA ALTO VARIANTES DE DIV*/
function equalHeight(group) {
        tallest = 0;
        if (group!=null) {
            group.each(function() {
              thisHeight = $(this).height();
              if(thisHeight > tallest) {
                     tallest = thisHeight;
              }
            });
             group.height(tallest);
        };

}