<script>
$(function () {
 $('.select2').select2();
});
$('#tanggal').datepicker({
		format:'dd-mm-yyyy'
 });
$('#tanggal').inputmask('dd-mm-yyyy');
</script>