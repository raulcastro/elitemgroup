$(function(){
	
	if ( $('#memberSave').length ) { 
		$('#memberSave').click(function(){
			saveMember();
			return false;
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
					alert('Errr..');
				}
	        }
	    });
	}
}

function saveMemberEmails()
{
	emailId 	= 0;
	emailVal 	= '';
	memberId 	= $('#member-id').val();
	
	$('.memberEmail').each(function()
	{
		emailId 	= 0;
		if ($(this).attr('eid') && $(this).val())
		{
			emailId		= $(this).attr('eid');
			emailVal	= $(this).val();
			
			$.ajax({
		        type:   'POST',
		        url:    '/ajax/members.php',
		        data:{  memberId: 	memberId,
		        	emailId: 		emailId,
		        	emailVal: 		emailVal,
		            opt: 			2
		             },
		        success:
		        function(xml)
		        {
		            if (0 != xml)
		            {
		            	
		            }
		        }
		    });
		}
	});
}

function saveMemberPhones()
{
	phoneVal 	= '';
	memberId 	= $('#member-id').val();
	
	
	$('.memberPhone').each(function()
	{
		phoneId		= $(this).attr('pid');
		phoneVal	= $(this).val();
	
		if ($(this).val())
		{
			$.ajax({
				type:   'POST',
				url:    '/ajax/members.php',
		        data:{  memberId: 	memberId,
		        	phoneId: 		phoneId,
		        	phoneVal: 		phoneVal,
		            opt: 			3
		             },
		        success:
		        function(xml)
		        {
		            if (0 != xml)
		            {
		            	
		            }
		        }
		    });
		}
	});
}
