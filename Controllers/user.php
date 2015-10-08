<?php
	Class User extends Controller
	{
		
		public function autorization()
		{
			
			$loginUser = '';	

			if(! empty ( $_POST ['login'] ) && ! empty ( $_POST ['password'] ))
			{

				$loginUser = $this->login ( $_POST ['login'], $_POST ['password'] );
			}
			
			$view = new View();
			
			$view->set('loginUser', $loginUser);
			
			$view->render('user_autorization');
		}
		
		public function logout()
		{
			
			unset ( $_SESSION ['id'] );
			unset ( $_SESSION ['login'] );
			
			header ( 'Location: /user/autorization' );
		}
		
		public function registration()
		{

			if(!empty($_POST['login']) && !empty($_POST['password1']) && !empty($_POST['password2']))
			{	

				if ($_POST['password1'] === $_POST['password2']) 
				{
					
					$registration = new Users();
					
					$user = $registration->select(
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
					
					if($user === 'No connect')
					{
						echo $user;
						
						header('Location: /user/regictration');
					}
					
				
					if (empty ( $user ))
					{
						
						$user = $registration->insert(
														$what = array(
																		'password' => md5( $_POST['password1'] . 'lyly' ) , // mast be int its importent
																		'login' => $_POST['login']
											
																)
																		
														);
						
						header ( 'Location: autorization' );
					}
					else{
						
						echo 'User already exists ';
					}
				} 
				else {
					echo 'Bad login';
				}
			}
			
			$view= new View();		
			
			$view->render('user_registration');
		}
		
		function login($login, $password)
		{
			
			$login_user = new Users();
			
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
			
			$login_user = $login_user->select($what);
			
			if($login_user === 'No connect')
			{
				
				echo ' -' . $login_user;
			}
			else{

					if (!empty ( $login_user ))
					{
							
						$_SESSION ['id'] = $login_user ['0']['id'];
						$_SESSION ['login'] = $login_user ['0']['login'];
		
						header ( 'Location: /' );
					}
			}
		}
	}