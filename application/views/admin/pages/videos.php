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

		$("#link").change(function(){
			
			var str = $(this).val();
			
			var pattern = /[0-9]+/;
			var match = str.match(pattern);
			$("#vidid").val(match);
			
			$("#videoprev").html('<iframe src="http://player.vimeo.com/video/'+match+'" width="348" height="200" frameborder="0" webkitAllowFullScreen allowFullScreen></iframe>');

		});
			
			
		function updateTips( t ) {
			tips
				.text( t )
				.addClass( "ui-state-highlight" );
			setTimeout(function() {
				tips.removeClass( "ui-state-highlight", 1500 );
			}, 500 );
		}
		
		$('.stripe tr:even').addClass('alt');
		
		$( "#dialog-form" ).dialog({
			autoOpen: false,
			height: 580,
			width: 700,
			modal: true,
			buttons: {
				"Add video": function() {
					


					$.post("http://plush.revalorizer.com/index.php/admin/videos/new", $("#new_video").serialize(),
					   function(data) {
						  	$( this ).dialog( "close" );
						  	window.location = "http://plush.revalorizer.com/index.php/admin/videos";
					   });

					
				},
				Cancel: function() {
					$( this ).dialog( "close" );
					$('#new_profile')[0].reset();
					$("#videoprev").html('<br /><br /><br /><br /><br />Insert link to visualize video');

				}
			},
			close: function() {
				allFields.val( "" ).removeClass( "ui-state-error" );
			}
		});

		$( "#create-video" )
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
					"Delete": function() {
						$( this ).dialog( "close" );
					  	window.location = "http://plush.revalorizer.com/index.php/admin/videos/delete/"+deletelink;
	
					},
					Cancel: function() {
						$( this ).dialog( "close" );
					}
				}
			});
			return false;
		});
		
		$("#tags").multiselect({
		   selectedList: 10,
		   header: false
		});
		
		$("#pid").multiselect({
		   selectedList: 1,
		   multiple: false,
		   header: false
		});
	
	});
	
/*]]>*/</script>
<button id="create-video" class="right">Add video</button>
<h1>Videos</h1>
<div style="height:20px;"></div>
<table width="99%" class="rows" style="margin-left: 15px;" border="0" cellspacing="0" id="highlight">
  <tr>
    <th>Vimeo Link</th>
    <th>Producer</th>
    <th>Description</th>
    <th class="left">Operations</th>
  </tr>
<?php foreach ($videos as $v): ?>
  <tr class="stripe topbottom">
    <td><?=$v->link?></td>
    <td>
   
		<?php foreach ($profiles as $p): ?>
		<?php if($v->pid == $p->id): ?> <?=$p->name?> <?=$p->lastname?> <?php endif; ?>
		<?php endforeach; ?>
   
    </td>
    <td><?=$v->description?></td>
    <td class="left"><a href="http://plush.revalorizer.com/index.php/admin/videos/edit/<?=$v->id?>">Edit</a> / <span class="delete"><a href="#" rel="<?=$v->id?>">Delete</a></span></td>
  </tr>
<?php endforeach; ?>
</table>

<div id="dialog-form" title="Add a video from vimeo">
	<div id="videoprev" style="float:right; height:200px; width:348px; text-align: center; border: 1px solid #CCC; margin-top: 50px; margin-right: 20px;"><br /><br /><br /><br /><br /> Insert link to visualize video</div>

	<p class="validateTips">All fields are required</p>
	<form name="new_profile" id="new_profile">
	<fieldset>
		<p>
		<label for="link">Vimeo Link</label>
		<input type="text" name="link" id="link" class="text ui-widget-content ui-corner-all long" />
		</p>
		<p>
		<label for="vidid"><span>Video ID</span></label>
		<input type="text" name="vidid" id="vidid" class="text ui-widget-content ui-corner-all medium"  />
		</p>
		<p>
		<label for="pid"><span>Producer</span></label>
		<select name="pid" id="pid" class="select ui-widget-content ui-corner-all medium">
			<option value="">Select producer</option>
			<?php foreach ($profiles as $p): ?>
			<option value="<?=$p->id?>"><?=$p->name?> <?=$p->lastname?></option>
			<?php endforeach; ?>
		</select>
		</p>
		<p>
		<label for="tags"><span>Filters</span></label>
			<select multiple="multiple" name="tags" id="tags" >
				<?php foreach ($tags as $t): ?>	
					<option value="<?=$t->id?>"><?=$t->name?></option>
				<?php endforeach; ?>
			</select>
		</p>
		<p>
		<label for="bio">Description</label>
		<textarea name="bio" id="bio" value="" cols="40" rows="4" class="textarea ui-widget-content ui-corner-all long" ></textarea>
		</p>
      	
	</fieldset>
	</form>
</div>
<div id="dialog-confirm" title="Delete and dissociate this video?" style="display:none">
	<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>This video will be permanently dissociated from this website and cannot be undone later. Are you sure?</p>
</div>
<?php $this->load->view('admin/footer'); ?>