function error_handler(){
	var mensaje 	= '<div class="alert alert-danger fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>MENSAJE</div>';
	var texto = mensaje.replace("MENSAJE", "En este momento no se puede procesar su solicitud<br>Vuelva a intentarlo en unos minutos");
	$(".container .row").prepend(texto);
	//$("#error").append("Error en la llamada");
    //$( "#loading" ).hide( "explode", null, 500, null );
}