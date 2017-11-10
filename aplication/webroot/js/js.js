// JavaScript Document
$(window).load(function() {

});
$(document).ready(function(){
	  
	var path = 'aplication/webroot/imgs/';
	$.preloadImages(path+'tip.png', path+'li.png', path+'sub_bg.png');

	$(".field").clearField();

	$("#buscar").click( function(){
		var keyword = $("#txtbuscar").val()
		buscar('solucionarios.php',keyword)
	});
	$("#buscar2").click( function(){
		var keyword = $("#txtbuscar2").val()
		buscar('solucionarios.php',keyword)
	});

	$.validator.messages.required = "";
	$.validator.messages.email = "";
	$.validator.messages.equalTo = "";
	$.validator.messages.minlength = "";

	$("#frmeditar").validate({
		errorClass : 'err',
		errorElement : 'em'
	});

	$("#frmvoucher").validate({
		errorClass : 'err',
		errorElement : 'em'
	});

	$("#frmtutoria").validate({
		errorClass : 'err',
		errorElement : 'em'
	});

        $("#universidades").live('change', function(){

            if($("#universidades").val()=="otros"){

               $(".ver_espe").fadeIn("slow");
            }else{

               $(".ver_espe").fadeOut("slow");
            }
        });


	$("#boton_pagare_transferencia").click(function(){
		location.href='pedido.php?step=procesa_pedido&e=P&p=2';
	})

	$("#boton_realizar_pago_saldo").click(function(){
		location.href='pedido.php?step=procesa_pedido&e=F&p=3';
	})

	$('#monto_recargar_paypal').blur(function(){
		if($("#monto_recargar_paypal").val()==""){
	      return false;
		}
	  $("#amount_1").attr("value",Math.round($('#monto_recargar_paypal').val()/$('#tipo_cambio').val()));
	  $("#custom").attr("value",$('#monto_recargar_paypal').val());
	  if(!confirm("El monto a recargar es de: S/. "+$('#monto_recargar_paypal').val())){
		  return false;
	  }else{
	      $('#checkout_confirmation').submit();
	  }
    });


	$("#especialidad_tutor").change( function(){
		$.post("ajax.php?action=CargaTutores",{id:$(this).val().split("-")[0]}, function(data){
			$("#tutores_horas option").not(':first').remove();
			$("#tutores_horas").append(data);
		});
	});

	$("#tutores_horas").change( function(){
		$.post("ajax.php?action=CargaHorarios",{id:$(this).val().split("-")[0]}, function(data){
			$("#horarios_view div").remove();
			$("#horarios_view").append(data);
			$("#horarios_view").fadeIn("slow");

		});
	});




});

jQuery.preloadImages = function()
{
  for(var i = 0; i<arguments.length; i++)
  {
    jQuery("<img>").attr("src", arguments[i]);
  }
}

function deleteRow(id, num){
	$(".body-cesta").css("opacity","0.3");
	$(".loading").show();
	$.get('operations.php',{param:'delete-row', id:id}, function(data){
		var resumen = data.split("|");
		$(".articles").text((resumen[1] == 1) ? "1 item" : resumen[1]+" items");
		var total = (parseFloat(resumen[2])).toFixed(2)
		$("#cesta_total h3").html("TOTAL: S/. "+total);
		if(resumen[1] == 0){
			$(".bottom-cesta").remove();
			$("#cesta_compras_content").append('<div class="cesta-nothing"><div class="mensaje_vacio">Su cesta se encuentra vacia</div></div><div align="right" class="btncontinuarcesta"></div>');
			$(".hide_bottom").hide();

		}
		if(resumen[0] == 0){
			$(".info").hide();
		}
		$(".loading").hide();
		$("#"+num).remove();
		$(".body-cesta").css("opacity","10");
	});

}

function openPopup(url, w, h, modo, param){
    $("#TB_window").remove();
    $("body").append("<div id='TB_window'></div>");
    tb_show("", url+"?width="+w+"&height="+h+"&modal="+modo+param, "");
}

