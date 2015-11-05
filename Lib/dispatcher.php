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
					$get['sort_all'] = $val;
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
	/*var_dump($classname);
	$search = array(
			
			'Controller',	// Controllers	
			'Contacts',
			'User',
			'View',			// Lib
			'Model',		// Models
			'Information',			
			//'Users'
	);
	
	$replace = array(	
			
			'controller-Controllers',	// Controllers 	
			'contacts-Controllers',
			'user-Controllers',
			'view-Lib',					// Lib
			'model-Models',				// Models
			'information-Models',			
			//'users-Models'		
	);
	
	$class = explode ( '-', str_ireplace ( $search, $replace, $classname ) );
	
	require_once APP . '/' . $class[1] . '/' .$class[0] . '.php';
	require_once APP . '/Models/users.php';*/
}

spl_autoload_register('autoload');
