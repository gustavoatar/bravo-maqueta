<?php if($slider->sys == "jcarousel"): ?>
<ul id="sid_<?=$slider->name?>" class="jcarousel-skin-tango">
	<?php foreach ($images as $i): ?>
		<li><img src="<?=$i->path?>" height="200" alt="" /></li>
	<?php endforeach; ?>
</ul>
<?php elseif($slider->sys == "bxSlider"): ?>
<div>
	<ul id="sid_<?=$slider->name?>" style="width: 780px;">
		
	<?php foreach ($images as $i): ?>
	  <li>
	    <img src="<?=$i->path?>" width="780"  height="200" alt="" />
	  </li>
	<?php endforeach; ?>
	</ul>
</div>
<?php else: ?>

<?php endif; ?>

<?=$slider->code?>