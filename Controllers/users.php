<?php


Class Users extends Controller
{     
	
	public $model = array(
			'User',
			'Login'
	);
	
	public function autorization ( $argument )
	{
			
		$post = $this->post_controller ();	
		
		if ( ! empty ( $post['login'] ) && ! empty ( $post['password'] ) )
		{
			$this->Login->login_user($post);
		}
					
		$this->view->set ( 'post', $post );
			
		$this->view->render ( $argument );
	}
		
	public function logout ()
	{
			
		unset ( $_SESSION['id'] );
		unset ( $_SESSION['login'] );
			
		header ( 'Location: autorization' );
	}
		
	public function registration ( $argument )
	{
				
		$post = $this->post_controller ();

		if( ! empty ( $post['login'] ) && ! empty ( $post['password1'] ) && ! empty ( $post['password2'] ) )
		{	

			if ( $post['password1'] === $post['password2'] ) 
			{
									
				$user = $this->User->select (
						
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
				
				if (empty ( $user ) )
				{
						
					$user = $this->User->insert (
							
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

		}
		
		$this->view->set ( 'post', $post );
			
		$this->view->render ( $argument );
	}
		
}