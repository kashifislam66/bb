$(document).ready(function() {	
	$("#message_content").val("");
	$("#message_content").focus();
	jQuery(".chat-body").animate({ scrollTop: $(".chat-body").prop("scrollHeight")}, 0);
	/* Add data */ /*Form Submit*/
	$("#send_chat").submit(function(e){
		var fd = new FormData(this);
		var text = $("#message_content").val();
		var fid = $("#mfid").val();
		var tid = $("#to_id").val();
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
					$('input[name="csrf_token"]').val(JSON.csrf_hash);
					Ladda.stopAll();
					var siteUrl = main_url+"chat/refresh_chatbox/"+fid+"/"+tid;
					$.get(siteUrl, function(data, status){
					jQuery(".chat-body").html(data);
					
					$("#message_content").val("");
					$("#message_content").focus();
					//$("#chatAudioSent")[0].play();
					jQuery(".chat-body").animate({ scrollTop: $(".chat-body").prop("scrollHeight")}, 0);
					});
					
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
var first_run = 0;
function mrefreshMessages() {
	var fid = $("#mfid").val();
	var tid = $("#to_id").val();
	if(fid!='' && tid!='') {
		$.ajax({
			url: main_url+"chat/refresh_chatbox/"+fid+"/"+tid,
			type: 'GET',
			dataType: 'html',
			success: function(data) {
			  prev_chat = $(".chat-body").html();
			  jQuery('.chat-body').html(data);
			  curr_chat = $(".chat-body").html();
			  setTimeout(mrefreshMessages, 3000);
			  if(curr_chat != prev_chat) {
				prev_chat = curr_chat;
				if(first_run===0) {
					first_run = 1;
				} else {
					if(prev_chat!='<div class="chat-body">' ) {
						//$('#chatAudio')[0].play();
						$("#message_content").val("");
						$("#message_content").focus();
						jQuery(".chat-body").animate({ scrollTop: $(".chat-body").prop("scrollHeight")}, 0);
					}
				}
			}
						
			},
			error: function() {
			 
			}
		  });
	}
}
function mrefreshUsers() {
	var tid = $("#to_id").val();
	$.ajax({
		url: main_url+"chat/refresh_chat_users/"+tid,
		type: 'GET',
		dataType: 'html',
		success: function(data) {
		  prev_chat = $(".chat-users").html();
		  jQuery('.chat-users').html(data);
		  curr_chat = $(".chat-users").html();
		  setTimeout(mrefreshUsers, 3000);					
		},
		error: function() {
		 
		}
	  });
}
$(document).ready(function(){
	setTimeout(mrefreshMessages, 3000);
	setTimeout(mrefreshUsers, 3000);
});
$( document ).on( "click", ".delete", function() {
	$('input[name=_token]').val($(this).data('record-id'));
	$('#delete_record').attr('action',main_url+'assets/delete_asset');
});