<?php


Class User extends Controller
{     
	
	public function autorization ()
	{
		
		if ( ! empty ( $_POST ) )
		{
			
			$post = $this->post_controller();
		}
		else{
			
			$post = NULL;
		}
		
		$loginUser = '';	

		if ( ! empty ( $post['login'] ) && ! empty ( $post['password'] ) )
		{

			$loginUser = $this->login ( $post['login'], $post['password'] );
		}
			
		$view = new View ();
			
		$view->set ( 'loginUser', $loginUser );
		$view->set ( 'post', $post );
			
		$view->render ( 'users', 'autorization' );
	}
		
	public function logout ()
	{
			
		unset ( $_SESSION['id'] );
		unset ( $_SESSION['login'] );
		unset ( $_COOKIE['mail'] );
			
		header ( 'Location: autorization' );
	}
		
	public function registration ()
	{
		
		if ( ! empty ( $_POST ) )
		{
				
			$post = $this->post_controller();
		}
		
		if( ! empty ( $post['login'] ) && ! empty ( $post['password1'] ) && ! empty ( $post['password2'] ) )
		{	

			if ( $post['password1'] === $post['password2'] ) 
			{
					
				$registration = new Users();
					
				$user = $registration->select (
						
										$what = array(
												
												'fields' => array(
														
														  	'id'	
														
												),
												
												'conditions' => array(
														
															'login' => $post['login']
														
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
					
				if ( $user === 'No connect' )
				{
						
					header('Location: user/regictration');
				}
					
				
				if (empty ( $user ) )
				{
						
					$user = $registration->insert (
							
											$what = array(
													
													'password' => md5( $post['password1'] . 'lyly' ) , // mast be int its importent
													'login' => $post['login']
											
											)
																		
									);
						
					header ( 'Location: autorization' );
				}
				else{
						
				}
			} 
			else {

				
			}
		}
			
		$view= new View();	
		
		$view->set ( 'post', $post );
			
		$view->render ( 'users', 'registration' );
	}
		
	function login ( $login, $password )
	{
			
		$login_user = new Users ();
			
		$what = array(
				
					'fields' => array(
						
			 					'id',
			 					'login'
			
					 ),
				
					'conditions' => array(
							
								'login' => $login,
								'password' => md5 ( $password . 'lyly' )
							
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
			
		$login_user = $login_user->select ( $what );
			
		if ( $login_user === 'No connect' )
		{
				
		}
		else{

			if ( !empty ( $login_user ) )
			{	
				foreach ($login_user as $login_user => $val )
				{
					
					$login_user = $val;
				}

				$_SESSION ['id'] = $login_user['id'];
				$_SESSION ['login'] = $login_user['login'];
					
				header ( 'Location: /' );
			}
		}
	}
}