function search_enter(e) {
	tecla = (document.all) ? e.keyCode : e.which;
    if (tecla==13){
		buscar('solucionarios.php',document.getElementById("txtbuscar").value);}
	return true;
}
function search_enter2(e) {
	tecla = (document.all) ? e.keyCode : e.which;
    if (tecla==13){
		buscar('solucionarios.php',document.getElementById("txtbuscar2").value);}
	return true;
}
function buscar(url,texto){
	location.replace(url+'?q='+ texto);
}

function busqueda(url,texto){

	document.fbuscar.action = url+'&q=' + texto.value;
	document.fbuscar.submit();
}

function checkTheKey(keyCode){
	if(event.keyCode==13){
		valida();
		return true ;
	}
	return false ;
}

var testresults
function checkemail(value){
	var str = value
	var filter=/^.+@.+\..{2,3}$/
		if (filter.test(str))
		testresults=true
	else{
		testresults=false
	}
	return (testresults)
}

function validateLogin(){
	var f1 = eval("document.login");
	if(f1.email.value == ""){
		alert("Por favor ingrese su email.");
		f1.email.focus();
		return false;
	}else if(checkemail(f1.email.value) == false){
		f1.email.focus();
		return false;
	}else if(f1.password.value == ""){
		alert("Por favor ingrese su contraseña.");
		f1.password.focus();
		return false;
	}
}

function validateSend(){
	var f1 = eval("document.login");
	if(f1.email.value == ""){
		alert("Por favor ingrese su email.");
		f1.email.focus();
		return false;
	}else if(checkemail(f1.email.value) == false){
		f1.email.focus();
		return false;
	}
}

var scrolling = null;
function scroll_up() {
	var d = document.getElementById('scroller');
	d.scrollTop = d.scrollTop - 5;
	scrolling = window.setTimeout(function() {
		scroll_up();
	}, 50);
}
function scroll_down() {
	var d = document.getElementById('scroller');
	d.scrollTop = d.scrollTop + 5;
	scrolling = window.setTimeout(function() {
		scroll_down();
	}, 50);
}
function stop_scroll() {
	window.clearTimeout(scrolling);
}

function next_tutores(v){
	var page = parseInt($(".page_tutor").text()) + 1;
	if(page <= v){
		$("#load_tutores").addClass("loading");
		$(".page_tutor").text(page);
		$.get("ajax.php",{pag:page, param:'page_tutores'},function(data){
			$("#load_tutores").html(data).removeClass("loading");
		});
	}
}

function prev_tutores(v){
	var page = parseInt($(".page_tutor").text()) - 1;
	if(page > 0){
		$("#load_tutores").addClass("loading");
		$(".page_tutor").text(page);
		$.get("ajax.php",{pag:page, param:'page_tutores'},function(data){
			$("#load_tutores").html(data).removeClass("loading");
		});
	}
}



function next_productos(v){
	var page = parseInt($(".page_prod").text()) + 1;

	if(page <= v){
		$("#load_productos").addClass("loading");
		$(".page_prod").text(page);
		$.get("ajax.php",{pag:page, param:'page_prods'},function(data){
			$("#load_productos").html(data).removeClass("loading");
		});
	}
}

function prev_productos(v){
	var page = parseInt($(".page_prod").text()) - 1;
	if(page > 0){
		$("#load_productos").addClass("loading");
		$(".page_prod").text(page);
		$.get("ajax.php",{pag:page, param:'page_prods'},function(data){
			$("#load_productos").html(data).removeClass("loading");
		});
	}
}


function next_productos_rel(v,idp){

	var page = parseInt($(".page_prod").text()) + 1;

	if(page <= v){
		$("#load_productos_relacionados").addClass("loading");
		$(".page_prod").text(page);
		$.get("ajax.php",{pag:page, param:'page_prods_rel', id:idp},function(data){
			$("#load_productos_relacionados").html(data).removeClass("loading");
		});
	}

}

function prev_productos_rel(v,idp){

	var page = parseInt($(".page_prod").text()) - 1;

	if(page > 0){
		$("#load_productos_relacionados").addClass("loading");

		$(".page_prod").text(page);
		$.get("ajax.php",{pag:page, param:'page_prods_rel', id:idp},function(data){
			$("#load_productos_relacionados").html(data).removeClass("loading");
		});
	}

}

function validar_pago(){
	if(!confirm("Esta Seguro de efectuar el pago")){
		return false;
	}else{
		return true;
	}
}
