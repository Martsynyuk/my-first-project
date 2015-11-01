<?php
class Controller
{
		
	function __construct ()
	{
	
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
}