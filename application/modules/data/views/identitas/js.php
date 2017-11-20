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

$(document).on('click', '#getUser', function(e){
		e.preventDefault();
		var uid = $(this).data('id'); // get id of clicked row
        var modul = $(this).data('modul'); // get id of clicked row
        var nip = $(this).data('nip'); // get id of clicked row
		$('#dynamic-content').html(''); // leave this div blank
		$('#modal-loader').show();      // load ajax loader on button click
	
		$.ajax({
			url: '<?php echo site_url('data/file/get_file'); ?>',
			type: 'POST',
			data: {
				   'id': uid,
                   'modul': modul,
                   'nip': nip,
				   '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
			},
			dataType: 'html'
		})
		.done(function(data){
			console.log(data); 
			$('#dynamic-content').html(''); // blank before load.
			$('#dynamic-content').html(data); // load here
			$('#modal-loader').hide(); // hide loader  
		})
		.fail(function(){
			$('#dynamic-content').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
			$('#modal-loader').hide();
		});

});

// function upload_file()
// {
//     var id = $(this).data('id');
//     var modul = $(this).data('modul');
    
//     $.ajax({
//         url : '<?= site_url('data/file/upload'); ?>',
//         type: "POST",
//         data: {
//             'modul_id': id,
//             'modul': modul,
//             '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
// 		},
//         //dataType: "JSON",
//         success: function(data)
//         {
//             if(data.success == true){
			  
//             }else{
                
//             }
//         },
//         error: function (jqXHR, textStatus, errorThrown)
//         {
//             alert('Ada kesalahan dalam proses upload dokumen, perhatikan tipe file dan ukuran file yang diperkenankan.');
//         }
//     });
// }
</script>