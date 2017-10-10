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
				url : "<?php echo site_url('setting/user/get_satker')?>",
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

//ready
$("#unker_idx").ready(function(){
	var unker = $("#unker").val();
	var unker_idx = $("#unker_idx").val();
	if(unker_idx){
		$.ajax({
				type: "POST",
				async: false,
				url : "<?php echo site_url('setting/user/get_satker/'.$this->uri->segment(4)); ?>",
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