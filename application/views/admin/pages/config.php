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
			height: 330,
			width: 290,
			modal: true,
			buttons: {
				"Crear usuario": function() {
					


					$.post("/index.php/admin/config/new", $("#new_profile").serialize(),
					   function(data) {
						  	$( this ).dialog( "close" );
						  	window.location = "/index.php/admin/config";
					   });

					
				},
				"Cancelar": function() {
					$( this ).dialog( "close" );
				}
			},
			close: function() {
				allFields.val( "" ).removeClass( "ui-state-error" );
			}
		});

		$( "#create-user" )
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
					  	window.location = "/index.php/admin/config/delete/"+deletelink;
	
					}
				}
			});
			return false;
		})
	});
	
/*]]>*/</script>
<?php if($result) { ?>
<div class="updated">Usuario eliminado. </div>	
<?php } ?>

<button id="create-user" class="right">Crear usuario de administracion</button>
<h1>Configuracion de usuarios </h1>
<div style="height:20px;"></div>
<div id="highlight">
<table width="99%" class="rows" style="margin-left: 15px;"  border="0" cellspacing="0" id="highlight">
  <tr>
    <th>Nombre</th>
    <th>Apellido</th>
    <th>Email</th>
    <th class="right">Acciones</th>
  </tr>
<?php foreach ($users as $p): ?>
  <tr>
    <td><?=$p->firstName?></td>
    <td><?=$p->lastName?></td>
    <td><?=$p->email?></td>
    <td class="right "><a href="/index.php/admin/config/edit/<?=$p->id?>">Editar</a> / <span class="delete"> <a class="delete" href="" rel="<?=$p->id?>">Eliminar</a> </span></td>
  </tr>
<?php endforeach; ?>
</table>
</div>
<div id="dialog-form" title="Crear nuevo usuario de administracion">
	<p class="validateTips">Todos los campos son obligatorios</p>
	<form name="new_profile" id="new_profile">

		<label for="name">Nombre</label>
		<input type="text" name="name" id="name" class="text ui-widget-content ui-corner-all long" />
		
		<label for="name">Apellido</label>
		<input type="text" name="lastname" id="lastname" class="text ui-widget-content ui-corner-all long" />
		
		<label for="email">Email</label>
		<input type="text" name="email" id="email" value="" class="text ui-widget-content ui-corner-all long" />
		
		<label for="clave">Clave</label>
		<input type="text" name="clave" id="clave" value="" class="text ui-widget-content ui-corner-all long" />
		

	</form>
</div>
<div id="dialog-confirm" title="Eliminar usuario" style="display:none">
	<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Este usuario se eliminara. Estas seguro?</p>
</div>
<?php $this->load->view('admin/footer'); ?>