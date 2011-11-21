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
  <script>window.jQuery || document.write('<script src="<?=base_url()?>js/libs/jquery-1.6.2.min.js"><\/script>')</script>
  <!-- scripts concatenated and minified via ant build script-->
  <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js" type="text/javascript"></script>
  <script src="http://jquery-ui.googlecode.com/svn/trunk/ui/i18n/jquery.ui.datepicker-es.js" type="text/javascript"></script>



  <script src="<?=base_url()?>js/libs/slides.jquery.js"></script>
  <script src="<?=base_url()?>js/libs/jquery.jcarousel.js"></script>
  <script src="<?=base_url()?>js/libs/jquery.bxSlider.min.js"></script>
  <script src="<?=base_url()?>js/fancybox/jquery.fancybox-1.3.4.js"></script>



  <script>
  
	$(function(){

		setSizes();	

		var startSlide = 1;
		
		if (window.location.hash) {
			startSlide = window.location.hash.replace('#','');
		}
		
		$('#content').slides({
			generatePagination: true,
			pagination:true,
			preload: true,
			hoverPause: true,
			fadeSpeed: 1000,
			effect: 'slide',
			preload: true,
			autoHeight: true,
			preloadImage: '<?=base_url()?>img/loading.gif',
			animationComplete: function(current){
				window.location.hash = '#' + current;
			},
			start: startSlide
		});
		
		slider = "agencia";
		
		if(slider) {
			var slider_url = '<?=base_url()?>index.php/welcome/slider/'+slider;
			var slider_div = 'slider_'+slider;
			
			$.get(slider_url, function(data) {
				$("#"+slider_div).html(data);
			});
		}
		
		$("#datepicker").datepicker();
		$("a#gocontact").fancybox({'overlayShow'	:	false});
		$("#slider1 a").fancybox({
			'transitionIn'	:	'elastic',
			'transitionOut'	:	'elastic',
			'speedIn'		:	600,
			'height'		: 	450,
			'width'			: 	750,
			'speedOut'		:	200, 
			'overlayShow'	:	false
		});
	});
	
	$(window).resize(function() { setSizes(); });
	
	function createPageSlider(){

	}

	
	function setSizes() {
   		var containerWidth = $("#container").width();
   		var containerHeight = $("#container").height();

   		$("#content").width(containerWidth - 270);
   		$("#content").height(containerHeight - 145);

   		//$(".slides_container div").width(containerWidth - 210);
   		$(".slides_container_size").width(containerWidth - 290);
	}


	function showSplash() {
		var interrupt;
		window.setTimeout(hideSplash, 2000);
		$('#splash').show().click(function() {
			hideSplash();
		});
	}

	function hideSplash() {

		$('#splash').animate(
			{ 'right': '100%', opacity: .9 },
			{
				duration: 600,
				complete: function() {
				$(this).remove();
			}
		});
	}
  
	
	function makeLoader() {
		$('#content').addClass('loading');
	}
	
	function clearLoader() {
		$('#content').removeClass('loading');
	}
	
	
	function loadSliderAgencia() {
		$.get('<?=base_url()?>info/agency_slider.html', function(data) {
			$("#content_agencia").html(data);
		});
	}
