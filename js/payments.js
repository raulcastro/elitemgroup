$(function(){
	if ( $('#addPayment').length ) { 
		$('#addPayment').click(function(){
			addPayment();
			return false;
		});
	}
	
	if ( $('.showPayment').length ) { 
		$('.showPayment').click(function(){
			alert("=)");
			return false;
		});
	}
});

function addPayment()
{
	var memberId 			= $('#memberId').val();
	var currentRoom 		= $('#currentRoom').val();
	var currentCategory 	= $('#currentCategory').val();
	var currentInventory 	= $('#currentInventory').val();
	var paymentAmount		= $('#paymentAmount').val();
	var paymentDate			= $('#paymentDate').val();
	var paymentDescription  = $('#paymentDescription').val();
//	alert("memberId = "+memberId+", currentRoom = "+currentRoom+", currentCategory = "+currentCategory+", currentInventory = "+currentInventory);
	
	$.ajax({
	    type: "POST",
	    url: "/ajax/payments.php",
	    data: {
	    	memberId:	memberId,
	    	currentRoom: currentRoom,
	    	currentCategory: currentCategory,
	    	currentInventory: currentInventory,
	    	paymentAmount: paymentAmount,
	    	paymentDate: paymentDate,
	    	paymentDescription: paymentDescription,
	    	opt:	1
	    },
	    success:
	        function(info)
	        {
	        	if (info != '0')
	        	{
	        		$('#payment-modal').modal('hide');
	        		$('#paymentAmount').val('');
	        		$('#paymentDate').val('');
	        		$('#paymentDescription').val('');
	        		getPayments();
	        	}
	        	else
				{
				}
	        }
	    });
}

function getPayments()
{
	var memberId 			= $('#memberId').val();
	var currentRoom 		= $('#currentRoom').val();
	
	$.ajax({
	    type: "POST",
	    url: "/ajax/payments.php",
	    data: {
	    	memberId:	memberId,
	    	currentRoom: currentRoom,
	    	opt:	2
	    },
	    success:
        function(info)
        {
    		$('#paymentsBox-'+currentRoom).html(info);
    			$('.show-payment').click(function(){
    				getSinglePayment(this);
    			});
        }
	});
}

function getSinglePayment(node)
{
	var paymentId = $(node).attr('data-id');
	
	$.ajax({
	    type: "POST",
	    url: "/ajax/payments.php",
	    data: {
	    	paymentId:	paymentId,
	    	opt:	3
	    },
	    success:
        function(data)
        {
	    	info = JSON.parse(data);
	    	$('#paymentNo').html(info.paymentId);
	    	$('#singlePaymentDueDate').html(info.dueDate);
	    	$('#singlePaymentId').html(info.paymentId);
	    	$('#singlePaymentInventory').html(info.inventory);
	    	$('#singlePaymentCategory').html(info.category);
	    	$('#singlePaymentDescription').html(info.description);
	    	$('#singlePaymentAmount').html(info.amount);
	    	$('#dateAdded').html(info.dateAdded);
	    	$('#singlePaymentDays').html(info.days)
//	    	$('#').html();
        }
	});
}