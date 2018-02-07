$(function(){
	
	if ( $('#memberSave').length ) { 
		$('#memberSave').click(function(){
			saveMember();
			return false;
		});
	}
	
	if ( $('#updateMember').length ) { 
		$('#updateMember').click(function(){
			updateMember();
			return false;
		});
	}
	
	if ( $('#showEditUser').length ) { 
		$('#showEditUser').click(function(){
			$('.edit-user-info').show('slow');
			return false;
		});
	}
	
	if ( $('#cancelEditUser').length ) { 
		$('#cancelEditUser').click(function(){
			$('.edit-user-info').hide('slow');
			return false;
		});
	}
	
	if ( $('.room-id').length ) { 
		$('.room-id').click(function(){
			loadRoomData(this);
		});
	}
	
	if ( $('#sendEmailOwner').length ) { 
		$('#sendEmailOwner').click(function(){
			sendGeneralEmail();
			return false;
		});
	}
	
	if ( $('#showAddInventory').length ) { 
		$('#showAddInventory').click(function(){
			$('#newInventoryInput').show();
			$('#newInventoryButton').show();
			$('#newInventoryInput').focus();
			return false;
		});
	}
	
	if ( $('#newInventoryButton').length ) { 
		$('#newInventoryButton').click(function(){
			addInventoryFront();
			return false;
		});
	}
	
	var memberId = 0;
	
	if ( $('#memberId').length ) { 
		var memberId = $('#memberId').val();
	}
	
	if ( $('#getPendingTab').length ) { 
		$('#getPendingTab').click(function(){
			getPayments("pending");
			$('#currentPaymentSelection').val("pending");
		});
	}
	
	if ( $('#getPastDueTab').length ) { 
		$('#getPastDueTab').click(function(){
			getPayments("past");
			$('#currentPaymentSelection').val("past");
		});
	}
	
	if ( $('#getPaidTab').length ) { 
		$('#getPaidTab').click(function(){
			getPayments("paid");
			$('#currentPaymentSelection').val("paid");
		});
	}
	
	if ( $('#getCancelledTab').length ) { 
		$('#getCancelledTab').click(function(){
			getPayments("cancel");
			$('#currentPaymentSelection').val("cancel");
		});
	}
	
	if ( $('#getDisplayAllPayments').length ) { 
		$('#getDisplayAllPayments').click(function(){
			displayAllPayments();
		});
	}
	
	if ( $('#deleteOwner').length ) { 
		$('#deleteOwner').click(function(){
			bootbox.confirm("Do you really want to delete this owner?", function(result) {
				if (result)
				{
					deleteOwner();
				}
			}); 
		});
	}
	
	if ( $('#sendOwnerInfo').length ) { 
		$('#sendOwnerInfo').click(function(){
			sendOwnerInfo();
		});
	}
	
	if ( $('#uploadAvatar').length ) { 
		$("#uploadAvatar").uploadFile({
			url:		"/ajax/media.php",
			fileName:	"myfile",
			multiple: 	true,
			doneStr:	"uploaded!",
			formData: {
					memberId: memberId,
					opt: 1 
				},
			onSuccess:function(files, data, xhr)
			{
				obj 			= JSON.parse(data);
				avatar		 	= obj.fileName;
				lastIdGallery 	= obj.lastId;
				$('#iconImg').attr('src', '/images/owners-profile/avatar/'+avatar);
				$('#userAvatarImg').attr('src', '/images/owners-profile/avatar/'+avatar);
			}
		});
	}
	
	$('#progressSaveMember').hide();
	$('#memberComplete').hide();
	
});

function saveMember()
{
	
	var memberFirst 	= $('#memberFirst').val(); 
	var memberLast		= $('#memberLast').val();
	var memberAddress	= $('#memberAddress').val();
	var notes		 	= $('#notes').val();
	var phoneOne		= $('#phoneOne').val();
	var phoneTwo		= $('#phoneTwo').val();
	var emailOne		= $('#emailOne').val();
	var emailTwo		= $('#emailTwo').val();
	var memberCondo		= $('#memberCondo').val();
	
	if (memberFirst)
	{
		$('#progressSaveMember').show();
		
		$.ajax({
	    type: "POST",
	    url: "/ajax/members.php",
	    data: {
	    	memberFirst: 	memberFirst,
	    	memberLast: 	memberLast, 
	    	memberAddress: 	memberAddress,
	    	phoneOne:		phoneOne,
	    	phoneTwo:		phoneTwo,
	    	emailOne:		emailOne,
	    	emailTwo:		emailTwo,
	    	notes:			notes,
	    	memberCondo:	memberCondo,
	    	opt:			'1'
	    },
	    success:
	        function(info)
	        {
	        	if (info != '0')
	        	{
	        		$('#progressSaveMember').hide();
	        		$('#memberSave').hide();
	        		$('#memberComplete').attr('href', '/owner/'+info+'/new-member/')
	        		$('#memberComplete').show();
	        	}
	        	else
				{
				}
	        }
	    });
	}
}

