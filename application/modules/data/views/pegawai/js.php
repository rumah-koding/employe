<script src="<?= base_url('asset/plugins/wizard/js/jquery.smartWizard.min.js'); ?>"></script>
<script>

$(function () {
	$('.select2').select2();
	$('#tglahir').datepicker({
		format:'dd-mm-yyyy'
 });
	
	$('#tglahir').inputmask('dd-mm-yyyy')
});

$(function(){
  $('#smartwizard').smartWizard({
			theme: 'arrows',
			transitionEffect:'fade',
			lang: {  // Language variables
					next: 'Lanjut', 
					previous: 'Kembali'
			},
			useURLhash: false,
			showStepURLhash:false,
			anchorSettings: {
								anchorClickable: true, // Enable/Disable anchor navigation
								enableAllAnchors: true, // Activates all anchors clickable all times
								markDoneStep: true, // add done css
								enableAnchorOnDoneStep: true // Enable/Disable the done steps navigation
				},      
		});
		
		$(".sw-btn-prev ").addClass('btn-sm btn-flat');
		$(".sw-btn-next ").addClass('btn-sm btn-flat');
});


$(function () {
var key = $("#key").text();
var table;

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
				targets:[ 3 ],visible: false
			}
        ],
		"order": [[ 3, 'asc' ],[ 2, 'asc' ]],
		drawCallback: function ( settings ) {
            var api = this.api();
            var rows = api.rows( {page:'current'} ).nodes();
            var last=null;
            api.column(3, {page:'current'} ).data().each( function ( group, i ) {
                if ( last !== group ) {
                    $(rows).eq( i ).before(
                        '<tr class="group"><td colspan="7"><b>'+group+'</b></td></tr>'
                    );
 
                    last = group;
                }
            } );
        }
    });
});


$("#nip").ready(function(){
var location = window.location.href;
var n = location.search("created");
if( n < 0){
		$("#nip").attr("disabled", true);
}
});
</script>