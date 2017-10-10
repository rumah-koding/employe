<script src="<?= base_url('asset/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js'); ?>"></script>
<script>
$(function () {
	$('.select2').select2();
	$('#informasi').wysihtml5();
	$('#tanggal').datepicker({
		format:'dd-mm-yyyy'
	});
	
	$('#tangal').inputmask('dd-mm-yyyy');
});
</script>