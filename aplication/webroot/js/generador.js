$(document).ready(function(){
 
	//Checkbox
	$("input[name=marcartodo]").change(function(){
		$('input[type=checkbox]').each( function() {			
			if($("input[name=marcartodo]:checked").length == 1){
				this.checked = true;
			} else {
				this.checked = false;
			}
		});
	});
   
$("#btn_generar").click(function(){         
    validar_checkbox();       
});
        
        
function validar_checkbox() {
    var chks = document.getElementsByName('tablelist[]');
    var hasChecked = false;
    for (var i = 0; i < chks.length; i++) {
        if (chks[i].checked) {
            hasChecked = true;
            break;
        }
    }
    if (hasChecked == false) {
        alert("Please select at least one.");
        return false;
    }
       //alert("Hola mundo");
            $.ajax({
                type : "POST",
                url	:"generar_proceso.php",
                data: $("#formulario_generar").serialize(),
                beforeSend: function(){
                        //$("#load_contacto").slideUp(500);
                        $(".load_process").slideDown(500);
                },
                success: function(datos){
                       $("#contenedor_recarga").html(datos);
                       $(".load_process").slideUp(500);

                       /*$("#correcto_email").slideDown(500);
                       setTimeout('$("#correcto_email").slideUp(500)', 8000);
                       document.getElementById('form').reset();*/

                }
            });
            
    //return true;
}


$("#btn_generar_tabla").click(function(){         
    validar_generador_tabla();       
});

 
 function validar_generador_tabla() {
    var nombre = $("#nombre_tabla").val();
    var prefijo = $("#prefijo_campo").val();
    var campos = $("#val_itemcampo").val();
    var error = "";
    
    
    if (nombre == "") {
      $("#nombre_tabla").addClass("campo-vacio");
      //$("#nombre_tabla").val("ingrese nombre de tabla");
      error += "Ingrese nombre de tabla.<br>";
      
    }else{
      $("#nombre_tabla").removeClass("campo-vacio");
    }
    
    if (prefijo == "") {
      $("#prefijo_campo").addClass("campo-vacio");
      error += "Ingrese prefijo de campo.<br>";
      //$("#nombre_tabla").val("ingrese nombre de tabla");
    }else{
      $("#prefijo_campo").removeClass("campo-vacio");
    }
    
    if (campos == 0) {
      //alert('Agrega un campo por lo menos');
      //$("#nombre_tabla").val("ingrese nombre de tabla");
      error += "Agrege por lo menos un campo.<br>";
    }else{
      $("#prefijo_campo").removeClass("campo-vacio");
    }
    
    if (nombre == "" || prefijo == "" || campos == 0 ) {
        $(".errores_muestra").fadeIn();
        $("#most_error").html(error);
        return false;
    }else{
        $(".errores_muestra").fadeOut();
        
        $.ajax({
        type : "POST",
        url	:"generar_proceso_tabla.php",
        data: $("#formulario_generar_tablas").serialize(),
        beforeSend: function(){
                //$("#load_contacto").slideUp(500);
                $(".load_process").slideDown(500);
        },
        success: function(datos){
               $("#contenedor_recarga").html(datos);
               $(".load_process").slideUp(500);

               /*$("#correcto_email").slideDown(500);
               setTimeout('$("#correcto_email").slideUp(500)', 8000);
               document.getElementById('form').reset();*/

        }
    });
    
        
       
    }
    
 }
 
});



//...................................script COMBOBOX AUTOCOMPLETE------------------------------------

