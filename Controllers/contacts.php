<?php

/**
 * 
 * 
 */
 
class Contacts extends Controller
{
	
	public $model = array(
			'Information',
			'Login'
	);
	
	public function  add ($argument)
	{
			
		$post = $this->post_controller();
		
		$user = $this->Login->user();
			
		if ( ! empty ( $post['FirstName'] ) ) 
		{
			
			if ( isset ( $post['radio'] ) ) 
			{
				
				if ( $post['radio'] === 'Home' )
				{
					$phone = $post['Home'];
				}
				
				if ( $post['radio'] === 'Work' )
				{
					$phone = $post['Work'];
				}
				
				if ( $post['radio'] === 'Cell' )
				{
					$phone = $post['Cell'];
				}
			} 
			else{
				
				$phone = $post['Cell'];
			}
				
			$new_contact = $this->Information->insert (
				
										$what = array(
													
													'users_id' => $user['id'], // mast be int its important
													'Firstname' => $post['FirstName'],
													'LastName' => $post['LastName'],
													'Email' => $post['Email'],
													'Home' => $post['Home'],
													'Work' => $post['Work'],
													'Cell' => $post['Cell'],
													'Adress1' => $post['Adress1'],
													'Adress2' => $post['Adress2'],
													'City' => $post['City'],
													'State' => $post['State'],
													'Zip' => $post['Zip'],
													'Country' => $post['Zip'],
													'BirthDate' => $post['year'] . '-' 
																	. $post['month'] . '-' 
																	. $post['day'],
													'Telephone' => $phone  
												
											)
						
						);
				
		}
		
		if( ! empty ( $phone ) )
		{
			$this->view->set ( 'phone', $phone );
		}
			
			$this->view->set ( 'user', $user );
			$this->view->set ( 'html', $this->view);
		
			$this->view->render ( $argument );			
	}
		
