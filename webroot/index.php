<?php
	
	session_start ();

	if ( ! defined ( 'WEBROOT' ))
	{
		
		define ( 'WEBROOT', dirname ( __FILE__ ) );
	}

	if ( ! defined ( 'APP' ))
	{
		
		define ( 'APP', dirname ( dirname ( __FILE__ ) ) );
	}
	
	require_once APP . '/Lib/error_report.php';
	require_once APP . '/Lib/dispatcher.php';
	require_once APP . '/Lib/constant.php';	
	require_once APP . '/Models/interface.php';
	
	$dispatcher = new Dispatcher ();
	
	$dispatcher->dispatch ( $_SERVER ['REQUEST_URI'] );
	