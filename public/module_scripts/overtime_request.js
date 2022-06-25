$(document).ready(function() {
var xin_table = $('#xin_table').dataTable({
	"bDestroy": true,
	"ajax": {
		url : main_url+"timesheet/overtime_request_list",
		type : 'GET'
	},
	"language": {
		"lengthMenu": dt_lengthMenu,
		"zeroRecords": dt_zeroRecords,
		"info": dt_info,
		"infoEmpty": dt_infoEmpty,
		"infoFiltered": dt_infoFiltered,
		"search": dt_search,
		"paginate": {
			"first": dt_first,
			"previous": dt_previous,
			"next": dt_next,
			"last": dt_last
		},
	},
	"fnDrawCallback": function(settings){
	$('[data-toggle="tooltip"]').tooltip();          
	}
});
$(".overtime_reason").change(function() {
	var overtime_reason = $(this).val();
	if (overtime_reason == 1) {
	  //  $("#banked_class").prop('disabled',true);
	  if ($("#banked_class").parent().is(':not(.check-wrap-sapn)')){
	   $("#banked_class").wrap("<div class='check-wrap-sapn'></div>");
	  }
	   
	}else {
	  // $("#banked_class").prop('disabled',false);
	  if ($("#banked_class").parent().is('.check-wrap-sapn')){
		$("#banked_class").unwrap();
	  }
	  
	}
	if (overtime_reason == 5) {
		$('.additional-work-hours').show();
	} else {
		$('.additional-work-hours').hide();
	}
});
$('[data-plugin="select_hrm"]').select2($(this).attr('data-options'));
$('[data-plugin="select_hrm"]').select2({ width:'100%' }); 
	
/* Delete data */
$("#delete_record").submit(function(e){
/*Form Submit*/
e.preventDefault();
	var obj = $(this), action = obj.attr('name');
	$.ajax({
		type: "POST",
		url: e.target.action,
		data: obj.serialize()+"&is_ajax=true&type=delete_record&form="+action,
		cache: false,
		success: function (JSON) {
			if (JSON.error != '') {
				toastr.error(JSON.error);
				$('input[name="csrf_token"]').val(JSON.csrf_hash);
				Ladda.stopAll();
			} else {
				$('.delete-modal').modal('toggle');
				xin_table.api().ajax.reload(function(){ 
					toastr.success(JSON.result);
				}, true);	
				$('input[name="csrf_token"]').val(JSON.csrf_hash);	
				Ladda.stopAll();					
			}
		}
	});
});

$('.view-modal-data').on('show.bs.modal', function (event) {
	var button = $(event.relatedTarget);
	var modal = $(this);
	$.ajax({
		url: main_url+'timesheet/read_overtime_request',
		type: "GET",
		data: 'jd=1&is_ajax=9&mode=modal&data=add_attendance&type=add_attendance&field_id=1',
		success: function (response) {
			if(response) {
				$("#ajax_view_modal").html(response);
			}
		}
	});
});
$("#update_overtime_status").submit(function(e){
	/*Form Submit*/
	e.preventDefault();
		var obj = $(this), action = obj.attr('name');
		$.ajax({
			type: "POST",
			url: e.target.action,
			data: obj.serialize()+"&is_ajax=3&type=edit_record&form="+action,
			cache: false,
			success: function (JSON) {
				if (JSON.error != '') {
					toastr.error(JSON.error);
					$('input[name="csrf_token"]').val(JSON.csrf_hash);
					Ladda.stopAll();
				} else {
					toastr.success(JSON.result);
					$('input[name="csrf_token"]').val(JSON.csrf_hash);
					Ladda.stopAll();
					setTimeout(function(){
						window.location = '';
					}, 2000);			
				}
			}
		});
	});
 /* Add Attendance*/
$("#add_attendance").submit(function(e) {
	/*Form Submit*/
	e.preventDefault();
	var obj = $(this),
		action = obj.attr('name');
	$('.save').prop('disabled', true);
	$.ajax({
		type: "POST",
		url: e.target.action,
		data: obj.serialize() + "&is_ajax=4&type=add_record&form=" + action,
		cache: false,
		success: function(JSON) {
			if (JSON.error != '') {
				toastr.error(JSON.error);
				$('input[name="csrf_token"]').val(JSON.csrf_hash);
				Ladda.stopAll();
			} else {
				xin_table.api().ajax.reload(function(){ 
					toastr.success(JSON.result);
				}, true);
				$('input[name="csrf_token"]').val(JSON.csrf_hash);
				$('#add_attendance')[0].reset(); // To reset form fields
				$('.add-form').removeClass('show');
				Ladda.stopAll();
			}
		}
	});
});
// edit
$('.edit-modal-data').on('show.bs.modal', function (event) {
	var button = $(event.relatedTarget);
	var field_id = button.data('field_id');
	var opt_type = button.data('opt_type');
	var modal = $(this);
	if(opt_type == 'request_edit'){
		$.ajax({
		url : main_url+"timesheet/read_overtime_request",
		type: "GET",
		data: 'jd=1&is_ajax=1&mode=modal&data=view_attendance&type=view_attendance&field_id='+field_id,
		success: function (response) {
			if(response) {
				$("#ajax_modal").html(response);
			}
		}
		});
	} else {
		$.ajax({
		url : main_url+"timesheet/read_overtime_request",
		type: "GET",
		data: 'jd=1&is_ajax=1&mode=modal&data=edit_attendance&type=edit_attendance&field_id='+field_id,
		success: function (response) {
			if(response) {
				$("#ajax_modal").html(response);
			}
		}
		});
	}
});
});
$( document ).on( "click", ".delete", function() {
$('input[name=_token]').val($(this).data('record-id'));
$('#delete_record').attr('action',main_url+'timesheet/delete_overtime');
});
