<?php


Class View
{
		
	private $val = array();
	private $layout = array();
		
	public function set ( $name, $value )
	{
			
		$this->val[$name] = $value; 
	} 
		
	public function render ( $argument )
	{
			
		ob_start();
			
		extract($this->val);
		
		if ( file_exists(APP . '/View/' . $argument[0] . '/' . $argument[1] . '.html') )
		{
			
			include_once APP . '/View/' . $argument[0] . '/' . $argument[1] . '.html';
		}
			
		echo ob_get_clean();
		
	}
	public function setLayout ($name, $value)
	{
		
		$this->layout[$name] = $value;
	}
	public function  renderLayout($name)
	{
		ob_start();
			
		extract($this->layout);
		
		if ( file_exists(APP . '/View/layouts/' . $name . '.html') )
		{
				
			include_once APP . '/View/layouts/' . $name . '.html';
		}
			
		echo ob_get_clean();
	}
		/**
		* 	$argument = array(
		*		
		*			'controller' => 'contacts',
		*			'action' => 'index',
		*			'page' => '1',
		*			'sort' => 'first',
		*			'sorparam' => 'asc',
		*			'id' => '2',
		*			'all' => 'all'
		*		);
		* 
	 	* 
	 	* @param array $argument
	 	* @return string*/
	
	public function url($argument)
	{	
		
		$controller = NULL;
		$action = NULL;
		$page = NULL;
		$sortFirst = NULL;
		$sortSecond = NULL;
		$id = NULL;
		$all = NULL;
		
		extract($argument) ;
		
		$url = '/' . $controller . '/' . $action . '/' . $sortFirst . '/' . $sortSecond . '/' . $page . '/' . $id . '/' . $all;
		
		$url = str_replace('//', '/', str_replace('//', '/', str_replace('//', '/', $url)));
		
		return $url;
	}
		
}
