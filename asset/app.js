var key = $("#key").text();
var table;

$(function () {
var process = window.location.href+'/ajax_list';
table = $('#tableID').DataTable({
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

$("#check-all").click(function () {
    $(".data-check").prop('checked', $(this).prop('checked'));
});

function reload_table()
{
    table.ajax.reload(null,false); //reload datatable 
}

function save()
{
    var location = window.location.href;
    var process = location.substring(location.lastIndexOf('/')+1);
    
    if(process == 'created'){
		var current = window.location.toString();
		var url = current.replace(/created/, 'ajax_save');
    }else{
		var current = window.location.toString();
		var url = current.replace(/updated/, 'ajax_update');
    }
    
    $.ajax({
        url : url,
        type: "POST",
        data: $('#formID').serialize(),
        dataType: "JSON",
        success: function(data)
        {
            if(data.success == true){
			  $('#message').append('<div class="alert alert-success">' +
                    '<span class="glyphicon glyphicon-ok"></span>' +
                    ' Data berhasil disimpan.' +
                    '</div>');
			  
                    $('.form-group').removeClass('has-error')
                                    .removeClass('has-success');
                    $('.text-danger').remove();
                    $('#formID')[0].reset();
                    
                    // tutup pesan
                    $('.alert-success').delay(250).show(10, function() {
                        $(this).delay(1000).hide(10, function() {
                        $(this).remove();
                        });
                    })
                    reload_table();
            }else{
                $.each(data.messages, function(key, value) {
                    var element = $('#' + key);
                    element.closest('div.form-group')
                    .removeClass('has-error')
                    .addClass(value.length > 0 ? 'has-error' : 'has-success')
                    .find('.text-danger')
                    .remove();
                    element.after(value);
                });
            }
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Ada kesalahan dalam proses penyimpanan/pembaharuan data.');
        }
    });
}

function saveout()
{
    var location = window.location.href;
    var process = location.substring(location.lastIndexOf('/')+1);
    
    if(process == 'created'){
		var current = window.location.toString();
		var url = current.replace(/created/, 'ajax_save');
    }else{
		var current = window.location.toString();
		var url = current.replace(/updated/, 'ajax_update');
    }
    
    $.ajax({
        url : url,
        type: "POST",
        data: $('#formID').serialize(),
        dataType: "JSON",
        success: function(data)
        {
		if(data.success == true){
			  $('#message').append('<div class="alert alert-success">' +
                    '<span class="glyphicon glyphicon-ok"></span>' +
                    ' Data berhasil disimpan.' +
                    '</div>');
			  
                    $('.form-group').removeClass('has-error')
                                    .removeClass('has-success');
                    $('.text-danger').remove();
                    $('#formID')[0].reset();
                    
                    // tutup pesan
                    $('.alert-success').delay(250).show(10, function() {
                        $(this).delay(1000).hide(10, function() {
                        $(this).remove();
                        });
                    })
                    
				var location = window.location.href;
				var n = location.search("created");
				
				if(n > 0){
					  var current = window.location.toString();
					  var lastIndex = location.substring(location.lastIndexOf('created')-1);
					  var url = current.replace(lastIndex, '');
					  window.location.href = url;
					  reload_table();
				}else{
					  var current = window.location.toString();
					  var lastIndex = location.substring(location.lastIndexOf('updated')-1);
					  var url = current.replace(lastIndex, '');
					  window.location.href = url;
					  reload_table();
				}
            }else{
                $.each(data.messages, function(key, value) {
                    var element = $('#' + key);
                    element.closest('div.form-group')
                    .removeClass('has-error')
                    .addClass(value.length > 0 ? 'has-error' : 'has-success')
                    .find('.text-danger')
                    .remove();
                    element.after(value);
                });
            }
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Ada kesalahan dalam proses penyimpanan/pembaharuan data.');
        }
    });
}

function deleted(id)
{
    if(confirm('Anda yakin akan menghapus data ?'))
    {
        var process = window.location.href+'/ajax_delete/'+id;
	  // ajax delete data to database
        $.ajax({
            url : process,
            type: "POST",
            data: {tokensys:key},
            dataType: "JSON",
            success: function(data)
            {
                $('#message').append('<div class="alert alert-danger">' +
                        '<span class="glyphicon glyphicon-ok"></span>' +
                        ' Data berhasil di hapus.' +
                        '</div>');
                        
                // tutup pesan
                $('.alert-danger').delay(250).show(10, function() {
                    $(this).delay(1000).hide(10, function() {
                    $(this).remove();
                    });
                })
                
                reload_table();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error deleting data');
            }
        });
 
    }
}

function deleted_all()
{
    var list_id = [];
    $(".data-check:checked").each(function() {
            list_id.push(this.value);
    });
    if(list_id.length > 0)
    {
        if(confirm('Anda yakin akan menghapus '+list_id.length+' data?'))
        {
            var process = window.location.href+'/ajax_delete_all/';
		
		$.ajax({
                type: "POST",
                data: {id:list_id,tokensys:key},
                url: process,
                dataType: "JSON",
                success: function(data)
                {
                    if(data.status)
                    {
                        $('#message').append('<div class="alert alert-danger">' +
                            '<span class="glyphicon glyphicon-ok"></span>' +
                            ' Data berhasil di hapus.' +
                            '</div>');
                        
                        // tutup pesan
                        $('.alert-danger').delay(250).show(10, function() {
                            $(this).delay(1000).hide(10, function() {
                            $(this).remove();
                            });
                        })
                        
                        reload_table();
                    }
                    else
                    {
                        alert('Gagal hapus.');
                    }
                     
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Ada kesalahan saat menghapus data.');
                }
            });
        }
    }
    else
    {
        alert('Tidak ada data yang di cek list');
    }
}

function back()
{
    var location = window.location.href;
    var n = location.search("created");
    
    if(n > 0){
		var current = window.location.toString();
		var lastIndex = location.substring(location.lastIndexOf('created')-1);
		var url = current.replace(lastIndex, '');
		window.location.href = url;
		reload_table();
    }else{
		var current = window.location.toString();
		var lastIndex = location.substring(location.lastIndexOf('updated')-1);
		var url = current.replace(lastIndex, '');
		window.location.href = url;
		reload_table();
    }
}

function savebackout()
{
    var location = window.location.href;
    var process = location.substring(location.lastIndexOf('/')+1);
    var id = $("#nip").val();
    
    if(process == 'created'){
		var current = window.location.toString();
		var url = current.replace(/created/, 'ajax_save');
    }else{
		var current = window.location.toString();
		var url = current.replace(/updated/, 'ajax_update');
    }
    
    $.ajax({
        url : url,
        type: "POST",
        data: $('#formID').serialize(),
        dataType: "JSON",
        success: function(data)
        {
		if(data.success == true){
			  $('#message').append('<div class="alert alert-success">' +
                    '<span class="glyphicon glyphicon-ok"></span>' +
                    ' Data berhasil disimpan.' +
                    '</div>');
			  
                    $('.form-group').removeClass('has-error')
                                    .removeClass('has-success');
                    $('.text-danger').remove();
                    $('#formID')[0].reset();
                    
                    // tutup pesan
                    $('.alert-success').delay(250).show(10, function() {
                        $(this).delay(1000).hide(10, function() {
                        $(this).remove();
                        });
                    })
                    
				var location = window.location.href;
				var n = location.search("created");
				
				if(n > 0){
					var base_url = window.location.origin;
					var current = window.location.toString();
					var lastIndex = location.substring(location.lastIndexOf('/')+1);
					var url = current.replace(lastIndex, '');
					var redirect = base_url+'/simpeg3/data/identitas/'+id;
					//var redirect = base_url+'/simpeg3/data/identitas/'+lastIndex;
					//var pathArray = window.location.pathname.split( '/' );
					//alert(redirect);
					window.location.href = redirect;
					//reload_table();
				}else{
					var base_url = window.location.origin;
					var current = window.location.toString();
					var lastIndex = location.substring(location.lastIndexOf('/')+1);
					var url = current.replace(lastIndex, '');
					var redirect = base_url+'/simpeg3/data/identitas/'+id;
					
					window.location.href = redirect
					//reload_table();
				}
            }else{
                $.each(data.messages, function(key, value) {
                    var element = $('#' + key);
                    element.closest('div.form-group')
                    .removeClass('has-error')
                    .addClass(value.length > 0 ? 'has-error' : 'has-success')
                    .find('.text-danger')
                    .remove();
                    element.after(value);
                });
            }
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Ada kesalahan dalam proses penyimpanan/pembaharuan data.');
        }
    });
}

function backward()
{
    var location = window.location.href;
    var n = location.search("created");
    var id = $("#nip").val();
    if(n > 0){
		var base_url = window.location.origin;
		var current = window.location.toString();
		var lastIndex = location.substring(location.lastIndexOf('/')+1);
		var url = current.replace(lastIndex, '');
		var redirect = base_url+'/simpeg3/data/identitas/'+id;
		//var redirect = base_url+'/simpeg3/data/identitas/'+lastIndex;
		//var pathArray = window.location.pathname.split( '/' );
		//alert(redirect);
		window.location.href = redirect;
		//reload_table();
    }else{
		var base_url = window.location.origin;
		var current = window.location.toString();
		var lastIndex = location.substring(location.lastIndexOf('/')+1);
		var url = current.replace(lastIndex, '');
		var redirect = base_url+'/simpeg3/data/identitas/'+id;
		
		window.location.href = redirect
		//reload_table();
    }
}

$(document).keypress(function(e) {
  if(e.which == 13) {
    saveout();
  }
});