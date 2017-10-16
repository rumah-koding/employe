<script>
$(function () {
	$('.select2').select2();
	
	$('#tglsk, #tmt').datepicker({
		format:'dd-mm-yyyy'
 	});
	
	$('#tglsk, #tmt').inputmask('dd-mm-yyyy');
});

$("#instansi_id").change(function(){
 var instansi = $("#instansi_id").val();
	if(instansi){
		$.ajax({
				type: "POST",
				async: false,
				url : "<?php echo site_url('data/jabatan/get_unker')?>",
				data: {
				   'instansi': instansi,
				   '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
				},
				success: function(msg){
						$('#unker_id').html(msg);
						var select = $("#instansi_id option:selected").text();
						var hasil = select.split(" - ");
						$('#instansi').val(hasil[1]);
				}
		});
	}
});

$("#unker_id").change(function(){
	var instansi = $("#instansi_id").val();
 var unker = $("#unker_id").val();
	if(unker){
		$.ajax({
				type: "POST",
				async: false,
				url : "<?php echo site_url('data/jabatan/get_satker')?>",
				data: {
				   'instansi': instansi,
				   'unker': unker,
				   '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
				},
				success: function(msg){
						$('#satker_id').html(msg);
						var select = $("#unker_id option:selected").text();
						var hasil = select.split(" - ");
						$('#unker').val(hasil[1]);
				}
		});
	}
});

$("#satker_id").change(function(){
	var instansi = $("#instansi_id").val();
 var unker = $("#unker_id").val();
	var satker = $("#satker_id").val();
	if(satker){
						var select = $("#satker_id option:selected").text();
						var hasil = select.split(" - ");
						$('#satker').val(hasil[1]);
				}
	});

$("#jenis").change(function(){
	var instansi = $("#instansi_id").val();
 var unker = $("#unker_id").val();
	var satker = $("#satker_id").val();
	var jenis = $("#jenis").val();
	
	if(jenis){
		$.ajax({
				type: "POST",
				async: false,
				url : "<?php echo site_url('data/jabatan/get_jabatan')?>",
				data: {
				   'instansi': instansi,
				   'unker': unker,
							'satker': satker,
							'jenis': jenis,
				   '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
				},
				success: function(msg){
						$('#jabatan_id').html(msg);
				}
		});
	}
});

$("#jabatan_id").change(function(){
	var instansi = $("#instansi_id").val();
 var unker = $("#unker_id").val();
	var satker = $("#satker_id").val();
	var jabatan = $("#jabatan_id").val();
	if(jabatan){
						var select = $("#jabatan_id option:selected").text();
						var hasil = select.split(" - ");
						$('#jabatan').val(hasil[1]);
				}
	});

//ready
$("#unker_idx").ready(function(){
 var instansi = $("#instansi_id").val();
	var unker_idx = $("#unker_idx").val();
	if(unker_idx){
		$.ajax({
				type: "POST",
				async: false,
				url : "<?php echo site_url('data/jabatan/get_unker/'.$this->uri->segment(4)); ?>",
				data: {
				   'instansi': instansi,
				   '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
				},
				success: function(msg){
						$('#unker_id').html(msg);
				}
		});
	}
});

$("#satker_idx").ready(function(){
	var instansi = $("#instansi_id").val();
 var unker = $("#unker_id").val();
	var satker_idx = $("#satker_idx").val();
	if(satker_idx){
		$.ajax({
				type: "POST",
				async: false,
				url : "<?php echo site_url('data/jabatan/get_satker/'.$this->uri->segment(4)); ?>",
				data: {
				   'instansi': instansi,
				   'unker': unker,
				   '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
				},
				success: function(msg){
						$('#satker_id').html(msg);
				}
		});
	}
});

$("#jabatan_idx").ready(function(){
	var instansi = $("#instansi_id").val();
 var unker = $("#unker_id").val();
	var satker = $("#satker_id").val();
	var jenis = $("#jenis").val();
	var jabatan_idx = $("#jenis").val();
	if(jabatan_idx){
		$.ajax({
				type: "POST",
				async: false,
				url : "<?php echo site_url('data/jabatan/get_jabatan/'.$this->uri->segment(4)); ?>",
				data: {
				   'instansi': instansi,
				   'unker': unker,
							'satker': satker,
							'jenis': jenis,
				   '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
				},
				success: function(msg){
						$('#jabatan_id').html(msg);
				}
		});
	}
});
</script>