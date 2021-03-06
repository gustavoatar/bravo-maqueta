<div style="width: 90%; text-align: justify;">	
	<h1 class="title" id="page-title">Filosof&iacute;a de Empresa</h1>
	<p></p>
	<p>Bravo es un Grupo Empresarial dedicado en exclusiva al desarrollo de acciones de Marketing, Publicidad y Comunicaci&oacute;n, con MPLI experiencia y porque no decirlo exitos relevantes, en sus m&aacute;s de 30 a&ntilde;os.</p>
	<p>Nuestra filosof&iacute;a se basa en generar la <strong>empat&iacute;a</strong>, <strong>simbiosis</strong> y <strong>rentabilidad</strong> desde la primera campa&ntilde;a.</p>
	<p>Conseguimos <strong>optimizar la campa&ntilde;a</strong> con la creatividad y soportes adecuados. </p>
	<p>Es fundamental para nosotros aplicar a cada Cliente y en cada Campa&ntilde;a, un m&eacute;todo y sistema espec&iacute;fico.  <strong>Control, seguimiento, evaluaci&oacute;n</strong> peri&oacute;dica, RIM.</p>
	
	<ul id="carousel_filosofia" class="jcarousel-skin-tango">
	    <li><img src="img/slider/filosofia/slide1.jpg" alt="" /></li>
	    <li><img src="img/slider/filosofia/slide2.jpg" alt="" /></li>
	    <li><img src="img/slider/filosofia/slide3.jpg" alt="" /></li>
	    <li><img src="img/slider/filosofia/slide4.jpg" alt="" /></li>
	    <li><img src="img/slider/filosofia/slide5.jpg" alt="" /></li>
	    <li><img src="img/slider/filosofia/slide6.jpg" alt="" /></li>
	    <li><img src="img/slider/filosofia/slide7.jpg" alt="" /></li>
	    <li><img src="img/slider/filosofia/slide8.jpg" alt="" /></li>
	</ul>
	
	<p>La <strong>planificaci&oacute;n</strong> y la compra de medios desde nuestra propia Central, con gesti&oacute;n independiente, profesional y ecl&eacute;ctica, genera confianza, honestidad, profesionalidad y rentabilidad a nuestros clientes.</p>
	<p>Obtener una perfecta comunicaci&oacute;n Mercado-cliente-Agencia.  Conocer e investigar todos los procesos en tiempo real es fundamental. </p>
	<p>Tenemos claro que la gesti&oacute;n de Marketing, Comunicaci&oacute;n y Publicidad son hechos concatenados y progresivos que precisan obtener la <strong>simbiosis</strong> con sus clientes.  Tenemos que obtener los resultados previstos al menor coste. </p>
	<p>La empresa, sus marcas, productos e inversiones, quieren y necesitan <strong>generar recursos</strong> con campa&ntilde;as rentables.</p>
	<a href="#1" class="button big grey" id="goback_agencia" style="float:left; margin-right: 15px;">&lsaquo; volver</a>
	<p class="signature">La llave del &eacute;xito</strong> de su Campa&ntilde;a.</p>					
</div>

<script type="text/javascript">

	$("#carousel_filosofia").jcarousel({
		'buttonNextHTML' : null,
		'buttonPrevHTML' : null,
		'auto' : 1,
		'animation' : 15000,
		'wrap' : "circular"
	});
	
	$('#goback_agencia').click(function() {
		makeLoader();
			$.get('info/agencia_content.html', function(data) {
				$("#content_agencia").html(data);
				clearLoader()
				
					$.get('info/slider_agencia.html', function(data) {
						$("#slider_agencia").html(data);
					});
				return false;
			});
	});
</script>