<script>
$(function () {
    $('.select2').select2();
	
	$('#tglsk, #tmt').datepicker({
		format:'dd-mm-yyyy'
 	});
	
	$('#tglsk, #tmt').inputmask('dd-mm-yyyy');
});
</script>