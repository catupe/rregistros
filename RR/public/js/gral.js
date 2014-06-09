function error_handler(data, status, xhttpr){
	var mensaje 	= '<div class="alert alert-danger fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>MENSAJE</div>';
	var texto = mensaje.replace("MENSAJE", "En este momento no se puede procesar su solicitud<br>Vuelva a intentarlo en unos minutos");
	$(".container .row").prepend(texto);
	//$("#error").append("Error en la llamada");
    //$( "#loading" ).hide( "explode", null, 500, null );
}
$(document).ready(function(){
	/*
	mostrarToolTipConfiguracion = true;
	$('.navbar #configuracion').click(function(){
		mostrarToolTipConfiguracion = false;
		$('.navbar #configuracion').tooltip('hide');
	});
	$(document).click(function(e) {
		mostrarToolTipConfiguracion = true;
	});
	*/
	$('.navbar #configuracion').hover(function(){
		$('.navbar #configuracion').tooltip('show');
	});
})