$(function(){
	if ( $('#addChatMessage').length ) { 
		$('#addChatMessage').click(function(){
			addMessage();
			return false;
		});
	}
	
	$("#chatMessage").keyup(function(event){
	    if(event.keyCode == 13){
	    	addMessage();
	    }
	});
	
	if ( $('#tabMessageSender').length ) { 
		$('#tabMessageSender').click(function(){
			scrollToBottom();
		});
	}
	
	if ($('#markAllAsRead').length){
		$('#markAllAsRead').click(function(){
			bootbox.confirm("Do you want to mark all the messages as read?", function(result) {
				if (result)
				{
					markAllAsRead();
				}
			});
		});
	};
	
	if ($('#sendEmailNotification').length){
		$('#sendEmailNotification').click(function(){
			bootbox.confirm("You are about to send an e-mail notifying about unread messages", function(result) {
				if (result)
				{
					sendEmailNotification();
				}
			});
		});
	};
});

function scrollToBottom()
{
	var elem = document.getElementById('boxChat');
	elem.scrollTop = elem.scrollHeight;
}

function addMessage()
{
	var memberId 	= $('#memberId').val();
	var chatMessage = $('#chatMessage').val();

	if (chatMessage)
	{
		$.ajax({
	    type: "POST",
	    url: "/ajax/messages.php",
	    data: {
	    	memberId: 	memberId,
	    	message: 	chatMessage,
	    	opt:			'1'
	    },
	    success:
	        function(info)
	        {
	        	if (info != '0')
	        	{
	        		data = JSON.parse(info);
	        		
	        		var item = '<div class="direct-chat-msg "> ' +
	        					'	<div class="direct-chat-info clearfix"> ' +
								'		<span class="direct-chat-name pull-left">'+data.user_name+'</span> ' +
								'		<span class="direct-chat-timestamp pull-right">'+data.date+'</span> ' +
								'	</div> ' +
								'	<img class="direct-chat-img" src="/dist/img/user2-160x160.jpg" alt="message user image"> ' +
								'	<div class="direct-chat-text"> ' +
										data.message +
								'	</div> ' +
								'</div>';
	        		
	        		$('#boxChat').append(item);
	        		$('#chatMessage').val('');
	        		scrollToBottom();
	        	}
	        	else
				{
				}
	        }
	    });
	}
}

function markAllAsRead()
{
	var memberId 	= $('#memberId').val();
	
	$.ajax({
	    type: "POST",
	    url: "/ajax/messages.php",
	    data: {
	    	memberId: 	memberId,
	    	opt:			'2'
	    },
	    success:
	        function(info)
	        {
	        	if (info != '0')
	        	{
	        		$('#messageNumberBadge').html(0);
	        		$('.direct-chat-text').css('font-weight', 'normal');
	        	}
	        }
	    });
}

function sendEmailNotification()
{
	var memberId = $('#memberId').val();
	
	if (memberId)
	{
		$.ajax({
	    type: "POST",
	    url: "/email/send-email-notification.php",
	    data: {
	    	memberId:		memberId,
	    },
	    success:
	        function(info)
	        {
	        	if (info != '0')
	        	{
	        		bootbox.confirm("The email has been sent", function(result) {}); 
	        	}
	        }
	    });
	}
}