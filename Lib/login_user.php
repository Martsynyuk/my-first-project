<?php

session_start ();

class Login{
	
	function login_user ( $post )
	{
		$what = array(
					
				'fields' => array(
							
						'id',
						'login'
		
				),
					
				'conditions' => array(
		
						'login' => $post['login'],
						'password' => md5 ( $post['password'] . 'lyly' )
		
				),
					
				'order' => array(
		
						'by' => '',
						'direction' => ''
		
				),
					
				'limit' => array(
		
						'start' => '',
						'end'=> ''
		
				)
					
		);
		
		$login = new User();
		$contact = new Controller();
		
		$user = $login->select ( $what );
		
		unset($user[1]);		
		$user = $contact->contacts($user);

		if ( !empty ( $user ) )
		{
			foreach ($user as $user => $val )
			{
		
				$user = $val;
			}
			
			$_SESSION['id'] = $user['id'];
			$_SESSION['login'] = $user['login'];
		
			header ( 'Location: /' );
		}
	}
	
	function user()
	{
		
		if ( ! empty ( $_SESSION['id'] ) && ! empty ( $_SESSION['login'] ))
		{
			
			$user['id'] = $_SESSION['id'];
			$user['name'] = $_SESSION['login'] ;
			
			return $user;
		}
	}
}