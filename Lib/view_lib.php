<?php


Class View_lib {
		
	private $var = array();
		
	public function set ( $name, $value )
	{
			
		$this->var[$name] = $value; 
	} 
		
	public function render ( $dir, $file_name )
	{
			
		ob_start();
			
		extract($this->var);

		if ( file_exists(APP . '/View/' . $dir . '/' . $file_name . '.html') )
		{
			
			include_once APP . '/View/' . $dir . '/' . $file_name . '.html';
		}
			
		echo ob_get_clean();
		
	}
		
}
