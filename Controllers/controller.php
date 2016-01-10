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
	
	function set_cookie ($name,  $value)
	{
		if(is_array($value))
		{
			$value = implode(', ', $value);
		}
		
		$cookie = setcookie($name, $value , strtotime("12 hours"), '/');	
	}
	
	function get_cookie($value)
	{
		$array = explode(', ' , $value);
		
		return $array;
	}
	
	function contacts($contact)
	{
		unset($contact[1]);
		foreach ($contact as $contacts)
		{
			foreach ($contacts as $val)
			{
				$result[] = $val;
			}
		}
		return $result;
	}
}