(function( $ ) {
    $.widget( "custom.combobox", {
      _create: function() {
        this.wrapper = $( "<span>" )
          .addClass( "custom-combobox" )
          .insertAfter( this.element );
 
        this.element.hide();
        this._createAutocomplete();
        this._createShowAllButton();
      },
 
      _createAutocomplete: function() {
        var selected = this.element.children( ":selected" ),
          value = selected.val() ? selected.text() : "";
 
        this.input = $( "<input>" )
          .appendTo( this.wrapper )
          .val( value )
          .attr( "title", "" )
          .addClass( "custom-combobox-input ui-widget ui-widget-content ui-state-default ui-corner-left" )
          .autocomplete({
            delay: 0,
            minLength: 0,
            source: $.proxy( this, "_source" )
          })
          .tooltip({
            tooltipClass: "ui-state-highlight"
          });
 
        this._on( this.input, {
          autocompleteselect: function( event, ui ) {
            ui.item.option.selected = true;
            this._trigger( "select", event, {
              item: ui.item.option
            });
          },
 
          autocompletechange: "_removeIfInvalid"
        });
      },
 
      _createShowAllButton: function() {
        var input = this.input,
          wasOpen = false;
 
        $( "<a>" )
          .attr( "tabIndex", -1 )
          .attr( "title", "Show All Items" )
          .tooltip()
          .appendTo( this.wrapper )
          .button({
            icons: {
              primary: "ui-icon-triangle-1-s"
            },
            text: false
          })
          .removeClass( "ui-corner-all" )
          .addClass( "custom-combobox-toggle ui-corner-right" )
          .mousedown(function() {
            wasOpen = input.autocomplete( "widget" ).is( ":visible" );
          })
          .click(function() {
            input.focus();
 
            // Close if already visible
            if ( wasOpen ) {
              return;
            }
 
            // Pass empty string as value to search for, displaying all results
            input.autocomplete( "search", "" );
          });
      },
 
      _source: function( request, response ) {
        var matcher = new RegExp( $.ui.autocomplete.escapeRegex(request.term), "i" );
        response( this.element.children( "option" ).map(function() {
          var text = $( this ).text();
          if ( this.value && ( !request.term || matcher.test(text) ) )
            return {
              label: text,
              value: text,
              option: this
            };
        }) );
      },
 
      _removeIfInvalid: function( event, ui ) {
 
        // Selected an item, nothing to do
        if ( ui.item ) {
          return;
        }
 
        // Search for a match (case-insensitive)
        var value = this.input.val(),
          valueLowerCase = value.toLowerCase(),
          valid = false;
        this.element.children( "option" ).each(function() {
          if ( $( this ).text().toLowerCase() === valueLowerCase ) {
            this.selected = valid = true;
            return false;
          }
        });
 
        // Found a match, nothing to do
        if ( valid ) {
          return;
        }
 
        // Remove invalid value
        this.input
          .val( "" )
          .attr( "title", value + " didn't match any item" )
          .tooltip( "open" );
        this.element.val( "" );
        this._delay(function() {
          this.input.tooltip( "close" ).attr( "title", "" );
        }, 2500 );
        this.input.autocomplete( "instance" ).term = "";
      },
 
      _destroy: function() {
        this.wrapper.remove();
        this.element.show();
      }
    });
  })( jQuery );
 
  $(function() {
    $( "#combobox" ).combobox();
    $( "#toggle" ).click(function() {
      $( "#combobox" ).toggle();
    });
  });