</script>
  
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

  <link rel="stylesheet" href="<?=base_url()?>css/skins/tango/skin.css">
  <link rel="stylesheet" href="<?=base_url()?>css/bx_styles/bx_styles.css">
  <link rel="stylesheet" href="<?=base_url()?>js/fancybox/jquery.fancybox-1.3.4.css">
  <link rel="stylesheet" href="<?=base_url()?>css/custom-theme/jquery-ui-1.8.16.custom.css" type="text/css" media="screen" />
  <link rel="stylesheet" href="<?=base_url()?>css/style.css">

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
  <img src="<?=base_url()?>img/acertarse.jpg" alt="" style="margin: auto;"/>
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
	    			<?php foreach ($logos as $l): ?>
					  <li>
					    <a class="iframe" href="/index.php/welcome/logos"><img src="<?=$l->path?><?=$l->name?>" width="100" height="100" alt="logo <?=$l->name?>" title="<?=$l->desc?>" /></a>
					  </li>
					<?php endforeach; ?>
				</ul>
			</div>
			
			<div id="contact" class="wrapper contact_laterial">
				<h3 class="title" style="margin-left: 20px; padding-top: 10px;"><a id="gocontact" href="#contact_form">contactanos</a></h3>
				<h2 class="title" style="margin-left: 20px; padding-top: 10px;">915170750</h2>
				<span class="title" style="margin-left: 20px; padding-top: 10px; font-size: 10px;"><small><a class="small" href="mailto:simbiosis@bravopublicidad.es?subject=Consulta">simbiosis@bravopublicidad.es</a></small></span>	
				<br><br><br>
				<div style="display:none;">
				<div id="contact_form">
					<form id="formtoserialize">
						<h2>Envíenos su consulta</h2>
						<fieldset>
							<p>
								<label for="name">Su nombre</label>
								<input name="name" type="text" id="name" />
							</p>
							<p>
								<label for="email">Su email</label>
								<input name="email" type="text" id="email"/>
							</p>
							<p>
								<label for="message">Su mensaje</label>
								<textarea name="message" rows="8" id="message"></textarea>
							</p>
							<p>
								<label for="cita">Concierte su cita</label>
								<div id="datepicker"></div>
							</p>
							<p>
								<input type="submit" value="Enviar" name="sendcontact" id="sendcontact" class="button big white"/>
							</p>
						</fieldset>
					</form>
					</div>
				</div>
			</div>

			<div id="offer" class="wrapper offer_laterial">
				<p class="bigbold white" style="margin-left: 20px; padding-top: 10px;"><a href="http://free.bravopublicidad.es">free online</a></p>
			</div>

			<div id="offerb" class="wrapper offerb_laterial">
				<p class="bigbold white" style="margin-left: 20px; padding-top: 10px;"><a href="http://bidi.bravopublicidad.es">bravo BIDI</a></p>
			</div>
			
		</div>
		<div id="content">
			<div class="slides_container">		
				<div class="slides_container_size" id="content_agencia">
					
					<?php echo $content_agencia->html; ?>
					
				</div>

				<div class="slides_container_size" id="content_marketing">
					
					<?php echo $content_marketing->html; ?>
				</div>
				
				
				<div class="slides_container_size" id="content_creatividad">
					
					<?php echo $content_creatividad->html; ?>
				</div>
				
				
				<div class="slides_container_size" id="content_medios">
					
					<?php echo $content_medios->html; ?>
				</div>
				
				
				<div class="slides_container_size" id="content_exterior">
					
					<?php echo $content_exterior->html; ?>
				</div>
				
				
				<div class="slides_container_size" id="content_online">
					
					<?php echo $content_online->html; ?>
				</div>
				
			</div>
		</div>
  	</div>
</div> <!--! end of #container -->
<script type="text/javascript">

	$('#link1').click(function() {
		loadSliderAgencia();
	});
	
	$('.interior').click(function() {
		makeLoader();
		
		var gotolink = $(this).attr("href");

		$.get('<?=base_url()?>index.php/welcome/interior/'+gotolink, function(data) {
			$("#content_"+gotolink).html(data);
			clearLoader();
		});
		return false;
	});
	
	$("#main-menu a").click(function() {
		var icon = $(this).attr("icon");
		var slider = $(this).attr("slider");

		$("#changer").removeClass('pelota notas basketball timon billard')
		$("#changer").addClass(icon);
		
		if(slider) {
			var slider_url = '<?=base_url()?>index.php/welcome/slider/'+slider;
			var slider_div = 'slider_'+slider;
			$.get(slider_url, function(data) {
				$("#"+slider_div).html(data);
				setSizes();	
			});
		}
	});
	
	
	$("#sendcontact").click(function(){
		$.post("/index.php/welcome/contacto", $("#formtoserialize").serialize(), function(data){ $("#contact_form").html(data); });
		return false;
	});
	
	$("#link1_slider").click(function() {
		var icon = $(this).attr("icon");
		$("#changer").removeClass('pelota notas basketball timon billard')
		$("#changer").addClass(icon);
	});
	

</script>
  <!-- Prompt IE 6 users to install Chrome Frame. Remove this if you want to support IE 6.
       chromium.org/developers/how-tos/chrome-frame-getting-started -->
  <!--[if lt IE 7 ]>
    <script src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.3/CFInstall.min.js"></script>
    <script>window.attachEvent('onload',function(){CFInstall.check({mode:'overlay'})})</script>
  <![endif]-->
</body>
</html>