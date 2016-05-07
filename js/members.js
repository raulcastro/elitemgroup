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
	
	var memberId = 0;
	
	if ( $('#memberId').length ) { 
		var memberId = $('#memberId').val();
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