//*********************************AUTOCOMPLETADO -----------------------
$(function() {
    var availableTags = [
      "ActionScript",
      "AppleScript",
      "Asp",
      "BASIC",
      "C",
      "C++",
      "Clojure",
      "COBOL",
      "ColdFusion",
      "Erlang",
      "Fortran",
      "Groovy",
      "Haskell",
      "Java",
      "JavaScript",
      "Lisp",
      "Perl",
      "PHP",
      "Python",
      "Ruby",
      "Scala",
      "Scheme"
    ];
    $( "#txt_tipo_dato" ).autocomplete({
      source: availableTags
    });
  });
  
  
  
  //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
  //*************************************************************************
  //---------------------------------CODIGO DE GENERADOR DE TABLAS------------
  var nextinput = 0;
        function AgregarCampos(){
        nextinput++;
        
        var name_prefijo = $("#prefijo_campo").val();
        //campo = '<li id="rut'+nextinput+'">Campo:<input type="text" size="20" id="campo' + nextinput + '"&nbsp; name="campo' + nextinput + '"&nbsp; /></li>';
        campo = '<div class="items-colums">';
        campo += '<div class="items camp_nomb"><input type="text" class="text_nomb" name="TxtNombreCampo_'+nextinput+'" id="TxtNombreCampo_'+nextinput+'">_<span class="prefijo_fin">'+name_prefijo+'</span></div>';
        campo += '<div class="items">';
        
        //campo += '<input type="text" class="text_tab" id="TxtTipoDato_'+nextinput+'" name="TxtTipoDato_'+nextinput+'" >';
        campo += '<select id="TxtTipoDato_'+nextinput+'" class="text_tab" name="TxtTipoDato_'+nextinput+'">';
        campo += '<option value="">Select one...</option>';
        campo += '<option value="bigint">bigint</option>';
        campo += '<option value="binary">binary</option>';
        campo += '<option value="bit">bit</option>';
        campo += '<option value="blob">blob</option>';
        campo += '<option value="bool">bool</option>';
        campo += '<option value="boolean">boolean</option>';
        campo += '<option value="char">char</option>';
        campo += '<option value="date">date</option>';
        campo += '<option value="datetime">datetime</option>';
        campo += '<option value="decimal">decimal</option>';
        campo += '<option value="double">double</option>';
        campo += '<option value="enum">enum</option>';
        campo += '<option value="float">float</option>';
        campo += '<option value="int">int</option>';
        campo += '<option value="longblob">longblob</option>';
        campo += '<option value="longtext">longtext</option>';
        campo += '<option value="mediumblob">mediumblob</option>';
        campo += '<option value="mediumblob">mediumint</option>';
        campo += '<option value="mediumtext">mediumtext</option>';
        campo += '<option value="numeric">numeric</option>';
        campo += '<option value="real">real</option>';
        campo += '<option value="set">set</option>   ';  
        campo += '<option value="smallint">smallint</option>';
        campo += '<option value="text">text</option>';
        campo += '<option value="time">time</option>';
        campo += '<option value="timestamp">timestamp</option>';
        campo += '<option value="tinyblob">tinyblob</option>';
        campo += '<option value="tinytext">tinytext</option>';
        campo += '<option value="varbinary">varbinary</option>';
        campo += '<option value="varchar">varchar</option>';
        campo += '<option value="year">year</option>    ';
        campo += '</select>';
        
        /*campo += '<select id="combobox_'+nextinput+'" name="combobox_'+nextinput+'">';
        campo += '<option value="">Select one...</option>';
        campo += '<option value="bigint">bigint</option>';
        campo += '<option value="binary">binary</option>';
        campo += '<option value="bit">bit</option>';
        campo += '<option value="blob">blob</option>';
        campo += '<option value="bool">bool</option>';
        campo += '<option value="boolean">boolean</option>';
        campo += '<option value="char">char</option>';
        campo += '<option value="date">date</option>';
        campo += '<option value="datetime">datetime</option>';
        campo += '<option value="decimal">decimal</option>';
        campo += '<option value="double">double</option>';
        campo += '<option value="enum">enum</option>';
        campo += '<option value="float">float</option>';
        campo += '<option value="int">int</option>';
        campo += '<option value="longblob">longblob</option>';
        campo += '<option value="longtext">longtext</option>';
        campo += '<option value="mediumblob">mediumblob</option>';
        campo += '<option value="mediumblob">mediumint</option>';
        campo += '<option value="mediumtext">mediumtext</option>';
        campo += '<option value="numeric">numeric</option>';
        campo += '<option value="real">real</option>';
        campo += '<option value="set">set</option>   ';  
        campo += '<option value="smallint">smallint</option>';
        campo += '<option value="text">text</option>';
        campo += '<option value="time">time</option>';
        campo += '<option value="timestamp">timestamp</option>';
        campo += '<option value="tinyblob">tinyblob</option>';
        campo += '<option value="tinytext">tinytext</option>';
        campo += '<option value="varbinary">varbinary</option>';
        campo += '<option value="varchar">varchar</option>';
        campo += '<option value="year">year</option>    ';
        campo += '</select>';*/
        campo += '</div>';
        campo += '<div class="items camp_tam"><input type="text" name="TxtTamanoDato_'+nextinput+'" id="TxtTamanoDato_'+nextinput+'" class="text_tab"></div>';
        campo += '<div class="items coment"><input type="text" name="TxtComentario_'+nextinput+'" id="TxtComentario_'+nextinput+'" class="text_tab"></div>';
        campo += '<div class="vacio"><span class="not_null campo_null">NOT NULL</span></div>';
        campo += '</div>';
             
        /*$( "#combobox_"+nextinput ).combobox();*/
        
        
        $("#val_itemcampo").val(nextinput);
        
        
        $("#campos").append(campo);
        }
        
        function CopyPrefiijo(){
            var name_prefijo = $("#prefijo_campo").val();
            $( ".prefijo_fin" ).html(name_prefijo);
        }
        
        
        $(document).ready(function(){
                // se ejecuta el evento hover al pasar el mouse por encima
                $(".info1").hover(function(){
                      $(".inf1").css({ visibility: "visible" });
                },function(){
                        // esta función se ejecuta cuando pierde el foco
                      $(".inf1").css({ visibility: "hidden" });
                })
                
                $(".info2").hover(function(){
                      $(".inf2").css({ visibility: "visible" });
                },function(){
                        // esta función se ejecuta cuando pierde el foco
                      $(".inf2").css({ visibility: "hidden" });
                })
        });