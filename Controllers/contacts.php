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
		
			$this->view->render ( $argument );
	}
		
	public function edit ( $argument )
	{
		
		$post = $this->post_controller ();
		
		$get = $this->parse_argument( $argument );
		
		$user = $this->Login->user();
		
		$this->contacts_defender ( $get['id'], $user['id'] );
				
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
															
														  	'id' => $get['id'],
			
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
												
									'id' => $get['id']
						
								)
						
						);
				
				header ( 'Location: /' );
		}
			
		$this->view->set ( 'contactUser', $contactUser );
		$this->view->set ( 'get', $get );

		if( ! empty ( $phone ) )
		{
			
			$this->view->set ( 'phone', $phone );
		}
			
		$this->view->render ( $argument );

	}
		
	public function index ( $argument )
	{	
		
		$get = $this->parse_argument( $argument );
		
		$user = $this->Login->user();
		
		if ( empty ( $user['id'] ) )
		{
			
			header ( 'Location: users/autorization' );
		}

		if ( empty ( $get['page'] ) )
		{
			
			$page = 1;
		}
		else{
			
			$page = $get['page'];
		}
			
		if ( empty ( $get['sort'] ) && empty ( $get['sortparam'] ) )
		{
				
			$get['sort'] = 0;
			$get['sortparam'] = 0;
			$get['sort_all'] = 0;
		}
		
		$count_contacts = $this->count_contacts($user['id']);
			
		$contacts = array ();
		
		$contacts = $this->return_contact ( $user['id'], $page, $get['sort'], $get['sortparam'] );
			
		$count_for_pagin = $this->count_pages ( $user['id'], $page );
		$count_pages = ceil ( $this->count_contacts () / 5 );
		
		$i = 1;
		($page > 1) ? $i = $page * ROWLIMIT - ROWLIMIT + 1 : '';  // to number of contacts
		
		$this->view->set ( 'count_contacts', $count_contacts );
		$this->view->set ( 'count_for_pagin', $count_for_pagin );
		$this->view->set ( 'page', $page );
		$this->view->set ( 'count_pages', $count_pages );
		$this->view->set ( 'contacts', $contacts );
		$this->view->set ( 'i', $i);
		$this->view->set ( 'sort_all', $get['sort_all']);
		
		$this->view->render ( $argument );
		
	}
		
	public function select ( $argument )
	{

		$post = $this->post_controller ();	
		
		$get = $this->parse_argument ( $argument );
		
		if ( empty ( $get['all'] ) )
		{
					
			$get['all'] = NULL;
		}
			
		if ( empty ( $get['page'] ) )
		{
					
			$page = 1;
		}
		else{
					
			$page = $get['page'];
		}
				
		if ( empty ( $get['sort'] ) && empty ( $get['sortparam'] ) )
		{
					
			$get['sort'] = 0;
			$get['sortparam'] = 0;
		}
			
		$i = 1;
			
		($page > 1) ? $i = $page * ROWLIMIT - ROWLIMIT + 1 : '';  // to number of contacts
		
		$user = $this->Login->user();
				
		$contacts = array ();
		$contacts = $this->return_contact ( $user['id'], $page, $get['sort'], $get['sortparam'] );
				
		$count_for_pagin = $this->count_pages ( $user['id'], $page );
		$count_pages = ceil ( $this->count_contacts ( $user['id'] ) / 5 );
			
		$this->view->set ( 'count_for_pagin', $count_for_pagin );
		$this->view->set ( 'page', $page );
		$this->view->set ( 'count_pages', $count_pages );
		$this->view->set ( 'contacts', $contacts );
		$this->view->set ( 'i', $i);
		$this->view->set ( 'get[\'sort\']', $get['sort']);
		$this->view->set ( 'all', $get['all'] );
				
		$this->view->render ( $argument );
			
	}
		
	public function view ( $argument )
	{	
		
		$get = $this->parse_argument ( $argument );

		if ( ( int ) ($get['id']) > 0 )
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
																
																'id' => $get['id'],
			
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
		else{
				
			header ( 'Location: /' );
		}
	
		$this->view->set ( 'contactUser', $contactUser );
			
		$this->view->render ( $argument );

	}
		
	function delete ( $argument )
	{
		
		$get = $this->parse_argument( $argument );
		
		$post = $this->post_controller ();
		
		$select = NULL;
		
		if ( ! empty ( $get['id'] ) && (int)( $get['id'] ) >0 )
		{
			
			$select = $this->Information->select ( 
										$what = array(
												'fields' => array(
															
														'Firstname'
												),
												'conditions' => array(
												
														'id' => $get['id'],
												),
												'limit' => array(
												
														'start' => '',
														'end'=> ''
												
												)
												
										)
					);
			
			$user = $this->Login->user();
			
			if ( ! empty ( $post['del'] ) && $post['del'] === 'Yes')
			{
			
				$protection = $this->contacts_defender ( $get['id'], $user['id'] );
			
				if ( ! empty ( $protection ) )
				{	
							
					$this->Information->delete ( $get['id'] );
		
					header('Location: /');
			
				}
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
		$this->view->set ( 'id', $get['id']);
		
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

		if ( $sorting === 'up' && $sortparam === 'FirstName' || $sorting === 'up' && $sortparam === 'LastName' )
		{	
			
			if ( $sortparam === 'FirstName' )
			{
				
				$sort = $sortparam . ', LastName';
			}
			else{
				
				$sort = $sortparam . ', FirstName';
			}
		}
		elseif ( $sorting === 'down' && $sortparam === 'FirstName' || $sorting === 'down' && $sortparam === 'LastName' )
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
		
		$mail = NULL;
		$new_mail = NULL;
		
		if ( count ( $post ) > 1 && ! empty ( $post['Select'] ) )
		{
	
			foreach ( $post as $key => $val )
			{
					
				if ( is_int ( $key ) )
				{
		
					$mail[] = $val;
				}
			}
				
			$mail = implode ( ', ', $mail );
				
			setcookie('mail', $mail , strtotime("12 hours"), '/');
				
		}
		
		if ( ! empty ( $post['mails'] ) && ! empty ( $_COOKIE['mail'] ) && ! empty ( $post['add'] ) )
		{
			
			$new_mail = implode ( ', ', array_diff ( explode ( ', ', $post['mails'] ), explode(', ', $_COOKIE['mail']) ) ) ;
		
			setcookie('mail', $new_mail , strtotime("12 hours"), '/');
		}
		
		if ( ! empty ( $post['Yes'] ) )
		{	
			
			foreach ( explode(', ', $_COOKIE['mail']) as $key => $mail)
			{
				
				$this->Information->insert (
								$what = array(
										'users_id' => $user['id'],
										'FirstName' => 'somenew',
										'Email' => $mail
								)					
						);
			}
			
			unset ( $_COOKIE['mail'] );
			
			header ( 'Location: / ');
		} 
		elseif ( ! empty ( $post['No'] ) )
		{
			
			header ( 'Location: / ');
		}
		
		$this->view->set ( 'mail', $mail );
		$this->view->set ( 'new_mail', $new_mail );
		
		$this->view->render ( $argument );
	}

}
	