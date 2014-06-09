$(document).ready(function(){
	$("#form-login #ingresar").click(function(){
		boton = $("#form-login #ingresar");
	 	var l = Ladda.create(boton[0]);
	 	l.start();

		$("#group-login").removeClass("has-error");
		$("#group-password").removeClass("has-error");
		$("#form-login .alert").remove();
		
		var mensaje 	= '<div class="alert alert-danger fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>MENSAJE</div>';
		var error 		= false;
		var mensError 	= "";
		
		var login = $("#login").val();
		var password = $("#password").val();
		
		if(login == ""){
			$("#group-login").addClass("has-error");
			mensError = "Ingrese su email";
			error = true;
		}
		var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		if((login != "") && (!regex.test(login))){
			$("#group-login").addClass("has-error");
			mensError = "El formato del email no es correcto";
			error = true;
		}
		if(password == ""){
			$("#group-password").addClass("has-error");
			if(mensError != ""){
				mensError += "<br>";
			}
			mensError += "Ingrese su password"
			error = true;
		}
		if(!error){
			
			var ajaxurl= window.location.href;
	        url = LOGIN_URL;
	        ajaxurl = ajaxurl.replace(window.location.pathname, url);
	        ajaxurl = LOGIN_URL;
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
		}
		else{
			var texto = mensaje.replace("MENSAJE", mensError);
			$("#form-login").prepend(texto);
			l.stop();
		}
	});
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
})