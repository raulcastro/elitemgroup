$(function(){
	
	if ( $('#addRoomType').length ) { 
		$('#addRoomType').click(function(){
			addRoomType();
			return false;
		});
	}
	
	/*
	if ( $('#updateCategory').length ) { 
		$('#updateCategory').click(function(){
			updateCategory();
			return false;
		});
	}
	
	if ( $('#addInventory').length ) { 
		$('#addInventory').click(function(){
			addInventory();
			return false;
		});
	}*/
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

function updateCategory()
{
	var categoryId			= $('#categoryId').val();
	var categoryName 		= $('#categoryName').val();
	var categoryDescription = $('#categoryDescription').val();
	
	if (categoryName)
	{
		$.ajax({
	    type: "POST",
	    url: "/ajax/settings.php",
	    data: {
	    	categoryId: categoryId,
	    	categoryName: 	categoryName,
	    	categoryDescription: 	categoryDescription, 
	    	opt:			'2'
	    },
	    success:
	        function(info)
	        {
	        	if (info != '0')
	        	{
//	        		var item = '<li><a href="/edit-inventory-category/'+info+'/">'+categoryName+'</a></li>'
//	        		$('#categoryBox').prepend(item);
//	        		$('#categoryName').val('');
//	        		$('#categoryDescription').val('');
	        		alert('Category updated!');
	        	}
	        	else
				{
				}
	        }
	    });
	}
}

function addInventory()
{
	var categoryId				= $('#categoryId').val();
	var inventoryName 			= $('#inventoryName').val();
	var inventoryDescription 	= $('#inventoryDescription').val();
	
	if (inventoryName)
	{
		$.ajax({
	    type: "POST",
	    url: "/ajax/settings.php",
	    data: {
	    	categoryId:		categoryId,
	    	inventoryName: 	inventoryName,
	    	inventoryDescription: 	inventoryDescription, 
	    	opt:			'3'
	    },
	    success:
	        function(info)
	        {
	        	if (info != '0')
	        	{
	        		var item = '<li><a href="/edit-inventory-category/'+info+'/">'+inventoryName+'</a></li>'
	        		$('#inventoryBox').prepend(item);
	        		$('#inventoryName').val('');
	        		$('#inventoryDescription').val('');
	        	}
	        	else
				{
				}
	        }
	    });
	}
}