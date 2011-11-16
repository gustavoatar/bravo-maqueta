 <script src="//ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
  <script>window.jQuery || document.write('<script src="http://prod.bravopublicidad.es/js/libs/jquery-1.6.2.min.js"><\/script>')</script>
<style type="text/css">
<!--

.arrow {
height: 86px;
width: 60px;
position: absolute;
background: url('/img/arrows.png') no-repeat;
cursor: pointer;
z-index: 900;
top: 45%;
}

.arrow a {
	width: 50px;
	height: 80px;
	overflow: auto;
	
}

.previous {
background-position: left top;
left: 0;
}

.next {
background-position: right top;
right: 0;
}

h1.title, h2.node-title, h2.block-title, h2.title, h2.comment-form, h3.title {
margin: 0;
color: #172983;
text-shadow: 1px 1px 1px #CCCCCC;
font-family: "ITCOfficinaSansStdBook", Arial, Helvetica, sans-serif;
}
-->
</style>

<div style="margin: 0 auto;">
	<h1 class="title">Marcas con las que hemos trabajado </h1><br /><br />
	<table width="95%" class="rows" style="margin-left: 15px;" >
	  <tr>
	    <th></th>
	    <th></th>
	    <th></th>
	    <th></th>
	    <th></th>
	  </tr>
	<?php $i=0 ?>
	<?php foreach ($logos as $image): ?>
	  <?php if($i==0) { echo "<tr>"; } ?>
		<?php if($i<5): ?>
			<td class="photos"><img border="0" src="<?=$image->path?><?=$image->name?>" /><td>
	  	<?php endif; ?>
	  <?php if($i==4) { echo "</tr>"; } ?>
	  <?php if($i==4) { $i=0; } else { $i++; } ?>
	<?php endforeach; ?>
	</table>
</div>
<?php echo $this->pagination->create_links(); ?>

<script type="text/javascript">
$(function(){
	$(".arrow").click(function() {
		var link = $(this).find("a").attr("href");
		window.location.href = link;
	});
});

</script>
