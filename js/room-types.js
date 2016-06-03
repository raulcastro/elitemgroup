$(function(){
	
	if ( $('#addRoomType').length ) { 
		$('#addRoomType').click(function(){
			addRoomType();
			return false;
		});
	}
});

function addRoomType()
{
	var roomTypeName = $('#roomTypeName').val();
	var roomTypeDescription = $('#roomTypeDescription').val();

	if (roomTypeName)
	{
		$.ajax({
	    type: "POST",
	    url: "/ajax/room-types.php",
	    data: {
	    	roomTypeName: 	roomTypeName,
	    	roomTypeDescription: 	roomTypeDescription, 
	    	opt:			'1'
	    },
	    success:
	        function(info)
	        {
	        	if (info != '0')
	        	{
	        		var item = '<li><a href="#">'+roomTypeName+'</a></li>'
	        		$('#roomTypesBox').prepend(item);
	        		$('#roomTypeName').val('');
	        		$('#roomTypeDescription').val('');
	        	}
	        	else
				{
				}
	        }
	    });
	}
}