	public function edit ( $argument )
	{
		
		$post = $this->post_controller ();
		
		$user = $this->Login->user();
		
		if ( (int)($argument[2]) === 0 )
		{
			header ( 'Location: /' );
		}
		
		if( ! $this->Information->contacts_defender ( $argument[2], $user['id'] ))
		{
			header ( 'Location: /' );
		}
				
		$contactUser = $this->Information->select(
				
											$what = array(
													
												'fields' => array(
														
															'Firstname',
															'Lastname',
															'Email',
															'Home',
															'Work',
															'Cell',
															'Adress1',
															'Adress2',
															'City',
															'State',
															'Zip',
															'Country',
															'BirthDate'
													
												),
													
												'conditions' => array(
															
														  	'id' => $argument[2],
			
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
			
		if ( ! empty ( $post['FirstName'] ) ) 
		{
			
			if ( empty ( $post['radio'] ) ) 
			{
				$phone = $post['Cell'];
			}
				
			if ( isset ( $post['radio'] ) ) 
			{
				if ( $post['radio'] === 'Home' )
				{
					$phone = $post['Home'];
				}
				
				if ( $post['radio'] === 'Work' )
				{
					$phone = $post['Work'];
				}
				
				if ( $post['radio'] === 'Cell' )
				{
					$phone = $post['Cell'];
				}
			}
				
			$this->Information->update (
					
								$what = array(
										
									'fields' => array(
												
												'Firstname' => $post['FirstName'],
												'Lastname' => $post['LastName'],
												'Email' => $post['Email'],
												'Home' => $post['Home'],
												'Work' => $post['Work'],
												'Cell' => $post['Cell'],
												'Adress1' => $post['Adress1'],
												'Adress2' => $post['Adress2'],
												'City' => $post['City'],
												'State' => $post['State'],
												'Zip' => $post['Zip'],
												'Country' => $post['Country'],
												'BirthDate' => $post['year'] . '-' 
																. $post['month'] . '-' 
																. $post ['day'],
												'Telephone' => $phone,
											
									),
												
									'id' => $argument[2]
						
								)
						
						);
				
				header ( 'Location: /' );
		}
			
		$this->view->set ( 'contactUser', $contactUser );
		$this->view->set ( 'get', $argument[2] );
		$this->view->set ( 'html', $this->view);
		$this->view->set ( 'user', $user);

		if( ! empty ( $phone ) )
		{
			
			$this->view->set ( 'phone', $phone );
		}
			
		$this->view->render ( $argument );

	}
		
	public function index ( $argument )
	{	
		
		$user = $this->Login->user();
		
		$count_pages = ceil ( $this->count_contacts () / 5 );
		
		if(! empty($_COOKIE['mails']) || ! empty($_COOKIE['new_mail']) )
		{
			setcookie('new_mail', '' , strtotime("12 hours"), '/');
			//setcookie('mails', '' , strtotime("12 hours"), '/');		
		}
		
		foreach ( $argument as $val )
		{
			if( $val === 'FirstName' || $val === 'LastName' )
			{
				
				$argument['sortparam'] = $val;
			}
			if( $val === 'asc' || $val === 'desc' )
			{
				
				$argument['sort'] = $val;
			}
			if( (int)($val) > 0 && $val <= $count_pages)
			{
				
				$argument['page'] = $val;
			}
			
		}

		if ( empty ( $user['id'] ) )
		{
			
			header ( 'Location: /users/autorization' );
		}

		if ( empty ( $argument['page'] ) )
		{
			
			$page = 1;
		}
		else{
			
			$page = $argument['page'];
		}
			
		if ( empty( $argument['sort'] ) )
		{
				
			$argument['sort'] = 0;		
		}
		if( empty( $argument['sortparam'] ))
		{
			$argument['sortparam'] = 0;
		}
			
		$contacts = array ();
		
		$count_contacts = $this->count_contacts($user['id']);
		
		$contacts = $this->return_contact ( $user['id'], $page, $argument['sort'], $argument['sortparam'] );
			
		$count_for_pagin = $this->count_pages ( $page );
		
		$i = 1;
		($page > 1) ? $i = $page * ROWLIMIT - ROWLIMIT + 1 : '';  // to number of contacts
		
		$this->view->set ( 'count_contacts', $count_contacts );
		$this->view->set ( 'count_for_pagin', $count_for_pagin );
		$this->view->set ( 'page', $page );
		$this->view->set ( 'count_pages', $count_pages );
		$this->view->set ( 'contacts', $contacts );
		$this->view->set ( 'i', $i);
		$this->view->set ( 'user', $user);
		$this->view->set ( 'html', $this->view);
		
		$this->view->render ( $argument );
		
	}
		
	public function select ( $argument )
	{
		
		$post = $this->post_controller ();	
		
		$user = $this->Login->user();
		
		$count_pages = ceil ( $this->count_contacts ( $user['id'] ) / 5 );
		
		if(! empty($_COOKIE['mails']) || ! empty($_COOKIE['new_mail']) )
		{			
			$this->set_cookie('mails', '');
			$this->set_cookie('new_mail', '');
		}
		
		foreach ( $argument as $val )
		{
			if( $val === 'FirstName' || $val === 'LastName' )
			{
		
				$argument['sortparam'] = $val;
			}
			
			if( $val === 'asc' || $val === 'desc' )
			{
		
				$argument['sort'] = $val;
			}
			
			if( $val === 'all' )
			{
				$argument['all'] = $val;	
			}
			
			if( (int)($val) > 0 && $val <= $count_pages)
			{
		
				$argument['page'] = $val;
			}
				
		}
		
		if ( empty ( $argument['page'] ) )
		{
					
			$page = 1;
		}
		else{
					
			$page = $argument['page'];
		}
				
		if ( empty ( $argument['sort'] ))
		{				
			$argument['sort'] = 0;		
		}
		
		if (empty ( $argument['sortparam'] ))
		{
			$argument['sortparam'] = 0;
		}	
		
		$i = 1;
		
		($page > 1) ? $i = $page * ROWLIMIT - ROWLIMIT + 1 : '';  // to number of contacts
		
		$contacts = array ();
		
		$contacts = $this->return_contact ( $user['id'], $page, $argument['sort'], $argument['sortparam'] );
		
		if ( ! empty ($_COOKIE['select']) )
		{
			$checked = $this->get_cookie($_COOKIE['select']);
		}
		else{
			$checked = array();
		}
		
		if ( ! empty ( $post['page'] ) || ! empty ( $post['sort'] ) ) 
		{	
			$id = array();
			
			foreach ( $post as $key=>$val )
			{
		
				if( is_int ($key) )
				{
					
					$id[] = $key;
				}		
			}
			
			if( ! empty($_COOKIE['select']))
			{
				foreach ($contacts as $val)
				{
					$contact[] = $val['id'];
				}
				
				$this->set_cookie('select', array_diff($this->get_cookie($_COOKIE['select']), $contact));
				
				$id = array_diff($id, $this->get_cookie($_COOKIE['select']));				
				
			}		
			
			$id = implode(', ', $id);
			
			if( ! empty($id) && empty ($_COOKIE['select']) )
			{	
				$this->set_cookie('select', $id);					
			}
			elseif( ! empty ($id) && ! empty ($_COOKIE['select']) )
			{
				$this->set_cookie('select',  $id . ', ' . $_COOKIE['select']);
			}
		}
		
		$count_for_pagin = $this->count_pages ( $page );
		
		$this->view->set ( 'user', $user);
		$this->view->set ( 'html', $this->view);
		$this->view->set ( 'count_for_pagin', $count_for_pagin );
		$this->view->set ( 'page', $page );
		$this->view->set ( 'count_pages', $count_pages );
		$this->view->set ( 'contacts', $contacts );
		$this->view->set ( 'i', $i);
		$this->view->set ( 'argument', $argument );
		$this->view->set ( 'checked', $checked );
				
		$this->view->render ( $argument );
			
	}
		
	public function view ( $argument )
	{	
		
		if ( ( int ) ($argument[2]) > 0 )
		{
				
			$contactUser = $this->Information->select (	
					
											$what = array(
													
													'fields' => array(
															
												    		'Firstname',
																'Lastname',
																'Email',
																'Home',
																'Work',
																'Cell',
															 	'Adress1',
																'Adress2',
																'City',
																'State',
																'Zip',
																'Country',
																'Country',
																'BirthDate'
													
													 ),
													
													'conditions' => array(
																
																'id' => $argument[2],
			
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

			if ( empty ( $contactUser ) )
			{
				
				echo 'No contacts';
			}
				
		}
		else{
				
			header ( 'Location: /' );
		}
	
		$this->view->set ( 'contactUser', $contactUser );
			
		$this->view->render ( $argument );

	}
		
	function delete ( $argument )
	{
		
		$post = $this->post_controller ();
		$user = $this->Login->user();
		
		$select = NULL;
		
		if ( ! empty ( $argument[2] ) && (int)( $argument[2] ) > 0 )
		{
			
			$select = $this->Information->select ( 
										$what = array(
												'fields' => array(
															
														'Firstname'
												),
												'conditions' => array(
												
														'id' => $argument[2],
												),
												'limit' => array(
												
														'start' => '',
														'end'=> ''
												
												)
												
										)
					);
			
			if ( empty ($select) )
			{
				header('Location: /');
			}
			
			$user = $this->Login->user();
			
			if ( ! empty ( $post['del'] ) && $post['del'] === 'Yes')
			{
					
				 if ( ! $this->Information->contacts_defender ( $argument[2], $user['id'] ))
				 {
				 		
				  	header('Location: /');
				 }
					
					
					$this->Information->delete ( $argument[2] );
		
					header('Location: /');

			}
			elseif ( $post['del'] === 'No' )
			{
				
				header('Location: /');
			}
		}
		else{
			
			header('Location: /');
		}
		
		foreach ( $select as $select => $val)
		{
			$select = $val;
		}
		
		$this->view->set ( 'select', $select);
		$this->view->set ( 'id', $argument[2]);
		$this->view->set ( 'html', $this->view);
		$this->view->set ( 'user', $user);
		
		$this->view->render ( $argument );

	}
			
	function count_contacts ()
	{	
		
		$user = $this->Login->user();
		
		$res = $this->Information->select(
				
									$what = array(
											
											'fields' => array(
													
															'COUNT(*)'
																			
											),
											
											'conditions' => array(
													
															'users_id' => $user['id'],
																				
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
		
		foreach ( $res as $key => $val ) 
		{
			
			$res = $val;			
		}
		
		return $res ['COUNT(*)'];
	}
		
	function count_pages ( $page )
	{
		
		$count_pages = ceil ( $this->count_contacts () / 5 );		
		$count_show_pages = SHOWPAGES;
		$start = 1;
		$end = 1;
		
		if ( $count_pages > 1 )
		{
			
			$left = $page - 1;                // pagenation
			$right = $count_pages - $page;  
					
			if ( $left < floor ( $count_show_pages / 2 ) )
			{		
				$start = 1;
			}
			else {
				
				$start = $page - floor ( $count_show_pages / 2 );
			}
					
			$end = $start + $count_show_pages - 1;
					
			if ( $end > $count_pages )
			{
				
				$start -= ( $end - $count_pages );
				$end = $count_pages;
		
				if ($start < 1)
				{
					$start = 1;
				}
			}                              
		}
		
		return array (
				
				$start,
				$end
			);
	}
		
	function return_contact ( $user_id, $page, $sorting, $sortparam ) 
	{
		
		$sort = '';
		$deck = '';

		if ( $sorting === 'asc' && $sortparam === 'FirstName' || $sorting === 'asc' && $sortparam === 'LastName' )
		{	
			
			if ( $sortparam === 'FirstName' )
			{
				
				$sort = $sortparam . ', LastName';
			}
			else{
				
				$sort = $sortparam . ', FirstName';
			}
		}
		elseif ( $sorting === 'desc' && $sortparam === 'FirstName' || $sorting === 'desc' && $sortparam === 'LastName' )
		{
				
			if ( $sortparam === 'FirstName' )
			{
				
				$deck = 'DESC , LastName' ;
			}
			else{
				
				$deck = 'DESC , FirstName' ;
			}
					
			$sort = $sortparam;
		}

		$result = $this->Information->select (
				
									$what = array(
											
											'fields' => array(	
													
														'id',
														'FirstName',
														'LastName',
														'Email',
														'Telephone'
												
											),
											
											'conditions' => array(
													
														'users_id' => $user_id,
							
											),
											
											'order' => array(
													
														'by' => $sort,
														'direction' => $deck
													
											),
											
											'limit' => array(
													
														'start' => ($page - 1) * ROWLIMIT,
														'end'=> ROWLIMIT
													
											)	
											
									)
												
							);

		$contacts = $result;

		if ( empty ( $contacts ) )
		{
			$contacts = array ();
		}
		
		return $contacts;
	}
	
	function letter ( $argument )
	{
		
		$post = $this->post_controller ();
		
		$user = $this->Login->user();
		
		$new_mail = NULL;
		$mail = NULL;
		
		if ( ! empty($post['add']) && ! empty ($post['mails']) && ! empty ($_COOKIE['mails']))
		{
			$new_mail = array_diff(explode(', ', $post['mails']), explode(', ', $_COOKIE['mails']));
			$new_mail = implode(', ', $new_mail);
			
			$this->set_cookie('new_mail', $new_mail);
			
		}
		elseif ( ! empty($post['add']) && ! empty ($post['mails']))
		{
			$new_mail = $post['mails'];
			
			$this->set_cookie('new_mail', $new_mail);
		}
		
		if( ! empty($post['add']) && empty ($new_mail) )
		{
			header ( 'Location: /' );
		}
		
		if ( isset($_COOKIE['select']) && ! empty ($post['Select']) && $post['Select'] == 'Accept' )
		{	
			
			$mails = array_unique ( $this->get_cookie($_COOKIE['select']));
			
			foreach ($mails as $id)
			{
				$email[] = $this->Information->select(
								$what = array(
										'fields' => array(
																						
												'Email'
								
										),
											
										'conditions' => array(
										
												'id' => $id
													
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
				
			}
			
			if( isset($email))
			{
				foreach ($email as $val)
				{
					foreach ($val as $value)
					{
						if ( $value['Email'] !== '' )
						{
							$mail[] = $value['Email'];
						}
					}				
				}
				
				$post_mail = '';
				
				foreach ($post as $key=>$val)
				{
					if((int)($key)>1 && $val != '')
					{
						$post_mail[] = $val; 
					}
				}
				if( $post_mail !== '')
				{
					$post_mail = implode(', ', $post_mail);
				}
					
					$mail = implode(', ', $mail);
					
					$mail = $mail . ', ' . $post_mail;
	
			}
			
			$this->set_cookie('mails', $mail);		
			$this->set_cookie('mail', '');
			
		}
		elseif( ! empty ($post['Select']) && empty ( $_SESSION['mail'] ) )
		{	
			
			$mail = array();
			
			foreach ($post as $key=>$post)
			{	
				if((int)($key)>1 && $post != '')
				{
					$mail[] = $post; 
				}				
			}
			$mail = implode(', ', $mail);
			
			if ( isset($mail) )
			{
				
				$this->set_cookie('mails', $mail);				
			}
		}
		
		if( !empty ($_COOKIE['mails']) )
		{
			$mail = $_COOKIE['mails'];
		}
		
		if ( ! empty ($post['Yes']) && $post['Yes'] === 'Yes' )
		{	
			
			foreach ( $this->get_cookie($_COOKIE['new_mail']) as $mail)
			{
				
				$this->Information->insert (
								$what = array(
										'users_id' => $user['id'],
										'FirstName' => 'somenew',
										'Email' => $mail
								)					
						);
			}
			
			header ( 'Location: / ');
		} 
		elseif ( ! empty ($post['No']) && $post['No'] === 'No' )
		{
			
			header ( 'Location: / ');
		}
		
		$this->set_cookie('select', '');
		
		$this->view->set ( 'user', $user );
		$this->view->set ( 'html', $this->view );
		$this->view->set ( 'mail', $mail );
		$this->view->set ( 'new_mail', $new_mail );
		
		$this->view->render ( $argument );
	}

}
	