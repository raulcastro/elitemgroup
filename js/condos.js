$(function(){
	
	if ( $('#addCondo').length ) { 
		$('#addCondo').click(function(){
			addCondo();
			return false;
		});
	}
});

function addCondo()
{
	var condoName = $('#condoName').val();
	var condoDescription = $('#condoDescription').val();

	if (condoName)
	{
		$.ajax({
	    type: "POST",
	    url: "/ajax/condos.php",
	    data: {
	    	condoName: 	condoName,
	    	condoDescription: 	condoDescription, 
	    	opt:			'1'
	    },
	    success:
	        function(info)
	        {
	        	if (info != '0')
	        	{
	        		var item = '<li><a href="#">'+condoName+'</a></li>'
	        		$('#condoBox').prepend(item);
	        		$('#condoName').val('');
	        		$('#condoDescription').val('');
	        	}
	        	else
				{
				}
	        }
	    });
	}
}