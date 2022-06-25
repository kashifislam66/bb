$(document).ready(function() {
   var xin_table = $('#xin_table').dataTable({
	"lengthMenu": [[50, 100, 200, 500, -1], [50, 100, 200, 500, "All"]]
	});	
   // edit
	$('.view-modal-data').on('show.bs.modal', function (event) {
		var button = $(event.relatedTarget);
		var field_id = button.data('field_id');
		var time_val = button.data('time_val');
		var attendance_date = button.data('attendance_date');
		var modal_mode = button.data('modal_mode');
		var modal = $(this);
		if(modal_mode == 1){
		$.ajax({
			url :  main_url+"application/read_shift_time",
			type: "GET",
			data: 'jd=1&type=shift_time&field_id='+field_id+'&time_val='+time_val+'&attendance_date='+attendance_date,
			success: function (response) {
				if(response) {
					$("#ajax_view_modal").html(response);
				}
			}
		});
		} else if(modal_mode == 0){
			$.ajax({
				url :  main_url+"application/read_shift_assign",
				type: "GET",
				data: 'jd=1&type=shift_assign&field_id='+field_id,
				success: function (response) {
					if(response) {
						$("#ajax_view_modal").html(response);
					}
				}
			});
		}
	});
	// edit
	$('.edidddddt-modal-data').on('show.bs.modal', function (event) {
		var button = $(event.relatedTarget);
		var field_id = button.data('field_id');
		var modal = $(this);
		
		$.ajax({
			url :  main_url+"application/read_shift_assign",
			type: "GET",
			data: 'jd=1&type=shift_assign&field_id='+field_id,
			success: function (response) {
				if(response) {
					$("#ajax_modal").html(response);
				}
			}
		});
	});
	
	/* Add data */ /*Form Submit*/
	$("#xin-form").submit(function(e){
		var fd = new FormData(this);
		var obj = $(this), action = obj.attr('name');
		fd.append("is_ajax", 1);
		fd.append("type", 'add_record');
		fd.append("form", action);
		e.preventDefault();		
		$.ajax({
			url: e.target.action,
			type: "POST",
			data:  fd,
			contentType: false,
			cache: false,
			processData:false,
			success: function(JSON)
			{
				if (JSON.error != '') {
					toastr.error(JSON.error);
					$('input[name="csrf_token"]').val(JSON.csrf_hash);
					Ladda.stopAll();
				} else {
					xin_table.api().ajax.reload(function(){ 
						toastr.success(JSON.result);
					}, true);
					$('input[name="csrf_token"]').val(JSON.csrf_hash);
					$('#xin-form')[0].reset(); // To reset form fields
					$('.add-form').removeClass('show');
					Ladda.stopAll();
				}
			},
			error: function() 
			{
				toastr.error(JSON.error);
				$('input[name="csrf_token"]').val(JSON.csrf_hash);
					Ladda.stopAll();
			} 	        
	   });
	});
});
$( document ).on( "click", ".delete", function() {
	$('input[name=_token]').val($(this).data('record-id'));
	$('#delete_record').attr('action',main_url+'awards/delete_award');
});