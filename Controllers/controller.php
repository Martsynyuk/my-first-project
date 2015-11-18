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
	
	function contacts_defender ( $id, $user_id )
	{
		if ( ( int ) $id > 0 )
		{
		
			$protection_contact = new Information();
		
			$user_contact = $protection_contact->select (
					
						$what = array(
								
								'fields' => array(
										
										'id',
										'users_id'
							
								),
								
								'conditions' => array(
										
										'id' => $id,
										'users_id' => $user_id
											
								),
								
								'order' => array(
										
										'by' => '',
										'direction' => ''
								),
								
								'limit' => array(
										
										'start' => '',
										'end'=> ''
								)
						)
							
				);
					
		if ( empty ( $user_contact ) )
		{
			
			header ( 'Location: /' );
		}
	}
	else{
		
			header ( 'Location: /' );
	}
				
	return $user_contact;
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