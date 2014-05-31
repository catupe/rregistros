$(document).ready(function(){
	$("#form-crear-usuario #aceptar").click(function(){
		
		boton = $("#form-crear-usuario #aceptar");
	 	var l = Ladda.create(boton[0]);
	 	l.start();
	 	
	 	$("#group-nombre").removeClass("has-error");
		$("#group-apellido").removeClass("has-error");
		$("#group-email").removeClass("has-error");
		$("#mensajes .alert").remove();
			 	
	 	$("#group-nombre").removeClass("has-error");
		$("#group-apellido").removeClass("has-error");
		$("#group-email").removeClass("has-error");
		//$("#group-grupos").removeClass("has-error");
		
		
		var mensaje 	= '<div class="alert alert-danger fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>MENSAJE</div>';
		var error 		= false;
		var mensError 	= "";
		
		var nombre 		= $("#input-nombre").val();
		var apellido	= $("#input-apellido").val();
		var email 		= $("#input-email").val();
		//var apellido = $("#input-apellido").val();
		
		if(nombre == ""){
			$("#group-nombre").addClass("has-error");
			mensError += "Ingrese el nombre del nuevo usuario";
			error = true;
		}
		if(nombre.length > 20){
			$("#group-nombre").addClass("has-error");
			if(mensError != ""){
				mensError += "<br>";
			}
			mensError += "El nombre del usuario debe de tener menos de 20 carateres";
			error = true;
		}
		if(email == ""){
			$("#group-email").addClass("has-error");
			if(mensError != ""){
				mensError += "<br>";
			}
			mensError += "Ingrese el email del nuevo usuario";
			error = true;
		}
		var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		if((email != "") && (!regex.test(email))){
			$("#group-email").addClass("has-error");
			if(mensError != ""){
				mensError += "<br>";
			}
			mensError += "El formato del email no es correcto";
			error = true;
		}
		
		if(!error){
			l.stop();
			$("#form-crear-usuario").submit();
			/*
			var ajaxurl= window.location.href;
	        url = LOGIN_URL;
	        ajaxurl = ajaxurl.replace(window.location.pathname, url);
	        $.ajax({
	                type: "POST",
	                dataType: "json",
	                url: ajaxurl,
	                data : { login : login, password: password },
	                success: r_login,
	                error : error_handler,
	                complete: function() {
				        		l.stop();
				    }
	        });
	        */
		}
		else{
			var texto = mensaje.replace("MENSAJE", mensError);
			$("#mensajes").prepend(texto);
			l.stop();
		}
		
	});
	/*
	function r_login(data, status, xhttpr){
		if (data.status == "ok") {
			window.location.href = CREARUSUARIO_URL;
		} else {
			var mensaje 	= '<div class="alert alert-danger fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>MENSAJE</div>';
		    if (data.mensajeError != ""){
		    	var texto = mensaje.replace("MENSAJE", data.mensajeError);
				$("#form-login").prepend(texto);
		    }
		    else{
		    	var texto = mensaje.replace("MENSAJE", "En este momento no se puede procesar su solicitud<br>Vuelva a intentarlo en unos minutos");
				$("#form-login").prepend(texto);
		    }
		}
	}
	*/
})