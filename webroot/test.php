<?php
date_default_timezone_set ( 'Europe/Kiev' );
error_reporting ( E_ALL );

	$argument = array(
		
		'controller' => 'contacts',
		'action' => 'index',
		'page' => '1',
		'sort' => 'first',
		'sorparam' => 'asc',
		'id' => '2',
		'all' => 'all'
	);
		
		$controller = NULL;
		$action = NULL;
		$page = NULL;
		$sort = NULL;
		$sortparam = NULL;
		$id = NULL;
		$all = NULL;
		
		foreach ($argument as $key=>$val)
		{
			switch ($key)
			{
				case 'controller' :
					$controller = '/' . $val;
					break;
				case 'action' :
					$action = '/' . $val;
					break;
				case 'page':
					$page = '/' . $val;
					break;
				case 'sort':
					$sort = '/' . $val;
					break;
				case 'sortparam' :
					$sortparam = '/' . $val;
					break;
				case 'id' :
					$id = '/' . $val;
					break;
				case 'all' :
					$all = '/' . $val;
					break;
			}
				
		}
		
		if($sort !== NULL && $sortparam === NULL)
		{
			$sortparam = '/asc';
		}
		
		$url = $controller . $action . $sort . $sortparam . $page . $id . $all;
		
		var_dump($url);