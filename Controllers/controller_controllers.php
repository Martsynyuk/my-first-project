<?php
class Controller_controllers
{
		
	public $url = '/contacts_controllers/index?page=1';
	public $url_page = '/contacts_controllers/index?page=';
	public $sortup = '/contacts_controllers/index?sort=up';
	public $sortdown = '/contacts_controllers/index?sort=down';
		
	function __construct ()
	{
		//'For a future';
	}
		
	function contacts_defender ( $id, $user_id )
	{
		if ( ( int ) $id > 0 )
		{
		
			$protection_contact = new Information_models();
		
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
}