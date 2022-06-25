$(document).ready(function() {
	// edit
	$('.edit-modal-data').on('show.bs.modal', function (event) {
		var button = $(event.relatedTarget);
		var field_id = button.data('field_id');
		var modal = $(this);
	$.ajax({
		url : main_url+"policies/read_policy_flipbook",
		type: "GET",
		data: 'jd=1&data=policy&field_id='+field_id,
		success: function (response) {
			if(response) {
				$("#ajax_modal").html(response);
			}
		}
		});
	});
	// view
	$('.view-modal-data').on('show.bs.modal', function (event) {
		var button = $(event.relatedTarget);
		var modal = $(this);
		$.ajax({
			url : main_url+"leave/read_leave",
			type: "GET",
			data: 'jd=1&data=leave_summary&field_id=type',
			success: function (response) {
				if(response) {
					$("#ajax_view_modal").html(response);
				}
			}
		});
	});
	// fill form
	
	$("#fill-form").submit(function(e){
		var fd = new FormData(this);
		var obj = $(this), action = obj.attr('name');
		var form_id = $('.fill-form').val();
		fd.append("is_ajax", 1);
		fd.append("type", 'fillform');
		fd.append("form", action);
		e.preventDefault();		
		window.location = main_url+'submit-form/'+form_id;
	});
});