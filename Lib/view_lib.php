<?php


Class View_lib {
		
	private $var = array();
		
	public function set ( $name, $value )
	{
			
		$this->var[$name] = $value; 
	} 
		
	public function render ( $view )
	{
			
		ob_start();
			
		extract($this->var);

		$dir = explode('_', $view);

		if ( file_exists(APP . '/View/' . $dir[0] . '/' . $dir[1] . '.html') )
		{
			
			include_once APP . '/View/' . $dir[0] . '/' . $dir[1] . '.html';
		}
			
		echo ob_get_clean();
		
	}
		
}
