<?php

class Dispatcher {	
	
	function __construct()
	{
		require_once APP . '/Controllers/controller.php';
		require_once APP . '/Controllers/contacts.php';
		require_once APP . '/Controllers/users.php';
		require_once APP . '/Lib/View.php';
		require_once APP . '/Lib/login_user.php';
	}
	
	public function dispatch ( $path ) 
	{
		
		if (empty ( $path ) )
		{
			
			header ( 'Location: /error_pages/404.html', 404 );
		}
		
		$argument = explode ( '/', ltrim ( $path, '/' ) );

		if ( empty ( $argument ) )
		{
				
			header ( 'Location: /error_pages/404.html', 404 );
		}
		
		if( $path == '/' || class_exists($argument[0]) !== true )
		{ 
			$count = count($argument);
			
			if ( $count > 0 )
			{	
				for ( $i=0; $i < $count ; $i++ )
				{
						
						$arguments[$i+2] = $argument[$i];			
				}
			}
			
			$arguments [1] = 'index';
			$arguments [0] = 'contacts';
		}
		
		$class = ucfirst ( $arguments[0] );

		$object = new $class;	
		
		$object->$arguments[1]( $arguments );
	
	}
	
}
