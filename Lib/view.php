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
		$sort = NULL;
		$sortparam = NULL;
		$id = NULL;
		$all = NULL;
		
		extract($argument) ;
		
		if($sort !== NULL && $sortparam === NULL)
		{
			$sortparam = '/asc';
		}
		
		$url = '/' . $controller . '/' . $action . '/' . $sort . '/' . $sortparam . '/' . $page . '/' . $id . '/' . $all;
		
		$url = str_replace('//', '/', str_replace('//', '/', $url));
		
		return $url;
	}
		
}
