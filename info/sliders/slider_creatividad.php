<div>
	<ul id="slider_creatividad_inside" style="width: 780px;">
	  <li>
	    <img src="img/slider/creatividad/slide-1.jpg" width="780"  height="200" alt="Logo Volkswagen" />
	  </li>
	  <li>
	    <img src="img/slider/creatividad/slide-2.jpg" width="780"  height="200" alt="Logo Loreal" title="The Velvet Underground and Nico" />
	  </li>
	  <li>
	    <img src="img/slider/creatividad/slide-3.jpg" width="780"  height="200" alt="Logo Loreal" title="The Velvet Underground and Nico" />
	  </li>
	  <li>
	    <img src="img/slider/creatividad/slide-4.jpg" width="780"  height="200" alt="Logo Loreal" title="The Velvet Underground and Nico" />
	  </li>
	</ul>
</div>

<script>

$(function(){
	/*
	$('#slider_medios_inside').slides({
		preload: true,
		preloadImage: 'img/loading.gif',
		play: 5000,
		pause: 2500,
		hoverPause: true
	});
*/

	$('#slider_creatividad_inside').bxSlider({
	  mode: 'horizontal',
	      captions: false,
	      auto: true,
	      controls: false
	});
	
	
});

</script>