<?php


class Dispatcher {	
	
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
	
		elseif( ! empty ( $arguments[0] ) && $arguments[0]  !== '' or $path == '/' )
		{
			
			$arguments [1] = 'index';
			$arguments [0] = 'contacts';
		}
		
		if ( empty ( $arguments ) )
		{
			
			header ( 'Location: /error_pages/404.html', 404 );
		}
		
		$class = ucfirst ( $arguments[0] );

		$load = new $class;	
		
		$variables = $load->$arguments[1]();

		return;
	}
	
}

function autoload ( $classname )
{

	$load_class = explode('_', $classname);
	
	
	if ( file_exists ( APP . '/Controllers/' . $load_class[0] . '.php' ) )
	{
		
		include_once APP . '/Controllers/' . $load_class[0] . '.php';
	}
	
	if ( ! empty ( $load_class[1] ) )
	{
		if ( file_exists(APP . '/' . ucfirst ( $load_class[1] ) . '/' . $load_class[0] . '_' . $load_class[1] . '.php') )
		{
	
			include_once APP . '/' . ucfirst ( $load_class[1] ) . '/' . $load_class[0] . '_' . $load_class[1] . '.php';
		}
		else{
			
			//header('location: /');
		}
	}

}

spl_autoload_register('autoload');
