<?php


Class User_controllers extends Controller_controllers
{     
		
	public function autorization ()
	{
			
		$loginUser = '';	

		if ( ! empty ( $_POST ['login'] ) && ! empty ( $_POST ['password'] ) )
		{

			$loginUser = $this->login ( $_POST ['login'], $_POST ['password'] );
		}
			
		$view = new View_lib ();
			
		$view->set ( 'loginUser', $loginUser );
			
		$view->render ( 'users_autorization' );
	}
		
	public function logout ()
	{
			
		unset ( $_SESSION ['id'] );
		unset ( $_SESSION ['login'] );
			
		header ( 'Location: /user_controllers/autorization' );
	}
		
	public function registration ()
	{

		if( ! empty ( $_POST['login'] ) && ! empty ( $_POST['password1'] ) && ! empty ( $_POST['password2'] ) )
		{	

			if ( $_POST['password1'] === $_POST['password2'] ) 
			{
					
				$registration = new Users_models();
					
				$user = $registration->select (
						
										$what = array(
												
												'fields' => array(
														
														  	'id'	
														
												),
												
												'conditions' => array(
														
															'login' => $_POST['login']
														
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
						
					header('Location: /user_controllers/regictration');
				}
					
				
				if (empty ( $user ) )
				{
						
					$user = $registration->insert (
							
											$what = array(
													
													'password' => md5( $_POST['password1'] . 'lyly' ) , // mast be int its importent
													'login' => $_POST['login']
											
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
			
		$view= new View_lib();		
			
		$view->render ( 'users_registration' );
	}
		
	function login ( $login, $password )
	{
			
		$login_user = new Users_models ();
			
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
							
				$_SESSION ['id'] = $login_user ['0']['id'];
				$_SESSION ['login'] = $login_user ['0']['login'];
		
				header ( 'Location: /' );
			}
		}
	}
}