<?php


class Dispatcher {	
	
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
		
		if ( ! empty  ( $arguments[1] ) )            
		{
			
			$get = explode ( '?', $arguments[1] );
			$arguments[1] = $get[0];
		}
			
		$get = NULL;
		
		foreach ( $arguments as $key => $val )
		{
			
			if( ( int )( $val ) )
			{
				
				$get['id'] = $val;
			}
			
			$arg = explode ( '-', $val );
			
			if ( $arg[0] === 'sort' )
			{
				
				if ( $arg[1] === 'up' || $arg[1] === 'down' )
				{
					
					$get['sort'] = $arg[1];
				}
				if ( $arg[2] === 'FirstName' || $arg[2] === 'LastName' )
				{
					
					$get['sortparam'] = $arg[2];
				}
			}
			if ( $arg[0] === 'page' )
			{
				
				$get['page'] = $arg[1];
			}
		}
		
		if(  empty ( $arguments[0] ) || $path == '/' || count( explode('-', $arguments[0] ) ) > 1 )
		{
				
			$arguments [1] = 'index';
			$arguments [0] = 'contacts';
		}
		
		$class = ucfirst ( $arguments[0] );

		$load = new $class;	
		
		$variables = $load->$arguments[1]( $get );

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
