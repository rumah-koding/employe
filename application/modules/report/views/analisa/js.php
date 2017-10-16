<script type="text/javascript">
$(function () {
e = $("#tableIDX").tableExport({
        bootstrap: true,
        formats: ["xlsx","txt"],
        position: "top",
        fileName: "PETA-<?php echo date('dmyyyy'); ?>",
    });

table = $('#tableIDX').DataTable({
    "paging": false,
    "searching": true,
    "ordering": false,
    "info": false,
    "autoWidth": true,
	"responsive" :true,
    "columnDefs":[{
        "searchable" : false,
        "orderable" : false,
        "targets" : 0
    },
    { "visible": 'false', "targets": 1 }],
    "drawCallback": function ( settings ) {
            var api = this.api();
            var rows = api.rows( {page:'current'} ).nodes();
            var last=null;
 
            api.column(1, {page:'current'} ).data().each( function ( group, i ) {
                if ( last !== group ) {
                    $(rows).eq( i ).before(
                        '<tr class="group" ><td colspan="12"><strong>'+group+'</strong></td></tr>'
                    );

                    last = group;
                }
            } );
        }
		});
    });
</script>