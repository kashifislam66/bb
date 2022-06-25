$(document).ready(function() {	
	/* Delete data */
	$("#delete_record").submit(function(e){
	/*Form Submit*/
	e.preventDefault();
		var obj = $(this), action = obj.attr('name');
		$.ajax({
			type: "POST",
			url: e.target.action,
			data: obj.serialize()+"&is_ajax=2&type=delete_record&form="+action,
			cache: false,
			success: function (JSON) {
				if (JSON.error != '') {
					toastr.error(JSON.error);
					$('input[name="csrf_token"]').val(JSON.csrf_hash);
					Ladda.stopAll();
				} else {
					toastr.success(JSON.result);
					$('.delete-modal').modal('toggle');		
					$('input[name="csrf_token"]').val(JSON.csrf_hash);	
					Ladda.stopAll();
					setTimeout(function(){
						window.location = '';
					}, 3000);			
				}
			}
		});
	});
	$('.view-modal-data').on('show.bs.modal', function (event) {
		var button = $(event.relatedTarget);
		var modal = $(this);
	$.ajax({
		url :  main_url+"forms/read_form",
		type: "GET",
		data: 'jd=1&type=form_progress&field_id=1',
		success: function (response) {
			if(response) {
				$("#ajax_view_modal").html(response);
			}
		}
		});
	});
	$('.edit-modal-data').on('show.bs.modal', function (event) {
		var button = $(event.relatedTarget);
		var field_id = button.data('field_id');
		var modal = $(this);
		$.ajax({
		url :  main_url+"forms/read_form_progress",
		type: "GET",
		data: 'jd=1&type=form_progress&field_id='+field_id,
		success: function (response) {
			if(response) {
				$("#ajax_modal").html(response);
			}
		}
		});
	});
	$("#update_submited_status").submit(function(e){
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
				}
			}
		});
	});
	jQuery(".form-status").click(function(){
		var status_val = $(this).data('status_val');
		var record_id = $(this).data('record_id');
		jQuery.get(main_url+"forms/change_form_status?record_id="+record_id+"&status_val="+status_val, function(data, status){
			toastr.success(data);
			setTimeout(function(){
				window.location = '';
			}, 2000);
		});
	});
	/* Add data */ /*Form Submit*/
	$("#xin-form").submit(function(e){
		var fd = new FormData(this);
		if($('#allow_attachment_1').is(':checked')) {
			var is_allow_attachment = 1;
		} else {
			var is_allow_attachment = 0;
		}
		if($('#allow_attachment_mandatory_1').is(':checked')) {
			var is_attachment_mandatory = 1;
		} else {
			var is_attachment_mandatory = 0;
		}
		if($('#allow_supervisor_1').is(':checked')) {
			var is_allow_supervisor = 1;
		} else {
			var is_allow_supervisor = 0;
		}
		var obj = $(this), action = obj.attr('name');
		fd.append("is_ajax", 1);
		fd.append("is_allow_attachment", is_allow_attachment);
		fd.append("is_attachment_mandatory", is_attachment_mandatory);
		fd.append("is_allow_supervisor", is_allow_supervisor);
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
					toastr.success(JSON.result);
					$('input[name="csrf_token"]').val(JSON.csrf_hash);
					Ladda.stopAll();
					setTimeout(function(){
						window.location = main_url+'forms-builder';
					}, 3000);
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
	$( ".approval_level_options" ).change(function() {
		var approval_level = $(this).val();
		if(approval_level == 0){
			$('.form-approval-level-default').hide();
		} else if(approval_level == 1){
			$('.form-approval-level-default').hide();
			$('.form-approval-level-one').show();
		} else if(approval_level == 2){
			$('.form-approval-level-default').hide();
			$('.form-approval-level-one, .form-approval-level-two').show();
		} else if(approval_level == 3){
			$('.form-approval-level-default').hide();
			$('.form-approval-level-one, .form-approval-level-two, .form-approval-level-three').show();
		} else if(approval_level == 4){
			$('.form-approval-level-default').hide();
			$('.form-approval-level-one, .form-approval-level-two, .form-approval-level-three, .form-approval-level-four').show();
		} else if(approval_level == 5){
			$('.form-approval-level-default').hide();
			$('.form-approval-level-one, .form-approval-level-two, .form-approval-level-three, .form-approval-level-four, .form-approval-level-five').show();
		}
	});
});
jQuery(document).on('click','.remove-invoice-item', function () {
	$(this).closest('.item-row').fadeOut(300, function() {
		$(this).remove();
	});
});
jQuery(document).on('change','.allow_supervisor_1', function () {
	if($(this).is(':checked')) {  
		$('.show-supervisor').show();
	} else {
		$('.show-supervisor').hide();
	}
});
$( document ).on( "click", ".delete", function() {
	$('input[name=_token]').val($(this).data('record-id'));
	$('#delete_record').attr('action',main_url+'forms/delete_form');
});
jQuery(document).on('click','.remove-invoice-item-ol', function () {
	var record_id = $(this).data('record-id');
	$(this).closest('.item-row').fadeOut(300, function() {
	jQuery.get(main_url+"/forms/delete_form_field_item?record_id="+record_id, function(data, status){
	});
	$(this).remove();
	});
});