function updateMember()
{
	var memberId		= $('#memberId').val();
	var memberFirst 	= $('#memberFirst').val(); 
	var memberLast		= $('#memberLast').val();
	var memberAddress	= $('#memberAddress').val();
	var notes		 	= $('#notes').val();
	var phoneOne		= $('#phoneOne').val();
	var phoneTwo		= $('#phoneTwo').val();
	var emailOne		= $('#emailOne').val();
	var emailTwo		= $('#emailTwo').val();
	var memberCondo		= $('#memberCondo').val();
	
	if (memberFirst)
	{
		$.ajax({
	    type: "POST",
	    url: "/ajax/members.php",
	    data: {
	    	memberId:		memberId,
	    	memberFirst: 	memberFirst,
	    	memberLast: 	memberLast, 
	    	memberAddress: 	memberAddress,
	    	phoneOne:		phoneOne,
	    	phoneTwo:		phoneTwo,
	    	emailOne:		emailOne,
	    	emailTwo:		emailTwo,
	    	notes:			notes,
	    	memberCondo:	memberCondo,
	    	opt:			'2'
	    },
	    success:
	        function(info)
	        {
		    	if (info != '0')
	        	{
	        		pathArray 		= $(location).attr('href').split( '/' );
	            	newURL 			= pathArray[0]+'//'+pathArray[2]+'/'+pathArray[3]+'/'+pathArray[4]+'/'+pathArray[5]+'-'+Math.floor((Math.random() * 100) + 1)+'/#';
	            	window.location = newURL;
	        	}
	        	else
				{
				}
	        }
	    });
	}
}

function loadRoomData(node)
{
//	$('#categoryRoomList').select2();
//	$('#inventoryRoomList').select2();
	
	var currentRoom = $(node).attr('data-id');
	$('#currentRoom').val(currentRoom);
	getCategories();
	getPayments("pending");
	calculatePayments();
	displayAllPayments();
}

function getCategories()
{
	roomId = $('#currentRoom').val();
	
	$.ajax({
    type: "POST",
    url: "/ajax/members.php",
    data: {
    	roomId:	roomId,
    	opt:	8
    },
    success:
        function(info)
        {
        	if (info != '0')
        	{
        		$('#categoryRoomList option').remove();
//        		$('#categoryRoomList').select2('destroy');
        		$('#categoryRoomList').html(info);
        		$('#categoryRoomList').select2();
        		
        		$('#categoryRoomList').on("change", function(){
        			var categoryId = $('#categoryRoomList').val();
        			$('#currentCategory').val(categoryId);
        			$('#showAddInventory').show();
        			updateInventoryOptionsRooms(categoryId);
        		});
        	}
        	else
			{
			}
        }
    });
}

function updateInventoryOptionsRooms(categoryId)
{
	roomId = $('#currentRoom').val();
	
	$.ajax({
    type: "POST",
    url: "/ajax/members.php",
    data: {
    	roomId:	roomId,
    	categoryId: categoryId,
    	opt:	9
    },
    success:
        function(info)
        {
        	if (info != '0')
        	{
        		$('#inventoryRoomList option').remove();
//        		$('#categoryRoomList').select2('destroy');
        		$('#inventoryRoomList').html(info);
        		$('#inventoryRoomList').select2();
        		
        		$('#inventoryRoomList').on("change", function(){
        			var inventoryId = $('#inventoryRoomList').val();
        			$('#currentInventory').val(inventoryId);
        		});
        	}
        	else
			{
			}
        }
    });
}

function deleteOwner()
{
	var memberId = $('#memberId').val();
	
	if (memberId)
	{
		$.ajax({
	    type: "POST",
	    url: "/ajax/members.php",
	    data: {
	    	memberId:		memberId,
	    	opt:			10
	    },
	    success:
	        function(info)
	        {
	        	if (info != '0')
	        	{
	        		pathArray 		= $(location).attr('href').split( '/' );
	        		newURL 			= pathArray[0]+'//'+pathArray[2]+'/dashboard/';
	            	window.location = newURL;
	        	}
	        	else
				{
				}
	        }
	    });
	}
}

