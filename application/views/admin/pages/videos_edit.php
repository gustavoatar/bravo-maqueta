<?php $this->load->view('admin/header'); ?>

<?php if($result) { ?>
<div class="updated">Video updated. <a href="/index.php/admin/videos">Go to list of videos</a></div>	
<?php } ?>

<h1>Editing video properties</h1>
<script>

$(function() {
	$("#pid").multiselect({
	   selectedList: 1,
	   multiple: false,
	   header: false
	});
	
	$("#tags").multiselect({
	   selectedList: 10,
	   header: false
	});
});
</script>

<div style="float:right; height:auto; width:auto">
	<?php print $embedded[0]->html; ?>
</div>
<form name="edit_video" id="edit_video" method="post" enctype="application/x-www-form-urlencoded" class="open_edit">
	
	<label class="s" for="link">Link</label>
	<input value="<?=$video->link?>" type="text" name="anything" id="link" class="text ui-widget-content ui-corner-all medium" />
	
	<label class="s" for="videoid"><span>Video ID</span></label>
	<input value="<?=$video->video_id?>" type="text" name="videoid" id="videoid" class="text ui-widget-content ui-corner-all medium"  />
	
	<label class="s" for="pid"><span>Producer</span></label>
	<select name="pid" id="pid" class="select ui-widget-content ui-corner-all medium">
		<?php foreach ($profiles as $p): ?>
		<option <?php if($video->pid == $p->id) echo 'selected="selected"'; ?> value="<?=$video->pid?>"><?=$p->name?> <?=$p->lastname?></option>
		<?php endforeach; ?>
	</select>

	<label class="s" for="tags"><span>Filters</span></label>
	<select multiple="multiple" name="tags[]" id="tags" >
		<?php foreach ($tags as $t): ?>
			
			<?php if(in_array($t->id, $tags_selected)): ?>
				<option selected="selected" value="<?=$t->id?>"><?=$t->name?></option>
			<?php else: ?>
				<option value="<?=$t->id?>"><?=$t->name?></option>
			<?php endif; ?>
			
		<?php endforeach; ?>
	</select>
	
	<label class="s" for="description"><span>Description</span></label>
	<textarea name="description" id="description" cols="40" rows="5" class="text ui-widget-content ui-corner-all large"><?=$video->description?></textarea>
	
	
	<label>
		<input type="submit" class="padding ui-widget-content ui-corner-all" name="modify_video" value="Update video" />
    </label>
</form>



<?php $this->load->view('admin/footer'); ?>