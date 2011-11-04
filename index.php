<?php 
	
	$site 			= "http://nuevo.bravopublicidad.es/";
	$site_path 		= $_SERVER['DOCUMENT_ROOT'];
	$root 			= "/";
	$principales 	= '/info/principales/';
	$interior 		= '/info/interior/';
	$slider 		= '/info/sliders/'

?>

<!doctype html>
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>Maqueta</title>

  <meta name="description" content="">
  <meta name="author" content="">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
  <script>window.jQuery || document.write('<script src="js/libs/jquery-1.6.2.min.js"><\/script>')</script>
  <!-- scripts concatenated and minified via ant build script-->

  <script src="<?=$root?>js/libs/slides.jquery.js"></script>
  <script src="<?=$root?>js/libs/jquery.jcarousel.js"></script>
  <script src="<?=$root?>js/libs/jquery.bxSlider.min.js"></script>
  <script src="<?=$root?>js/script.js"></script>
  
  <script type="text/javascript">
	$(function(){
		
	    $('#slider1').bxSlider({
	      mode: 'fade',
	      captions: false,
	      auto: true,
	      controls: false
	    });
	    
	    $('#slider2').bxSlider({
	      mode: 'fade',
	      captions: false,
	      auto: true,
	      controls: false
	    });
	    
		
	   $('#marco').bxSlider({
	      mode: 'fade',
	      captions: false,
	      auto: true,
	      controls: false
	    });
	});
  </script>

  <link rel="stylesheet" href="<?=$root?>css/skins/tango/skin.css">
  <link rel="stylesheet" href="<?=$root?>css/bx_styles/bx_styles.css">
  <link rel="stylesheet" href="<?=$root?>css/style.css">

<style>
	 .jcarousel-skin-tango .jcarousel-container-horizontal {
		width: 98%;
		height: 210px;
	}
	.jcarousel-skin-tango .jcarousel-clip-horizontal {
		width: 100%;
		height: 200px;
	}
	.jcarousel-skin-creatividad .jcarousel-container-horizontal {
		width: 100%;
		height: 200px;
	}
</style>

</head>
<body>

<!-- Include Splash -->

<div id="splash" style="height: 100%; width: 100%; position: fixed; z-index: 30000; display: none; margin: 0; background: #fff; text-align: center;">
  <img src="<?=$root?>img/acertarse.jpg" alt="" style="margin: auto;"/>
</div>

<script type="text/javascript">
showSplash();
</script>

