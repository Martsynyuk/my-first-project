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
	
	function parse_argument ( $arguments )
	{
		
		$get = NULL;
		
		foreach ( $arguments as $key => $val )
		{
				
			if( ( int )( $val ) )
			{
		
				$get['id'] = $val;
			}
			if ( $val == 'all' )
			{
		
				$get['all'] = $val;
			}
				
			$arg = explode ( '-', $val );
				
			if ( $arg[0] === 'sort' )
			{
		
				if ( $arg[1] === 'up' || $arg[1] === 'down' )
				{
						
					$get['sort_all'] = $val;
					$get['sort'] = $arg[1];
				}
		
				if ( $arg[2] === 'FirstName' || $arg[2] === 'LastName' )
				{
						
					$get['sortparam'] = $arg[2];
				}
			}
				
			if ( $arg[0] === 'page' )
			{
		
				$get['page'] = $arg[1];
			}
		}
		
		return $get;
	}
}