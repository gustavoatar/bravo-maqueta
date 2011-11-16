<a href="" class="button big grey principal" style="float:left; margin-right: 15px;">&lsaquo; volver</a>

<?=$interior->interior?>


<script type="text/javascript">
	$('.principal').click(function() {
		makeLoader();
			$.get('index.php/welcome/interior/<?=$section?>', function(data) {
				$("#content_<?=$section?>").html(data);
				clearLoader()
			});
		return false;
	});
</script>