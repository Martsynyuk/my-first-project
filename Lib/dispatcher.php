<?php

class Dispatcher {	
	
	function __construct()
	{
		require_once APP . '/Controllers/controller.php';
		require_once APP . '/Controllers/contacts.php';
		require_once APP . '/Controllers/users.php';
		require_once APP . '/Controllers/autocompleter.php';
		require_once APP . '/Controllers/test.php';		
		require_once APP . '/Lib/View.php';
		require_once APP . '/Lib/login_user.php';
		
	}
	
	public function dispatch ( $path ) 
	{
		
		if (empty ( $path ) )
		{
			
			header ( 'Location: /error_pages/404.html', 404 );
		}
		
		$arguments = explode ( '/', ltrim ( $path, '/' ) );

		if ( empty ( $arguments ) )
		{
				
			header ( 'Location: /error_pages/404.html', 404 );
		}
		
		if( class_exists($arguments[0]) !== true )
		{ 
			$count = count($arguments);
			
			if ( $count > 0 )
			{	
				for ( $i=0; $i < $count ; $i++ )
				{
						
						$arguments[$i+5] = $arguments[$i];			
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
