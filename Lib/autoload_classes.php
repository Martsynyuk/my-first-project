<?php

function autoload ( $classname )
{
		
	switch ($classname)
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
			
	}
		
}
	
spl_autoload_register('autoload');