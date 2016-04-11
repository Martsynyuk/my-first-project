<?php

class Controller
{
	
	function __construct()
	{
		require_once APP . '/Models/model.php';
		require_once APP . '/Models/user.php';
		require_once APP . '/Models/information.php';
		require_once APP . '/Models/chat.php';
			
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
			
			if(!empty($post['day']) && !empty($post['month']) && !empty($post['year']))
			{
	
				if(!checkdate((int)($post['month']), (int)($post['day']), (int)($post['year'])))
				{
					$date = date('Y-m-j', mt_rand(strtotime(1900-01-01), strtotime(2000-01-01)));
					$date = date_parse($date);
					
					$post['year'] = $date['year'];
					$post['month'] = $date['month'];
					$post['day'] = $date['day'];
				}
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
		$result = NULL;
		
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