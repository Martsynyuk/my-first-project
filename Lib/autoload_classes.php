<?php

function autoload ( $classname )
{
	
	$load_class = explode('_', $classname);
	
		if ( file_exists(APP . '/' . ucfirst ( $load_class[1] ) . '/' . $load_class[0] . '_' . $load_class[1] . '.php') )
		{
	
			include_once APP . '/' . ucfirst ( $load_class[1] ) . '/' . $load_class[0] . '_' . $load_class[1] . '.php';
		}	
	
}
	
spl_autoload_register('autoload');