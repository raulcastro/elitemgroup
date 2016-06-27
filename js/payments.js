$(function(){
	if ( $('#addPayment').length ) { 
		$('#addPayment').click(function(){
			addPayment();
			return false;
		});
	}
	
	if ( $('.showPayment').length ) { 
		$('.showPayment').click(function(){
			return false;
		});
	}
	
	if ( $('#updatPayment').length ) { 
		$('#updatPayment').click(function(){
			updatePayment();
			return false;
		});
	}
});

function updatePayment()
{
	var statusPayment = 0;
	
	if ($('#optionPaymentPaid').iCheck('update')[0].checked)
	{
		statusPayment = 2;
	}else if ($('#optionPaymentCancelled').iCheck('update')[0].checked)
	{
		statusPayment = 3;
	}
	
//	var chckValue = $('#optionPaymentPaid').iCheck('update')[0].checked;
	if (statusPayment > 0)
	{
		paymentId = $('#singlePaymentIdVal').val();
		$.ajax({
		    type: "POST",
		    url: "/ajax/payments.php",
		    data: {
		    	paymentId:	paymentId,
		    	statusPayment: statusPayment,
		    	opt:	5
		    },
		    success:
	        function(info)
	        {
		    	if (info !=0 )
		    	{
		    		$('#singlePayment').modal('hide');
		    		var statusP = $('#currentPaymentSelection').val();
		    		getPayments(statusP);
	        		calculatePayments();
		    	}
	        }
		});
	}
	else
	{
		$('#singlePayment').modal('hide');
	}
}

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
	    	memberId:			memberId,
	    	currentRoom: 		currentRoom,
	    	currentCategory: 	currentCategory,
	    	currentInventory: 	currentInventory,
	    	paymentAmount: 		paymentAmount,
	    	paymentDate: 		paymentDate,
	    	paymentDescription: paymentDescription,
	    	opt:				1
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
	        		calculatePayments();
	        	}
	        	else
				{
				}
	        }
	    });
}

function getPayments(statusP)
{
	var memberId 			= $('#memberId').val();
	var currentRoom 		= $('#currentRoom').val();

	$.ajax({
	    type: "POST",
	    url: "/ajax/payments.php",
	    data: {
	    	memberId:		memberId,
	    	currentRoom: 	currentRoom,
	    	statusP:		statusP,
	    	opt:			2
	    },
	    success:
        function(info)
        {
    		$('.paymentsBox-'+currentRoom).html(info);
			$('.show-payment').click(function(){
				getSinglePayment(this);
			});
        }
	});
}

function calculatePayments()
{
	var memberId 		= $('#memberId').val();
	var currentRoom 	= $('#currentRoom').val();
	
	$('.paymentTotal').html();
	$('.paymentPaid').html();
	$('.paymentPending').html();
	$('#totalViewAllPayments').html();
	
	$.ajax({
	    type: "POST",
	    url: "/ajax/payments.php",
	    data: {
	    	memberId:		memberId,
	    	currentRoom: 	currentRoom,
	    	opt:			4
	    },
	    success:
        function(data)
        {
    		info = JSON.parse(data);
    		$('.paymentTotal').html(info.total);
    		$('.paymentPaid').html(info.paid);
    		$('.paymentPending').html(info.pending);
    		$('#totalViewAllPayments').html(info.pending);
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
	    	$('#singlePaymentIdVal').val(info.paymentId);
	    	$('#singlePaymentInventory').html(info.inventory);
	    	$('#singlePaymentCategory').html(info.category);
	    	$('#singlePaymentDescription').html(info.description);
	    	$('#singlePaymentAmount').html(info.amount);
	    	$('#dateAdded').html(info.dateAdded);
	    	$('#singlePaymentDays').html(info.days)
	    	var pStatus = info.status;
	    	
	    	$('#updatPayment').show();
	    	
	    	if (pStatus == 2)
	    	{
	    		$('#paymentOptionsBox').hide();
	    		$('#paymentOptionsPaid').show();
	    		$('#updatPayment').hide();
	    	}
	    	else
	    	{
	    		$('#optionPaymentPending').iCheck('check');
	    		$('#paymentOptionsPaid').hide();
	    		$('#paymentOptionsBox').show();
	    	}
	    	
//	    	$('#').html();
        }
	});
	
}

function displayAllPayments()
{
	var memberId 			= $('#memberId').val();
	var currentRoom 		= $('#currentRoom').val();
	
	$('#allPaymentsContent').html();
	
	
	$.ajax({
	    type: "POST",
	    url: "/ajax/payments.php",
	    data: {
	    	memberId:		memberId,
	    	currentRoom: 	currentRoom,
	    	opt:			6
	    },
	    success:
        function(data)
        {
	    	$('#allPaymentsContent').html(data);
        }
	});
	
}