<?php
//	error_reporting(E_ALL);
//	ini_set("display_errors", 1);
// var_dump($_GET);

	$root = $_SERVER['DOCUMENT_ROOT']."/";
	
	require_once $root.'backends/admin-backend.php';
	require_once $root.'/'.'views/Layout_View.php';
	
	$data 	= $backend->loadBackend('room');
	
	$data['title'] 			= $data['room']['room'].' / '.$data['room']['room_type'];
	$data['section'] 		= 'room';
	$data['icon'] 			= 'fa-home';
	$data['template-class'] = '';
	
	$view 	= new Layout_View($data);
	
	echo $view->printHTMLPage();
	
	