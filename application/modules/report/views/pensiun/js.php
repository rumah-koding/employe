<script src="<?php echo base_url(); ?>asset/plugins/tableexport/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>asset/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>asset/plugins/tableexport/js-xlsx/xlsx.core.min.js"></script>
<script src="<?php echo base_url(); ?>asset/plugins/tableexport/Blob.js"></script>
<script src="<?php echo base_url(); ?>asset/plugins/tableexport/FileSaver.min.js"></script>
<script src="<?php echo base_url(); ?>asset/plugins/tableexport/dist/js/tableexport.js"></script>
<script>

function myFunction(){
	$("#tableIDX").tableExport({
		bootstrap: true,
		formats: ["xlsx","txt"],
		position: "top",
		fileName: "PENSIUN-<?php echo date('dmyyyy'); ?>"
	});
				
	table = $('#tableIDX').DataTable({
		"paging": false,
		"searching": false,
		"ordering": false,
		"info": false,
		"autoWidth": true,
		"responsive" :true
	});

};

$("#process").on('click', function(){
	var tahun = $("#tahun").val();
	if(tahun){
		$.ajax({
				type: "POST",
				async: false,
				url : "<?php echo site_url('report/pensiun/get_pensiun')?>",
				data: {
				   'tahun': tahun,
				   '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
				},
				success: function(msg){
					$('#report').html(msg);
					myFunction();
				}
		});
	}
});
</script>