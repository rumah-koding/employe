<script>
$(function () {
	$('.select2').select2();
});

$("#unker").change(function(){
	var unker = $("#unker").val();
	if(unker){
		$.ajax({
				type: "POST",
				async: false,
				url : "<?php echo site_url('lapkin/get_satker')?>",
				data: {
				   'unker': unker,
				   '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
				},
				success: function(msg){
					$('#satker').html(msg);
				}
		});
	}
});
</script>