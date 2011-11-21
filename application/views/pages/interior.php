
<?=$interior->interior?>

<a href="" class="button big grey principal" style="margin-right: 15px;">&lsaquo; volver</a>


<script type="text/javascript">
	$('.principal').click(function() {
		makeLoader();
			$.get('index.php/welcome/principal/<?=$section?>', function(data) {
				$("#content_<?=$section?>").html(data);
				clearLoader()
			});
		return false;
	});
</script>