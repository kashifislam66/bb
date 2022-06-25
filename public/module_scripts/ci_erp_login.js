$(document).ready(function(){	
	$("#erp-form").submit(function(e){
		/*Form Submit*/
		e.preventDefault();
		var obj = $(this), action = obj.attr('name'), redirect_url = obj.data('redirect'), form_table = obj.data('form-table'),  is_redirect = obj.data('is-redirect');
	$.ajax({
		type: "POST",
		url: e.target.action,
		data: obj.serialize()+"&is_ajax=1&form="+form_table,
		cache: false,
		success: function (JSON) {
			if (JSON.error != '') {
				toastr.error(JSON.error);
				$('input[name="csrf_token"]').val(JSON.csrf_hash);
				Ladda.stopAll();
			} else {
				toastr.clear();
				$('input[name="csrf_token"]').val(JSON.csrf_hash);
				Ladda.stopAll();
				$('input[name="csrf_token"]').val(JSON.csrf_hash);
				var timerInterval;
				$('.has-help').hide();
				$('.success-msg').show();
				$('#msg_one').html(JSON.result);
				setInterval(function(){
					window.location = desk_url;
				}, 2000);				
			}
		}
	});
	});
});