<?php

class Controller
{
	
	function __construct()
	{
		
		require_once APP . '/Models/model.php';
		require_once APP . '/Models/user.php';
		require_once APP . '/Models/information.php';
		
		foreach ($this->model as $madel => $class)
		{
			$this->$class = new $class();
		}
		
		$this->view = new View();
	}
	
	function post_controller ()
	{	
		if ( ! empty ( $_POST ) )
		{
			$post = array();
			
			foreach( $_POST as $key => $val )
			{
				
				$post[$key] = htmlspecialchars ( trim ( $val ) );
			}
			return $post;
		}		
		else{
			
			return false;
		}
		
	}
	
	function parse_argument ( $arguments )
	{
		

		return $argument;
	}
}