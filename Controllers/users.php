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
		
		$user = $this->Login->user();
		
		if (!empty($user))
		{
			header ( 'Location: /' );
		}
		
		if ( ! empty ( $post['login'] ) && ! empty ( $post['password'] ) )
		{		
			$this->Login->login_user($post);
		}
					
		$this->view->set ( 'post', $post );
		$this->view->set ( 'html', $this->view);
			
		$this->view->render ( $argument );
	}
		
	public function logout ()
	{
			
		unset ( $_SESSION['id'] );
		unset ( $_SESSION['login'] );
		unset ( $_SESSION['mail'] );
		
		if(! empty($_COOKIE['mails']) || ! empty($_COOKIE['new_mail']) || ! empty($_COOKIE['count']) )
		{
			setcookie('mails', '' , strtotime("12 hours"), '/');
			setcookie('new_mail', '' , strtotime("12 hours"), '/');
			setcookie('count', '' , strtotime("12 hours"), '/');
		}
			
		header ( 'Location: /users/autorization' );
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
				//$user = $this->contacts($user);
				if (empty ( $user ) )
				{
						
					$user = $this->User->insert (
							
											$what = array(
													
													'password' => md5( $post['password1'] . 'lyly' ) , // mast be int its importent
													'login' => $post['login']
											
											)
																		
									);
						
					header ( 'Location: /users/autorization' );
				}
				else{
						
				}
			} 

		}
		
		$this->view->set ( 'post', $post );
		$this->view->set ( 'html', $this->view);
			
		$this->view->render ( $argument );
	}
	
	function ajax_login()
	{
		$post = $this->post_controller();
		if(!empty($post['text']))
		{		
			$post['text'] = preg_replace('/[a-zA-Z0-9]/', '', $post['text']);
			
			if(!empty ($post['text']) )
			{
				echo '<span class="no_user">No ! </span>';
			}
			else{
				echo '<span class="user_exist">Ok !</span>';
			}
		}
	}
}