<div id="container">
  	<div class="header-space">
  		<div id="changer" class="pelota"></div>
  		<div style="float: right; width: 260px; height: auto; position: relative; right: 280px; top: 30px;">
  			<h2 class="title" id="acierta">Acierte al primer golpe /</h2>
  		</div>
  		<div style="float:right; width: 150px; height: auto; position: relative; right: -100px; top: 30px;">
  			<div id="word_container">
  				<ul id="slider2" style="width: 200px;">
				  <li style="float:right; text-align:right;">
	  				<h2 class="gris">rentabilidad</h2>
				  </li>
				  <li style="float:right; text-align:right;">
		  			<h2 class="gris">simbiosis</h2>
				  </li>
				  <li style="float:right; text-align:right;">
		  			<h2 class="gris">micro nichos</h2>
				  </li>
				</ul>
	  		</div>
  		</div>
  	</div>
      <div id="header">      	
      	<div id="header-right-space"></div>
      	<div id="header-menu-space">
			<ul id="main-menu" class="gradientbuttons links inline clearfix">
				<li><a class="outside_link" slider="agencia" icon="pelota" href="#1">Su Agencia</a></li>
				<li><a class="outside_link" icon="basketball" href="#2">MKT Bravo</a></li>
				<li><a class="outside_link" slider="creatividad" icon="notas" href="#3">Creatividad y Diseño</a></li>
				<li><a class="outside_link" slider="medios" icon="billard" href="#4">Medios</a></li>
				<li><a class="outside_link" href="#5">Exterior</a></li>
				<li><a class="outside_link" href="#6">Marketing Online</a></li>
			</ul>
		</div>
    </div>
    <div id="main">
    	<div id="sidebar">

    		<div class="logos_laterial">
	    		<ul id="slider1" style="width: 120px;">
				  <li>
				    <img src="<?=$root?>img/logos/Mercedes_logo.jpg" width="100" height="100" alt="Mercedes" title="The Velvet Underground and Nico" />
				  </li>
				  <li>
				    <img src="<?=$root?>img/logos/Ford.jpg" width="100"  height="100" alt="Logo Ford" title="The Velvet Underground and Nico" />
				  </li>
				  <li>
				    <img src="<?=$root?>img/logos/volkswagen-logo_th_2.jpg" width="100"  height="100" alt="Logo Volkswagen" title="The Velvet Underground and Nico" />
				  </li>
				  <li>
				    <img src="<?=$root?>img/logos/loreal-logo.jpg" width="100"  height="100" alt="Logo Loreal" title="The Velvet Underground and Nico" />
				  </li>
				</ul>
			</div>

			<div id="contact" class="wrapper contact_laterial">
				<h3 class="title" style="margin-left: 20px; padding-top: 10px;">contactanos</h3>
				<h2 class="title" style="margin-left: 20px; padding-top: 10px;">915170750</h2>
				<span class="title" style="margin-left: 20px; padding-top: 10px; font-size: 10px;"><small><a class="small" href="mailto:simbiosis@bravopublicidad.es?subject=Consulta">simbiosis@bravopublicidad.es</a></small></span>	
				<br><br>
			</div>

			<div id="offer" class="wrapper offer_laterial">
				<h2 class="title white" style="margin-left: 20px; padding-top: 10px;">FREE ONLINE</h2>
				<p class="white" style="margin-left: 20px; padding-top: 0px;">Encontrar servicios gratis </p>

			</div>

		</div>
		<div id="content">
			<div class="slides_container">
				<!--! Agencia slide -->
				<div class="slides_container_size" id="content_agencia">
					<?php include($principales.'agencia.php'); ?>
				</div>
				<!--! Marketing slide -->
				<div class="slides_container_size" id="content_marketing">
					<?php include($principales.'mkt.php'); ?>
				</div>
				<!--! Creatividad slide -->
				<div class="slides_container_size" id="content_creatividad">
					<?php include($principales.'creatividad.php'); ?>
				</div>
				<!--! Medios slide -->
				<div class="slides_container_size" id="content_medios">
					<?php include($principales.'medios.php'); ?>
				</div>
				<!--! Exterior slide -->
				<div class="slides_container_size" id="content_exterior">
					<?php include($principales.'exterior.php'); ?>
				</div>
				<!--! Marketing Online slide -->
				<div class="slides_container_size" id="content_online">
					<?php include($principales.'online.php'); ?>
				</div>
			</div>
		</div>
  	</div>
</div> <!--! end of #container -->

<script type="text/javascript">

	$('#link1').click(function() {
		loadSliderAgencia();
	});
	
	$('#link1_slider').click(function() {
		makeLoader();
		$.get('info/agencia.html', function(data) {
			$("#content_agencia").html(data);
			clearLoader()
			return false;
		});
	});
	
	$("#main-menu a").click(function() {
		var icon = $(this).attr("icon");
		var slider = $(this).attr("slider");

		$("#changer").removeClass('pelota notas basketball timon billard')
		$("#changer").addClass(icon);
		
		if(slider) {
			var slider_url = 'info/slider_'+slider+'.html';
			var slider_div = 'slider_'+slider;
			
			$.get(slider_url, function(data) {
				$("#"+slider_div).html(data);
				setSizes();	
			});
		}
		
	});
	
	$("#link1_slider").click(function() {
		var icon = $(this).attr("icon");
		$("#changer").removeClass('pelota notas basketball timon billard')
		$("#changer").addClass(icon);
	})
	
</script>
  <!-- Prompt IE 6 users to install Chrome Frame. Remove this if you want to support IE 6.
       chromium.org/developers/how-tos/chrome-frame-getting-started -->
  <!--[if lt IE 7 ]>
    <script src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.3/CFInstall.min.js"></script>
    <script>window.attachEvent('onload',function(){CFInstall.check({mode:'overlay'})})</script>
  <![endif]-->
</body>
</html>