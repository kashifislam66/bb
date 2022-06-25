$(document).ready(function() {
	/* Add data */ /*Form Submit*/
	$("#leave-settings").submit(function(e){
		var fd = new FormData(this);
		var obj = $(this), action = obj.attr('name');
		fd.append("is_ajax", 1);
		fd.append("type", 'edit_record');
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
						window.location = '';
					}, 2000);
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
	$("#attendance-settings").submit(function(e){
		var fd = new FormData(this);
		var obj = $(this), action = obj.attr('name');
		fd.append("is_ajax", 1);
		fd.append("type", 'edit_record');
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
						window.location = '';
					}, 2000);
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
	/* Add data */ /*Form Submit*/
	$("#attendance-approval-settings").submit(function(e){
		var fd = new FormData(this);
		var obj = $(this), action = obj.attr('name');
		fd.append("is_ajax", 1);
		fd.append("type", 'edit_record');
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
						window.location = '';
					}, 2000);
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
	/* Add data */ /*Form Submit*/
	$("#leave-approval-settings").submit(function(e){
		var fd = new FormData(this);
		var obj = $(this), action = obj.attr('name');
		fd.append("is_ajax", 1);
		fd.append("type", 'edit_record');
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
						window.location = '';
					}, 2000);
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
	/* Add data */ /*Form Submit*/
	$("#leave-adjustment-approval-settings").submit(function(e){
		var fd = new FormData(this);
		var obj = $(this), action = obj.attr('name');
		fd.append("is_ajax", 1);
		fd.append("type", 'edit_record');
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
						window.location = '';
					}, 2000);
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
	/* Add data */ /*Form Submit*/
	$("#travel-approval-settings").submit(function(e){
		var fd = new FormData(this);
		var obj = $(this), action = obj.attr('name');
		fd.append("is_ajax", 1);
		fd.append("type", 'edit_record');
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
						window.location = '';
					}, 2000);
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
	/* Add data */ /*Form Submit*/
	$("#overtime-request-approval-settings").submit(function(e){
		var fd = new FormData(this);
		var obj = $(this), action = obj.attr('name');
		fd.append("is_ajax", 1);
		fd.append("type", 'edit_record');
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
						window.location = '';
					}, 2000);
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
	/* Add data */ /*Form Submit*/
	$("#incident-approval-settings").submit(function(e){
		var fd = new FormData(this);
		var obj = $(this), action = obj.attr('name');
		fd.append("is_ajax", 1);
		fd.append("type", 'edit_record');
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
						window.location = '';
					}, 2000);
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
	/* Add data */ /*Form Submit*/
	$("#transfer-approval-settings").submit(function(e){
		var fd = new FormData(this);
		var obj = $(this), action = obj.attr('name');
		fd.append("is_ajax", 1);
		fd.append("type", 'edit_record');
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
						window.location = '';
					}, 2000);
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
	/* Add data */ /*Form Submit*/
	$("#resignation-approval-settings").submit(function(e){
		var fd = new FormData(this);
		var obj = $(this), action = obj.attr('name');
		fd.append("is_ajax", 1);
		fd.append("type", 'edit_record');
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
						window.location = '';
					}, 2000);
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
	/* Add data */ /*Form Submit*/
	$("#complaint-approval-settings").submit(function(e){
		var fd = new FormData(this);
		var obj = $(this), action = obj.attr('name');
		fd.append("is_ajax", 1);
		fd.append("type", 'edit_record');
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
						window.location = '';
					}, 2000);
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
	/* Add data */ /*Form Submit*/
	$("#leave-adjustment-settings").submit(function(e){
		var fd = new FormData(this);
		var obj = $(this), action = obj.attr('name');
		fd.append("is_ajax", 1);
		fd.append("type", 'edit_record');
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
						window.location = '';
					}, 2000);
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
	/* Add data */ /*Form Submit*/
	$("#travel-settings").submit(function(e){
		var fd = new FormData(this);
		var obj = $(this), action = obj.attr('name');
		fd.append("is_ajax", 1);
		fd.append("type", 'edit_record');
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
						window.location = '';
					}, 2000);
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
	/* Add data */ /*Form Submit*/
	$("#overtime-request-settings").submit(function(e){
		var fd = new FormData(this);
		var obj = $(this), action = obj.attr('name');
		fd.append("is_ajax", 1);
		fd.append("type", 'edit_record');
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
						window.location = '';
					}, 2000);
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
	/* Add data */ /*Form Submit*/
	$("#incident-settings").submit(function(e){
		var fd = new FormData(this);
		var obj = $(this), action = obj.attr('name');
		fd.append("is_ajax", 1);
		fd.append("type", 'edit_record');
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
						window.location = '';
					}, 2000);
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
	/* Add data */ /*Form Submit*/
	$("#transfer-settings").submit(function(e){
		var fd = new FormData(this);
		var obj = $(this), action = obj.attr('name');
		fd.append("is_ajax", 1);
		fd.append("type", 'edit_record');
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
						window.location = '';
					}, 2000);
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
	/* Add data */ /*Form Submit*/
	$("#resignation-settings").submit(function(e){
		var fd = new FormData(this);
		var obj = $(this), action = obj.attr('name');
		fd.append("is_ajax", 1);
		fd.append("type", 'edit_record');
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
						window.location = '';
					}, 2000);
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
	/* Add data */ /*Form Submit*/
	$("#complaints-settings").submit(function(e){
		var fd = new FormData(this);
		var obj = $(this), action = obj.attr('name');
		fd.append("is_ajax", 1);
		fd.append("type", 'edit_record');
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
						window.location = '';
					}, 2000);
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
	$( ".leave_approval_levels" ).change(function() {
		var approval_level = $(this).val();
		if(approval_level == 0){
			$('.leave-approval-level-default').hide();
		} else if(approval_level == 1){
			$('.leave-approval-level-default').hide();
			$('.leave-approval-level-one').show();
		} else if(approval_level == 2){
			$('.leave-approval-level-default').hide();
			$('.leave-approval-level-one, .leave-approval-level-two').show();
		} else if(approval_level == 3){
			$('.leave-approval-level-default').hide();
			$('.leave-approval-level-one, .leave-approval-level-two, .leave-approval-level-three').show();
		} else if(approval_level == 4){
			$('.leave-approval-level-default').hide();
			$('.leave-approval-level-one, .leave-approval-level-two, .leave-approval-level-three, .leave-approval-level-four').show();
		} else if(approval_level == 5){
			$('.leave-approval-level-default').hide();
			$('.leave-approval-level-one, .leave-approval-level-two, .leave-approval-level-three, .leave-approval-level-four, .leave-approval-level-five').show();
		}
	});
	$( ".leave_adjust_approval_levels" ).change(function() {
		var approval_level = $(this).val();
		if(approval_level == 0){
			$('.leave-adjust-approval-level-default').hide();
		} else if(approval_level == 1){
			$('.leave-adjust-approval-level-default').hide();
			$('.leave-adjust-approval-level-one').show();
		} else if(approval_level == 2){
			$('.leave-adjust-approval-level-default').hide();
			$('.leave-adjust-approval-level-one, .leave-adjust-approval-level-two').show();
		} else if(approval_level == 3){
			$('.leave-adjust-approval-level-default').hide();
			$('.leave-adjust-approval-level-one, .leave-adjust-approval-level-two, .leave-adjust-approval-level-three').show();
		} else if(approval_level == 4){
			$('.leave-adjust-approval-level-default').hide();
			$('.leave-adjust-approval-level-one, .leave-adjust-approval-level-two, .leave-adjust-approval-level-three, .leave-adjust-approval-level-four').show();
		} else if(approval_level == 5){
			$('.leave-adjust-approval-level-default').hide();
			$('.leave-adjust-approval-level-one, .leave-adjust-approval-level-two, .leave-adjust-approval-level-three, .leave-adjust-approval-level-four, .leave-adjust-approval-level-five').show();
		}
	});
	$( ".travel_approval_levels" ).change(function() {
		var approval_level = $(this).val();
		if(approval_level == 0){
			$('.travel-approval-level-default').hide();
		} else if(approval_level == 1){
			$('.travel-approval-level-default').hide();
			$('.travel-approval-level-one').show();
		} else if(approval_level == 2){
			$('.travel-approval-level-default').hide();
			$('.travel-approval-level-one, .travel-approval-level-two').show();
		} else if(approval_level == 3){
			$('.travel-approval-level-default').hide();
			$('.travel-approval-level-one, .travel-approval-level-two, .travel-approval-level-three').show();
		} else if(approval_level == 4){
			$('.travel-approval-level-default').hide();
			$('.travel-approval-level-one, .travel-approval-level-two, .travel-approval-level-three, .travel-approval-level-four').show();
		} else if(approval_level == 5){
			$('.travel-approval-level-default').hide();
			$('.travel-approval-level-one, .travel-approval-level-two, .travel-approval-level-three, .travel-approval-level-four, .travel-approval-level-five').show();
		}
	});
	$( ".overtime_approval_levels" ).change(function() {
		var approval_level = $(this).val();
		if(approval_level == 0){
			$('.overtime-approval-level-default').hide();
		} else if(approval_level == 1){
			$('.overtime-approval-level-default').hide();
			$('.overtime-approval-level-one').show();
		} else if(approval_level == 2){
			$('.overtime-approval-level-default').hide();
			$('.overtime-approval-level-one, .overtime-approval-level-two').show();
		} else if(approval_level == 3){
			$('.overtime-approval-level-default').hide();
			$('.overtime-approval-level-one, .overtime-approval-level-two, .overtime-approval-level-three').show();
		} else if(approval_level == 4){
			$('.overtime-approval-level-default').hide();
			$('.overtime-approval-level-one, .overtime-approval-level-two, .overtime-approval-level-three, .overtime-approval-level-four').show();
		} else if(approval_level == 5){
			$('.overtime-approval-level-default').hide();
			$('.overtime-approval-level-one, .overtime-approval-level-two, .overtime-approval-level-three, .overtime-approval-level-four, .overtime-approval-level-five').show();
		}
	});
	$( ".incident_approval_levels" ).change(function() {
		var approval_level = $(this).val();
		if(approval_level == 0){
			$('.incident-approval-level-default').hide();
		} else if(approval_level == 1){
			$('.incident-approval-level-default').hide();
			$('.incident-approval-level-one').show();
		} else if(approval_level == 2){
			$('.incident-approval-level-default').hide();
			$('.incident-approval-level-one, .incident-approval-level-two').show();
		} else if(approval_level == 3){
			$('.incident-approval-level-default').hide();
			$('.incident-approval-level-one, .incident-approval-level-two, .incident-approval-level-three').show();
		} else if(approval_level == 4){
			$('.incident-approval-level-default').hide();
			$('.incident-approval-level-one, .incident-approval-level-two, .incident-approval-level-three, .incident-approval-level-four').show();
		} else if(approval_level == 5){
			$('.incident-approval-level-default').hide();
			$('.incident-approval-level-one, .incident-approval-level-two, .incident-approval-level-three, .incident-approval-level-four, .incident-approval-level-five').show();
		}
	});
	$( ".transfer_approval_levels" ).change(function() {
		var approval_level = $(this).val();
		if(approval_level == 0){
			$('.transfer-approval-level-default').hide();
		} else if(approval_level == 1){
			$('.transfer-approval-level-default').hide();
			$('.transfer-approval-level-one').show();
		} else if(approval_level == 2){
			$('.transfer-approval-level-default').hide();
			$('.transfer-approval-level-one, .transfer-approval-level-two').show();
		} else if(approval_level == 3){
			$('.transfer-approval-level-default').hide();
			$('.transfer-approval-level-one, .transfer-approval-level-two, .transfer-approval-level-three').show();
		} else if(approval_level == 4){
			$('.transfer-approval-level-default').hide();
			$('.transfer-approval-level-one, .transfer-approval-level-two, .transfer-approval-level-three, .transfer-approval-level-four').show();
		} else if(approval_level == 5){
			$('.transfer-approval-level-default').hide();
			$('.transfer-approval-level-one, .transfer-approval-level-two, .transfer-approval-level-three, .transfer-approval-level-four, .transfer-approval-level-five').show();
		}
	});
	$( ".resignation_approval_levels" ).change(function() {
		var approval_level = $(this).val();
		if(approval_level == 0){
			$('.resignation-approval-level-default').hide();
		} else if(approval_level == 1){
			$('.resignation-approval-level-default').hide();
			$('.resignation-approval-level-one').show();
		} else if(approval_level == 2){
			$('.resignation-approval-level-default').hide();
			$('.resignation-approval-level-one, .resignation-approval-level-two').show();
		} else if(approval_level == 3){
			$('.resignation-approval-level-default').hide();
			$('.resignation-approval-level-one, .resignation-approval-level-two, .resignation-approval-level-three').show();
		} else if(approval_level == 4){
			$('.resignation-approval-level-default').hide();
			$('.resignation-approval-level-one, .resignation-approval-level-two, .resignation-approval-level-three, .resignation-approval-level-four').show();
		} else if(approval_level == 5){
			$('.resignation-approval-level-default').hide();
			$('.resignation-approval-level-one, .resignation-approval-level-two, .resignation-approval-level-three, .resignation-approval-level-four, .resignation-approval-level-five').show();
		}
	});
	$( ".complaint_approval_levels" ).change(function() {
		var approval_level = $(this).val();
		if(approval_level == 0){
			$('.complaint-approval-level-default').hide();
		} else if(approval_level == 1){
			$('.complaint-approval-level-default').hide();
			$('.complaint-approval-level-one').show();
		} else if(approval_level == 2){
			$('.complaint-approval-level-default').hide();
			$('.complaint-approval-level-one, .complaint-approval-level-two').show();
		} else if(approval_level == 3){
			$('.complaint-approval-level-default').hide();
			$('.complaint-approval-level-one, .complaint-approval-level-two, .complaint-approval-level-three').show();
		} else if(approval_level == 4){
			$('.complaint-approval-level-default').hide();
			$('.complaint-approval-level-one, .complaint-approval-level-two, .complaint-approval-level-three, .complaint-approval-level-four').show();
		} else if(approval_level == 5){
			$('.complaint-approval-level-default').hide();
			$('.complaint-approval-level-one, .complaint-approval-level-two, .complaint-approval-level-three, .complaint-approval-level-four, .complaint-approval-level-five').show();
		}
	});
	$("#update_attendance_status").submit(function(e){
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
});