function sendGeneralEmail()
{
	var sendEmailTo		 = $('#sendEmailTo').val();
	var sendEmailSubject = $('#sendEmailSubject').val();
	var sendEmailContent = $('#sendEmailContent').val();

	if (sendEmailTo)
	{
		$.ajax({
	    type: "POST",
	    url: "/email/send-email.php",
	    data: {
	    	sendEmailTo: 		sendEmailTo,
	    	sendEmailSubject: 	sendEmailSubject,
	    	sendEmailContent: 	sendEmailContent,
	    	option:				1
	    },
	    success:
	        function(info)
	        {
	        	if (info == 'success')
	        	{
	        		alert("Your message has been sent");
	        		$('#sendEmailSubject').val('');
	        		$('#sendEmailContent').val('');
	        	}
	        }
	    });
	}
}

function sendOwnerInfo()
{
	var memberId = $('#memberId').val();
	var email = $('#emailOne').val();
	
	// Check if the owner has an account
	if (memberId)
	{
		$.ajax({
		    type: "POST",
		    url: "/ajax/members.php",
		    data: {
		    	memberId: 	memberId,
		    	opt:		12
		    },
		    success:
		        function(info)
		        {
		        	if (info == '1')
		        	{
		        		$.ajax({
		        		    type: "POST",
		        		    url: "/ajax/members.php",
		        		    data: {
		        		    	memberId:		memberId,
		        		    	opt:			11
		        		    },
		        		    success:
		        		        function(info)
		        		        {
		        		        	if (info == '1')
		        		        	{
		        		        		bootbox.confirm("This action will change the password of the owner", function(result) {
		        		        			if (result)
		        		        			{
		        		        				updateOwnerAccount();
		        		        			}
		        		        		}); 
		        		        	}
		        		        	else
		        					{
		        		        		bootbox.confirm("An email will be send to "+email+ " the owner with the username and password", function(result) {
		        		        			if (result)
		        		        			{
		        		        				createOwnerAccount();
		        		        			}
		        		        		});
		        					}
		        		        }
		        		    });
		        	}
		        	else
		        	{
		        		bootbox.confirm("This owner doesn't has an email", function(result) {}); 
		        		return false;
		        		
		        	}
		        }
		    });
	}
}
	

function createOwnerAccount()
{
	var memberId = $('#memberId').val();
	
	if (memberId)
	{
		$.ajax({
	    type: "POST",
	    url: "/email/send-owner-account.php",
	    data: {
	    	memberId:		memberId,
	    },
	    success:
	        function(info)
	        {
	        	if (info != '0')
	        	{
	        		bootbox.confirm("An e-mail with the access credentials has been sent to the owner", function(result) {}); 
	        	}
	        	else
				{
				}
	        }
	    });
	}
}

function updateOwnerAccount()
{
	var memberId = $('#memberId').val();
	
	if (memberId)
	{
		$.ajax({
	    type: "POST",
	    url: "/email/update-owner-account.php",
	    data: {
	    	memberId:		memberId,
	    },
	    success:
	        function(info)
	        {
	        	if (info != '0')
	        	{
	        		bootbox.confirm("The new password has been sent", function(result) {}); 
	        	}
	        	else
				{
				}
	        }
	    });
	}
}

function addInventoryFront(){
	var categoryId				= $('#currentCategory').val();
	var inventoryName 			= $('#newInventoryInput').val();
	var inventoryDescription 	= "";
	
	if (inventoryName)
	{
		$.ajax({
	    type: "POST",
	    url: "/ajax/settings.php",
	    data: {
	    	categoryId:				categoryId,
	    	inventoryName: 			inventoryName,
	    	inventoryDescription: 	inventoryDescription, 
	    	opt:					'3'
	    },
	    success:
	        function(info)
	        {
	        	if (info != '0')
	        	{
	        		updateInventoryOptionsRooms(categoryId);
	        		$('#showAddInventory').hide();
	        		$('#newInventoryInput').val('');
	        		$('#newInventoryInput').hide();
	        		$('#newInventoryButton').hide();
	        		bootbox.confirm(inventoryName+" has been added, choose it from the dropdown", function(result) {}); 
	        	}
	        }
	    });
	}
}