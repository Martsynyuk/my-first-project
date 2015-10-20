<?php

function autoload ( $classname )
{
	
	$load_class = explode('_', $classname);

	//echo '<pre>'; var_dump($load_class); echo '</pre>'; 
	
		if ( file_exists(APP . '/' . ucfirst ( $load_class[1] ) . '/' . $load_class[0] . '_' . $load_class[1] . '.php') )
		{
	
			include_once APP . '/' . ucfirst ( $load_class[1] ) . '/' . $load_class[0] . '_' . $load_class[1] . '.php';
		}	
	
	/*switch ($classname)
	{
		case file_exists(APP . '/Lib/' . $classname . '.php'): 
				
			include_once APP . '/Lib/' . $classname . '.php';
			break;
				
		case file_exists(APP . '/Controllers/' . $classname . '.php'):
				
			include_once APP . '/Controllers/' . $classname . '.php';
			break;
				
		case file_exists(APP . '/Models/' . $classname . '.php'):
				
			include_once APP . '/Models/' . $classname . '.php';
			break;
			
	}*/
		
}
	
spl_autoload_register('autoload');