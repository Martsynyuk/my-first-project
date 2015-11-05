<?php
class Controller
{
	
	function __construct()
	{
		
		require_once APP . '/Models/model.php';
		require_once APP . '/Models/users.php';
		require_once APP . '/Models/information.php';
		require_once APP . '/Lib/View.php';
		
		$this->model = new $this->model();
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
			
		if ( $user_contact === 'No connect' )
		{
		
				header('Location: /');
		}
					
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
}