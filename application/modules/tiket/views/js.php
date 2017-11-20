<!-- DataTables -->
<script src="<?php echo base_url(); ?>asset/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>asset/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.1.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.1.0/js/responsive.bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>asset/plugins/bootstrap-dialog/dist/js/bootstrap-dialog.min.js"></script>
<script src="<?php echo base_url(); ?>asset/plugins/bootstrap-typeahead/bootstrap.typeahead.min.js" type="text/javascript"></script>
<script type="text/javascript">
$(function () {
    
   $('#datatable').DataTable({
    "paging": true,
    "lengthChange": false,
    "searching": true,
    "ordering": true,
    "info": true,
    "autoWidth": true,
    "language": {
        "lengthMenu": "Tampilkan _MENU_ Baris",
        "zeroRecords": "Maaf - Data Tidak Ditemukan",
        "info": "Lihat Halaman _PAGE_ Dari _PAGES_",
        "infoEmpty": "Tidak Ada Data Tersedia",
        "infoFiltered": "(filtered from _MAX_ total records)",
        "paginate": {
            "first":      "Awal",
            "last":       "Akhir",
            "next":       "Lanjut",
            "previous":   "Sebelum"
        },
        "search":         "Pencarian:"
    },
    "order" : [[4, "asc"]],
    "responsive": true,
    "columnDefs": [
            { responsivePriority: 1, targets: 1 },
            { responsivePriority: 2, targets: 2 },
            { responsivePriority: 3, targets: 5 }
        ]
  });
   
   $(".select2").select2();
});
</script>