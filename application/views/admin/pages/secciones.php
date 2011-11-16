<?php $this->load->view('admin/header'); ?>
<script>/*<![CDATA[*/

$(function() {
		// a workaround for a flaw in the demo system (http://dev.jqueryui.com/ticket/4375), ignore!
		$( "#dialog:ui-dialog" ).dialog( "destroy" );
		
		var name = $( "#name" ),
			email = $( "#email" ),
			password = $( "#password" ),
			allFields = $( [] ).add( name ).add( email ).add( password ),
			tips = $( ".validateTips" );

		function updateTips( t ) {
			tips
				.text( t )
				.addClass( "ui-state-highlight" );
			setTimeout(function() {
				tips.removeClass( "ui-state-highlight", 1500 );
			}, 500 );
		}

		
		$( "#dialog-form" ).dialog({
			autoOpen: false,
			height: 190,
			width: 250,
			modal: true,
			buttons: {
				"Crear seccion": function() {
					


					$.post("/index.php/admin/secciones/nuevo", $("#new_filter").serialize(),
					   function(data) {
						  	$( this ).dialog( "close" );
						  	window.location = "/index.php/admin/secciones";
					   });

					
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			},
			close: function() {
				allFields.val( "" ).removeClass( "ui-state-error" );
			}
		});

		$( "#create-filter" )
			.button()
			.click(function() {
				$( "#dialog-form" ).dialog( "open" );
			});
	

	
	
	
		$('.delete a').click(function(){
			var deletelink = $(this).attr('rel');

			$( "#dialog-confirm" ).dialog({
		
	
				resizable: false,
				height:140,
				modal: true,
				buttons: {
					"Eliminar": function() {
						$( this ).dialog( "close" );
					  	window.location = "/index.php/admin/secciones/eliminar/"+deletelink;
	
					},
					Cancel: function() {
						$( this ).dialog( "close" );
					}
				}
			});
			return false;
		})
	});
	
/*]]>*/</script>
<button id="create-filter" class="right">Crear seccion</button>
<h1>Secciones</h1>
<div style="height:20px;"></div>
<table width="99%" class="rows" style="margin-left: 15px;"  border="0" cellspacing="0" id="highlight">
  <tr>
    <th>Nombre de seccion</th>
    <th class="left">Operacion</th>
  </tr>
<?php foreach ($result as $f): ?>
  <tr class="topbottom">
    <td><?=$f->vanity?></td>
    <td class="left"><a href="/index.php/admin/secciones/edit/<?=$f->id?>">Editar</a> / <span class="delete"><a href="#" rel="<?=$f->id?>"> Eliminar</a></span> </td>
  </tr>
<?php endforeach; ?>
</table>


<div id="dialog-form" title="Add new video filter">
	<p class="validateTips">Todos los campos obligados</p>
	<form name="new_filter" id="new_filter">
	<fieldset>
		
		<label for="name">Nombre de contenido</label>
		<input type="text" name="name" id="name" class="text ui-widget-content ui-corner-all long" />
      	
	</fieldset>
	</form>
</div>

<div id="dialog-confirm" title="Borrar esta seccion?" style="display:none">
	<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Esta seccion se eliminara permenamente, estas seguro?</p>
</div>

<?php $this->load->view('admin/footer'); ?>