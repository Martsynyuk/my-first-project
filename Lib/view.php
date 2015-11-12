<?php


Class View
{
		
	private $var = array();
		
	public function set ( $name, $value )
	{
			
		$this->var[$name] = $value; 
	} 
		
	public function render ( $argument )
	{
			
		ob_start();
			
		extract($this->var);

		if ( file_exists(APP . '/View/' . $argument[0] . '/' . $argument[1] . '.html') )
		{
			
			include_once APP . '/View/' . $argument[0] . '/' . $argument[1] . '.html';
		}
			
		echo ob_get_clean();
		
	}
		
}
