function mrefreshUsers() {
	$.ajax({
		url: main_url+"chat/refresh_chat_users/0",
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
	setTimeout(mrefreshUsers, 3000);
});