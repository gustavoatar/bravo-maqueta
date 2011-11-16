<?php $this->load->view('admin/header'); ?>
<script>/*<![CDATA[*/

$(function() {


		$("#logolist").sortable({
			dropOnEmpty: true,
        	connectWith: 'ul.sortable',
//			placeholder: "ui-state-highlight",
			update: function(event, ui) {
				
				if(this.id == 'sortable-delete') {
					
                	//opensesame(this.id);
                	//$.post("/index.php/admin/logos/delete", { lid: this.id } );
                	
            	} else {
            		
					$.post("/index.php/admin/logos/update", { pages: $('#logolist').sortable('serialize') } );
            	
            	}      
			}
		});
		
		$("#sortable-delete").sortable({
			receive: function(event, ui) { 
				opensesame(this.id);
			}
		});
		
		$("#logolist_inactive").sortable({
			receive: function(event, ui) { 
				alert(this.id);
			}
		});			
	
		new Ajax_upload('button4', {
			action: '/index.php/admin/images/upload',
			onSubmit : function(file , ext){
				$('#photo_status').html('<img src="/images/ajax-loader.gif" /> Uploading ' + file + '');
				this.disable();	
			},
			onComplete : function(file){
				$('#photo_status').html('<img src="/images/studiothumb/'+file+'" width="90" /> <br> Uploaded ' + file + '');
				$('#photo').val(file)		
			}		
		});
	
	
	
		function opensesame(dimg) { 
			
			var deletelink = $(this).attr('rel');
			$( "#dialog-confirm" ).dialog({
				resizable: false,
				height:140,
				modal: true,
				buttons: {
					"Eliminar": function() {
						alert(dimg);
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

<ul id="sortable-delete" class="sortable"></ul>

<h1>Logos activos</h1>
<div style="height:20px;"></div>
<ul class="sortable horizontal" id="logolist" style="list-style: none; height:auto; clear:both; ">
	<?php foreach ($logos as $l): ?>
	<li id="logo_<?=$l->id?>">
		<a class="todelete" href="#" rel="<?=$l->id?>"><img src="<?=$l->path?><?=$l->name?>" height="100" /></a>
	</li>
	<?php endforeach; ?>
</ul>
<div style="height:20px; clear:both;"></div>


<h1>Logos inactivos</h1>
<div style="height:20px;"></div>
<ul class="sortable horizontal" id="logolist_inactive" style="list-style: none; height:auto; ">

	<?php foreach ($logosoff as $lo): ?>
	<li id="logo_<?=$lo->id?>">
		<a class="todelete" href="#" rel="<?=$lo->id?>"><img class="inactive_logo" src="<?=$lo->path?><?=$lo->name?>" height="100" /></a>
	</li>
	<?php endforeach; ?>
</ul>

<div id="dialog-confirm" title="Eliminar logo" style="display:none">
	<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Este logo se eliminar&aacute; y no se podr&aacute; recuperar en el futuro. Est&aacute;s seguro?</p>
</div>
<?php $this->load->view('admin/footer'); ?>