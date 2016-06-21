<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require_once($root.'/models/back/Layout_Model.php');
require_once($root.'/views/Layout_View.php');
require_once $root.'/backends/admin-backend.php';
require_once $root.'/Framework/Tools.php';
$model	= new Layout_Model();


$memberId = (int) $_POST['memberId'];

switch ($_POST['opt'])
{
	case 1:	 
		if ($model->addPayment($_POST))
			echo 1;
		else
			echo 0;
		break;
		
	break;
	
	case 2:
		if ($payments = $model->getPaymentsByRoom($_POST))
		{
			foreach ($payments as $payment)
			{
				$class = '';
				$percent = 0;
				$days = $payment['days'];
				
				if ($days >= 12)
				{
					$class="bg-green";
					if ($days > 12)
						$percent = 100;
					else
						$percent = ($days * 100) / 12;
				}
				
				if ($days <= 9 && $days >= 7)
				{
					$class="bg-aqua";
					$percent = ($days * 100) / 12;
				}
				
				if ($days <= 6 && $days >= 4)
				{
					$class="bg-yellow";
					$percent = ($days * 100) / 12;
				}
				
				if ($days <= 3)
				{
					$class="bg-red";
					if ($days <= 0)
						$percent = 0;
					else
						$percent = ($days * 100) / 12;
				}
				
				$status = '';
				
				if ($payment['status'] == 2)
				 	$status = '/ PAID';
				?>
				<div class="col-md-3 col-sm-6 col-xs-12 payment-item">
					<div class="info-box <?php echo $class; ?>">
						<span class="info-box-icon">
							<a href="#" data-target="#singlePayment" data-toggle="modal" >
								<i class="fa fa-dollar show-payment" data-id="<?php echo $payment['payment_id']; ?>"></i>
							</a>
						</span>
						<div class="info-box-content">
							<span class="info-box-text"><?php echo $payment['inventory']; ?></span>
							<span class="info-box-text"><?php echo Tools::formatMYSQLToFront($payment['due_date']);  ?></span>
							<span class="info-box-number">$<?php echo $payment['amount'].' '.$status; ?></span>
							<div class="progress">
								<div class="progress-bar" style="width: <?php echo $percent; ?>%"></div>
							</div>
							<span class="progress-description">
								<?php echo number_format($percent, 1, '.', ''); ?>% / <?php echo $payment['days']; ?> days
							</span>
						</div><!-- /.info-box-content -->
					</div><!-- /.info-box -->
				</div>
				<?php
			}
		}
		else 
		{
			echo "Empty";
		}
		
	break;
	
	case 3:
		if ($payment = $model->getPaymentsByPaymentId($_POST))
		{
			$data  = array(
					'paymentId'		=> str_pad($payment['payment_id'], 4, 0, STR_PAD_LEFT),
					'dueDate' 		=> Tools::formatMYSQLToFront($payment['due_date']),
					'category'		=> $payment['category'],
					'inventory'		=> $payment['inventory'],
					'description'	=> $payment['description'],
					'amount'		=> '$'.$payment['amount'],
					'dateAdded'		=> Tools::formatMYSQLToFront($payment['time']),
					'days'			=> $payment['days'],
					'status'		=> $payment['status']
			 );
			
			echo htmlspecialchars(json_encode($data), ENT_NOQUOTES);
		}
	break;
	
	case 4: //Calculate payments
		if ($totals = $model->calculatePayments($_POST))
		{
			$data = array(
				'total' => $totals['total'],
				'paid'	=> $totals['paid'],
				'pending' => $totals['pending']
			);
			
			echo htmlspecialchars(json_encode($data), ENT_NOQUOTES);
		}
	break;
	
	case 5:
		if ($model->setPaymentAsPaid($_POST['paymentId']))
		{
			echo 1;
		}
		else
		{
			echo 0;
		}
	break;
	
	case 6:
		if ($payments = $model->getPaymentsByRoom($_POST))
		{
			foreach ($payments as $payment)
			{
				if ($payment['status'] == 2)
				{
					$paymentTotal = '00.00';
					$status = 'Paid';
				}
				else 
				{
					$paymentTotal = $payment['amount'];
					$status = 'Pending';
				}
				?>
				<tr>
					<td id=""><?php echo $payment['payment_id']; ?></td>
					<td id=""><?php echo $payment['room']; ?></td>
					<td id=""><?php echo $payment['category']; ?></td>
					<td id=""><?php echo $payment['description']; ?></td>
					<td id=""><?php echo Tools::formatMYSQLToFront($payment['due_date']); ?></td>
					<td id=""><strong><?php echo $status; ?></strong></td>
					<td id="">$ <?php echo $paymentTotal; ?></td>
				</tr>
				<?php
			}
		}
	break;
	
	default:
	break;
}