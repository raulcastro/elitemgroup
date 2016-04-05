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
	    	opt:			'2'
	    },
	    success:
	        function(info)
	        {
	        	if (info != '0')
	        	{
	        		alert('Info updated!');
	        	}
	        	else
				{
				}
	        }
	    });
	}
}


