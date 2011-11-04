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
			preloadImage: 'img/loading.gif',
			animationComplete: function(current){
				window.location.hash = '#' + current;
			},
			start: startSlide
		});
		
		slider = "agencia";
		
		if(slider) {
			var slider_url = 'info/slider_'+slider+'.html';
			var slider_div = 'slider_'+slider;
			
			$.get(slider_url, function(data) {
				$("#"+slider_div).html(data);
			});
		}
		
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
		$.get('info/agency_slider.html', function(data) {
			$("#content_agencia").html(data);
		});
	}