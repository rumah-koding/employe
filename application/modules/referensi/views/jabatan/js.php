<script>
$(function () {
 $('.select2').select2();
});

var key = $("#key").text();
var table;

$(function () {
var process = window.location.href+'/ajax_list';
table = $('#tableIDX').DataTable({
      processing:true,
      serverSide:true,
      ajax:{
            url: process,
            type: "POST",
            data : {tokensys:key}
      },
      paging: true,
      lengthChange: false,
      searching: true,
      ordering: true,
      info: true,
      autoWidth: true,
      language: {
        lengthMenu: "Tampilkan _MENU_ Baris",
        zeroRecords: "Maaf - Data Tidak Ditemukan",
        info: "Lihat Halaman _PAGE_ Dari _PAGES_",
        infoEmpty: "Tidak Ada Data Tersedia",
        infoFiltered: "(filtered from _MAX_ total records)",
        paginate: {
            first:"Awal",
            last:"Akhir",
            next:"Lanjut",
            previous:"Sebelum"
            },
        search:"Pencarian:",
        },
		responsive: true,
        columnDefs: [
            { 
                targets:[ 0 ],orderable: false,responsivePriority: 1
            },
            { 
                targets:[ -1 ],orderable: false,responsivePriority: 2
            },
			{
				targets:[ 4 ],visible: false
			}
        ],
		"order": [[ 1, 'asc' ]],
		drawCallback: function ( settings ) {
            var api = this.api();
            var rows = api.rows( {page:'current'} ).nodes();
            var last=null;
            api.column(4, {page:'current'} ).data().each( function ( group, i ) {
                if ( last !== group ) {
                    $(rows).eq( i ).before(
                        '<tr class="group"><td colspan="8"><b>'+group+'</b></td></tr>'
                    );
 
                    last = group;
                }
            } );
        }
    });
});

$("#instansi").change(function(){
    var instansi = $("#instansi").val();
	if(instansi){
		$.ajax({
				type: "POST",
				async: false,
				url : "<?php echo site_url('referensi/jabatan/get_unker')?>",
				data: {
				   'instansi': instansi,
				   '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
				},
				success: function(msg){
					$('#unker').html(msg);
				}
		});
	}
});

$("#unker").change(function(){
				var instansi = $("#instansi").val();
    var unker = $("#unker").val();
	if(unker){
		$.ajax({
				type: "POST",
				async: false,
				url : "<?php echo site_url('referensi/jabatan/get_satker'); ?>",
				data: {
				   'instansi': instansi,
				   'unker': unker,
				   '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
				},
				success: function(msg){
					$('#satker').html(msg);
				}
		});
	}
});

$("#unker_idx").ready(function(){
 var instansi = $("#instansi").val();
	var unker = $("#unker_idx").val();
	if(unker){
		$.ajax({
				type: "POST",
				async: false,
				url : "<?php echo site_url('referensi/jabatan/get_unker/'.$this->uri->segment(4)); ?>",
				data: {
				   'instansi': instansi,
				   '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
				},
				success: function(msg){
					$('#unker').html(msg);
				}
		});
	}
});

$("#satker_idx").ready(function(){
				var instansi = $("#instansi").val();
    var unker = $("#unker").val();
				var satker = $("#satker_idx").val();
	if(satker){
		$.ajax({
				type: "POST",
				async: false,
				url : "<?php echo site_url('referensi/jabatan/get_satker/'.$this->uri->segment(4)); ?>",
				data: {
				   'instansi': instansi,
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