<?php

class Dispatcher {	
	
	function __construct()
	{
		require_once APP . '/Controllers/controller.php';
		require_once APP . '/Controllers/contacts.php';
		require_once APP . '/Controllers/user.php';
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
		
		if( $path == '/' || count( explode('-', $arguments[0] ) ) > 1 )
		{
			for ( $i=0; $i<2 ; $i++ )
			{
				if ( ! empty ( $arguments[$i] ) )
				{
					
					$arguments[$i+2] = $arguments[$i];
				}
				
			}
			
			$arguments [1] = 'index';
			$arguments [0] = 'contacts';
		}
		
		$class = ucfirst ( $arguments[0] );

		$load = new $class;	
		
		$variables = $load->$arguments[1]( $arguments );
	
		return;
	}
	
}

function autoload ( $classname )
{	

}

spl_autoload_register('autoload');
