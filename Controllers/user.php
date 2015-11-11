<?php


Class User extends Controller
{     
	
	public $model = 'Users';
	
	public function autorization ()
	{
			
		$post = $this->post_controller ();
		
		$loginUser = '';	

		if ( ! empty ( $post['login'] ) && ! empty ( $post['password'] ) )
		{

			$loginUser = $this->login ( $post['login'], $post['password'] );
		}
			
			
		$this->view->set ( 'loginUser', $loginUser );
		$this->view->set ( 'post', $post );
			
		$this-> view->render ( 'users', 'autorization' );
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
				
		$post = $this->post_controller ();

		if( ! empty ( $post['login'] ) && ! empty ( $post['password1'] ) && ! empty ( $post['password2'] ) )
		{	

			if ( $post['password1'] === $post['password2'] ) 
			{
					
					
				$user = $this->model->select (
						
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
						
					$user = $this->model->insert (
							
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
		
		$this->view->set ( 'post', $post );
			
		$this->view->render ( 'users', 'registration' );
	}
		
	function login ( $login, $password )
	{
			
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
			
		$login_user = $this->model->select ( $what );
			
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