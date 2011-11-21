<?php $this->load->view('admin/header'); ?>
	<style>
	#logolist, #logolist_inactive { float: left; width: 85%; min-height: 12em; } * html #gallery { height: 12em; } /* IE6 */
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
			update: function(event, ui) {
					$.post("/index.php/admin/sliders/update/<?=$slider->id?>", { pages: $('#logolist').sortable('serialize') } );
					 
			}
		});
		

	
		new Ajax_upload('button4', {
			action: '/index.php/admin/sliders/upload/<?=$slider->id?>',
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
				window.location = "/index.php/admin/sliders/edit/<?=$slider->id?>";
	
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
					
					  	$.post("/index.php/admin/sliders/delete/"+imageid,
					  		function(data) {
					  			$( this ).dialog( "close" );
					  			window.location = "/index.php/admin/sliders/edit/<?=$slider->id?>";
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

<?php if($result) { ?>
<div class="updated">Video updated. <a href="/index.php/admin/sliders">Go to list of videos</a></div>	
<?php } ?>

<button id="button4" class="right">Subir imagen</button>

<h1>Editando slider <?=$slider->name?></h1>


<form name="edit_slider" id="edit_slider" method="post" enctype="application/x-www-form-urlencoded" class="open_edit">
	
	<label class="s" for="link">Nombre de slider</label>
	<input value="<?=$slider->name?>" type="text" name="anything" id="link" class="text ui-widget-content ui-corner-all medium" />
	
	<label class="s" for="videoid"><span>Tipo de slider</span></label>
	<input value="<?=$slider->sys?>" type="text" name="videoid" id="videoid" class="text ui-widget-content ui-corner-all medium"  />
	
	
	<label class="s" for="description"><span>Codigo</span></label>
	<textarea name="description" id="description" cols="40" rows="5" class="text ui-widget-content ui-corner-all large"><?=$slider->code?></textarea>
	

	<label class="s" for="tags"><span>Imagenes</span></label>
	
	<ul id="logolist" class="sortable horizontal gallery ui-helper-reset ui-helper-clearfix">
		<?php foreach ($images as $i): ?>
			<?php if($i->sid == $slider->id): ?>
				<li class="ui-widget-content ui-corner-tr">
					<img src="<?=$i->path?>" />
					<a href="" title="Ver en grande" rel="<?=$i->path?>" class="ui-icon ui-icon-zoomin">Ver en grande</a>
					<a href="" title="Eliminar" rel="<?=$i->id?>" class="ui-icon ui-icon-trash">Eliminar</a>
				</li> 
			<?php endif; ?>
		<?php endforeach; ?>
	</ul>

	
	
	<label>
		<input type="submit" class="padding ui-widget-content ui-corner-all" name="guardar" value="Guardar" />
    </label>
</form>



<div id="dialog-uploading" title="Subiendo logo" style="display:none">
	<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Subiendo la imagen en el servidor</p>
</div>

<div id="dialog-confirm" title="Eliminar logo" style="display:none">
	<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Este logo se eliminar&aacute; y no se podr&aacute; recuperar en el futuro. Est&aacute;s seguro?</p>
</div>

<div id="dialog-big" title="Grande" style="display:none">
</div>

<?php $this->load->view('admin/footer'); ?>