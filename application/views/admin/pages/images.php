<?php $this->load->view('admin/header'); ?>


	<style>
	#logolist, #logolist_inactive { float: left; width: 100%; min-height: 12em; } * html #gallery { height: 12em; } /* IE6 */
	.gallery.custom-state-active { background: #eee; }
	.gallery li { float: left; width: 96px; padding: 0.4em; margin: 0 0.4em 0.4em 0; text-align: center; }
	.gallery li h5 { margin: 0 0 0.4em; cursor: move; }
	.gallery li a { float: right; }
	.gallery li a.ui-icon-zoomin { float: left; }
	.gallery li img { width: 100%; cursor: move; }

	#trash { float: right; width: 32%; min-height: 18em; padding: 1%;} * html #trash { height: 18em; } /* IE6 */
	#trash h4 { line-height: 16px; margin: 0 0 0.4em; }
	#trash h4 .ui-icon { float: left; }
	#trash .gallery h5 { display: none; }
	</style>
	
<script>/*<![CDATA[*/

$(function() {


		$("#logolist").sortable({
			dropOnEmpty: true,
        	connectWith: 'ul.sortable',
//			placeholder: "ui-state-highlight",
			update: function(event, ui) {
					$.post("/index.php/admin/logos/update", { pages: $('#logolist').sortable('serialize') } );
					 
			}
		});
		

		
		$("#logolist_inactive").sortable({
			dropOnEmpty: true,
        	connectWith: 'ul.sortable',
			update: function(event, ui) {
					$.post("/index.php/admin/logos/inactive", { pages: $('#logolist_inactive').sortable('serialize') } );
					//alert(ui.item);
			}			
		});			
	
		new Ajax_upload('button4', {
			action: '/index.php/admin/logos/upload',
			onSubmit : function(file , ext){
				
			$( "#dialog-uploading" ).dialog({
				resizable: false,
				height:140,
				modal: true
			});


				this.disable();	
			},
			onComplete : function(file){
				
				$("#dialog-uploading").dialog( "close" );
				window.location = "/index.php/admin/logos/";
	
			}
			
		});
	
		$(".ui-icon-trash").click(function(){
			var imageid = $(this).attr("rel");
			
			$( "#dialog-confirm" ).dialog({
				resizable: false,
				height:140,
				modal: true,
				buttons: {
					"Eliminar": function() {
					
					  	$.post("/index.php/admin/logos/delete/"+imageid,
					  		function(data) {
					  			$( this ).dialog( "close" );
					  			window.location = "/index.php/admin/logos";
					  			//$("#dialog-confirm").html(data);
					  		} 
					  	);
	 
					},
					Cancel: function() {
						$( this ).dialog( "close" );
					}
				}
			});
			
			return false;
		});
	
	
		$(".ui-icon-zoomin").click(function(){
			var imagepath = $(this).attr("rel");
			
			$( "#dialog-big" ).html('<img src="'+imagepath+'" width="250" />');
			$( "#dialog-big" ).dialog({
				resizable: true,
				height:300,
				modal: true,

			});
			
			return false;
		});
	
	
		function opensesame(dimg) { 
			
			var deletelink = $(this).attr('rel');
			$( "#dialog-confirm" ).dialog({
				resizable: false,
				height:140,
				modal: true,
				buttons: {
					"Eliminar": function() {
						//alert(dimg);
	                	jQuery('#'+dimg).remove();
						$( this ).dialog( "close" );
					  	//window.location = "/index.php/admin/images/delete/"+deletelink;
	 
					},
					Cancel: function() {
						$( this ).dialog( "close" );
					}
				}
			});
			
			return false;
		};
		
	});
	
/*]]>*/</script>

<button id="button4" class="right">Subir logo</button>

<h1>Logos activos</h1>
<div style="height:20px;"></div>
<ul class="sortable horizontal gallery ui-helper-reset ui-helper-clearfix" id="logolist" style="list-style: none; height:auto; clear:both; ">
	<?php foreach ($logos as $l): ?>
	<li  class="ui-widget-content ui-corner-tr" id="logo_<?=$l->id?>">
		<a class="todelete" href="#" rel="<?=$l->id?>"><img class="" src="<?=$l->path?><?=$l->name?>" height="100" /></a>
		<a href="" title="Ver en grande" rel="<?=$l->path?><?=$l->name?>" class="ui-icon ui-icon-zoomin">Ver en grande</a>
		<a href="" title="Eliminar" rel="<?=$l->id?>" class="ui-icon ui-icon-trash">Eliminar</a>
	</li>
	<?php endforeach; ?>
</ul>
<div style="height:20px; clear:both;"></div>


<h1>Logos inactivos</h1>
<div style="height:20px;"></div>
<ul class="sortable horizontal gallery ui-helper-reset ui-helper-clearfix" id="logolist_inactive" style="list-style: none; height:auto; ">
 
	<?php foreach ($logosoff as $lo): ?>
	<li  class="ui-widget-content ui-corner-tr" id="logo_<?=$lo->id?>">
		<a class="todelete" href="#" rel="<?=$lo->id?>"><img class="inactive_logo" src="<?=$lo->path?><?=$lo->name?>" height="100" /></a>
	</li>
	<?php endforeach; ?>
</ul>
<div id="dialog-uploading" title="Subiendo logo" style="display:none">
	<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Subiendo la imagen en el servidor</p>
</div>

<div id="dialog-confirm" title="Eliminar logo" style="display:none">
	<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Este logo se eliminar&aacute; y no se podr&aacute; recuperar en el futuro. Est&aacute;s seguro?</p>
</div>

<div id="dialog-big" title="Grande" style="display:none">


</div>

<?php $this->load->view('admin/footer'); ?>