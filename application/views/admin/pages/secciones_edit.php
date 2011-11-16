<?php $this->load->view('admin/header'); ?>

<?php if($result):  ?>
	<div class="updated">
		Actualizado. <a href="/index.php/admin/secciones">Volver al listado de secciones.</a> 
	</div>
<?php endif; ?>

<h1>Editando seccion</h1>

<form name="edit_filter" id="edit_filter" method="post" enctype="application/x-www-form-urlencoded" class="open_edit">
	
	<p>
	<label for="name"><span>Nombre de seccion</span></label>
	<input name="vanity" value="<?=$filter->vanity?>" />
	</p>
	
	<p>
	<label for="html"><span>Contenido principal</span></label>
	<textarea name="html" id="html">
		<?=$filter->html?>
	</textarea>
	</p>
	
	<p>
	<label for="interior"><span>Contenido interior</span></label>
	<textarea name="interior" id="interior">
		<?=$filter->interior?>
	</textarea>
	</p>


	<label>
		<input type="submit" class="button padding ui-widget-content ui-corner-all" name="guardar_seccion" id="guardar_seccion" value="Guardar" />
    </label>
    
</form>
<script>
	
var myEditor = new YAHOO.widget.SimpleEditor('interior', {
    height: '300px',
    width: '80%',
    dompath: true //Turns on the bar at the bottom
});


myEditor.render();


var myEditors = new YAHOO.widget.SimpleEditor('html', {
    height: '300px',
    width: '80%',
    dompath: true //Turns on the bar at the bottom
});


myEditors.render();



YAHOO.util.Event.on('guardar_seccion', 'click', function() {
    //Put the HTML back into the text area
    myEditor.saveHTML();
 	myEditors.saveHTML();
 	
    //The var html will now have the contents of the textarea
    var html = myEditor.get('interior').value;
    
    
});
</script>

<?php $this->load->view('admin/footer'); ?>