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
			height: 590,
			width: 350,
			modal: true,
			buttons: {
				"Create profile": function() {
					


					$.post("http://plush.revalorizer.com/index.php/admin/profiles/new", $("#new_profile").serialize(),
					   function(data) {
						  	$( this ).dialog( "close" );
						  	window.location = "http://plush.revalorizer.com/index.php/admin/profiles";
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

		$( "#create-user" )
			.button()
			.click(function() {
				$( "#dialog-form" ).dialog( "open" );
			});
	
		new Ajax_upload('button4', {
			action: 'http://plush.revalorizer.com/index.php/admin/profiles/photo',
			onSubmit : function(file , ext){
				$('#photo_status').html('<img src="http://plush.revalorizer.com/images/ajax-loader.gif" /> Uploading ' + file + '');
				this.disable();	
			},
			onComplete : function(file){
				$('#photo_status').html('<img src="http://plush.revalorizer.com/images/techs/thumbnails/'+file+'" width="90" /> <br> Uploaded ' + file + '');
				$('#photo').val(file)		
			}		
		});
	
	
	
		$('.delete a').click(function(){
			var deletelink = $(this).attr('rel');

			$( "#dialog-confirm" ).dialog({
		
	
				resizable: false,
				height:140,
				modal: true,
				buttons: {
					"Delete": function() {
						$( this ).dialog( "close" );
					  	window.location = "http://plush.revalorizer.com/index.php/admin/profiles/delete/"+deletelink;
	
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
<button id="create-user" class="right">Create Profile</button>
<h1>Profiles </h1>
<div style="height:20px;"></div>
<table width="99%" class="rows" style="margin-left: 15px;"  border="0" cellspacing="0" id="highlight">
  <tr>
    <th></td>
    <th>First name</th>
    <th>Last name</th>
    <th>Email</th>
    <th>Vimeo</th>
    <th>Position</th>
    <th class="left">Operations</th>
  </tr>
<?php foreach ($profiles as $p): ?>
  <tr>
    <td><img src="<?=$p->photo?>" height="50" /></td>
    <td><?=$p->name?></td>
    <td><?=$p->lastname?></td>
    <td><?=$p->email?></td>
    <td><?=$p->vimeo?></td>
    <td><?=$p->position?></td>
    <td class="left "><a href="http://plush.revalorizer.com/index.php/admin/profiles/edit/<?=$p->id?>">Edit</a> / <span class="delete"> <a class="delete" href="" rel="<?=$p->id?>">Delete</a> </span></td>
  </tr>
<?php endforeach; ?>
</table>

<div id="dialog-form" title="Create new profile">
	<p class="validateTips">All fields are required</p>
	<form name="new_profile" id="new_profile">
	<fieldset>
		<label for="name">First Name</label>
		<input type="text" name="name" id="name" class="text ui-widget-content ui-corner-all long" />
		
		<label for="name">Last Name</label>
		<input type="text" name="lastname" id="lastname" class="text ui-widget-content ui-corner-all long" />
		
		<label for="email">Email</label>
		<input type="text" name="email" id="email" value="" class="text ui-widget-content ui-corner-all long" />

		<label for="bio">Biography</label>
		<textarea name="bio" id="bio" value="" cols="40" rows="4" class="textarea ui-widget-content ui-corner-all long" ></textarea>
		
		<label for="vimeo">Vimeo Album</label>
		<input type="text" name="vimeo" id="vimeo" value="" class="text ui-widget-content ui-corner-all long" />

		<label for="position">Position</label>
		<input type="text" name="position" id="position" value="" class="text ui-widget-content ui-corner-all long" />
		
		<input type="hidden" name="photo" id="photo" value="" />
		
		<label for="photo">Photo</label>
		<div id="photo_status">
			<a id="button4">Click to upload photo</a>
		</div>
      	
	</fieldset>
	</form>
</div>
<div id="dialog-confirm" title="Delete this profile?" style="display:none">
	<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>This profile will be permanently deleted and cannot be recovered. Are you sure?</p>
</div>
<?php $this->load->view('admin/footer'); ?>