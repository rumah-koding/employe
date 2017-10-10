<script>
$(function () {
 $('.select2').select2();
});

$(function () {
$('#tableID1, #tableID2, #tableID3, #tableID4').DataTable({
      paging: false,
      lengthChange: false,
      searching: false,
      ordering: true,
      info: false,
      autoWidth: false,
						responsive: true,
      columnDefs: [
            { 
                targets:[ 0 ],
																orderable: false,
																responsivePriority: 1
            },
            { 
                targets:[ -1 ],
                orderable: false,
																responsivePriority: 2
            },
        ]
    });
});
</script>