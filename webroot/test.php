<?php
date_default_timezone_set ( 'Europe/Kiev' );
error_reporting ( E_ALL );

	$argument = array(
		
		//'controller' => 'contacts',
		//'action' => 'index',
		//'page' => '1',
		//'sort' => 'first',
		//'sortparam' => 'asc',
		//'id' => '2',
		//'all' => 'all'
	);
		
		$controller = NULL;
		$action = NULL;
		$page = NULL;
		$sort = NULL;
		$sortparam = NULL;
		$id = NULL;
		$all = NULL;
		
		extract($argument) ;
		
		if($sort !== NULL && $sortparam === NULL)
		{
			$sortparam = '/asc';
		}
		
		$url = '/' . $controller . '/' . $action . '/' . $sort . '/' . $sortparam . '/' . $page . '/' . $id . '/' . $all;
		
		$url =str_replace('//', '/', str_replace('//', '/', str_replace('//', '/', $url)));
	
		var_dump($url);
		