<script>
$(function () {
 $('.select2').select2();
});
$('#tglsk, #mulai, #akhir').datepicker({
		format:'dd-mm-yyyy'
 });

	$('#tglsk, #mulai, #akhir').inputmask('dd-mm-yyyy');
</script>