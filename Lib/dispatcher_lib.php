<?php


class Dispatcher_lib {	
	
	public function dispatch ( $path ) 
	{
		
		if ( ! empty ( $_POST ) )
		{
			
			
		}
		
		if (empty ( $path ) )
		{
			
			header ( 'Location: /error_pages/404.html', 404 );
		}
		
		$arguments = explode ( '/', ltrim ( $path, '/' ) );
		 
		if ( ! empty  ($arguments[1] ) )
		{
			
			$get = explode ( '?', $arguments[1] );
			$arguments[1] = $get[0];
		}
		
		if ( empty ( $arguments ) )
		{
			
			header ( 'Location: /error_pages/404.html', 404 );
		}
		
		if ($path == '/')
		{
			$arguments [0] = 'contacts_controllers';
			$arguments [1] = 'index';
		}
		
		$class = ucfirst ( $arguments[0] );
		
		$load = new $class;	
		
		$load->$arguments[1]();
		
		return;
	}
}