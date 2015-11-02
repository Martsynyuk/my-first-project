<?php

/**
 * 
 * 
 */
 
class Contacts extends Controller
{

	public function  add ()
	{
			
		if ( ! empty ( $_POST ['FirstName'] ) ) 
		{
			
			if ( isset ( $_POST ['radio'] ) ) 
			{
				
				if ( $_POST ['radio'] === 'Home' )
				{
					$phone = $_POST ['Home'];
				}
				
				if ( $_POST ['radio'] === 'Work' )
				{
					$phone = $_POST ['Work'];
				}
				
				if ( $_POST ['radio'] === 'Cell' )
				{
					$phone = $_POST ['Cell'];
				}
			} 
			else{
				
				$phone = $_POST ['Cell'];
			}
				
			$add_user_contact = new Information();
				
			$new_contact = $add_user_contact->insert (
				
											$what = array(
													
													'users_id' => $_SESSION ['id'], // mast be int its important
													'Firstname' => $_POST ['FirstName'],
													'LastName' => $_POST ['LastName'],
													'Email' => $_POST ['Email'],
													'Home' => $_POST ['Home'],
													'Work' => $_POST ['Work'],
													'Cell' => $_POST ['Cell'],
													'Adress1' => $_POST ['Adress1'],
													'Adress2' => $_POST ['Adress2'],
													'City' => $_POST ['City'],
													'State' => $_POST ['State'],
													'Zip' => $_POST ['Zip'],
													'Country' => $_POST ['Zip'],
													'BirthDate' => $_POST ['year'] . '-' . $_POST ['month'] . '-' . $_POST ['day'],
													'Telephone' => $phone  
												
											)
						
						);
				
			if( $new_contact === 'No connect' )
			{
			
					header('Location: contacts/addcontact');
			}
		}
		
		$view = new View ();
			
		if( ! empty ( $phone ) )
		{
			$view->set ( 'phone', $phone );
		}
			
			$view->render ( 'contacts', 'add' );
		}
		
	public function edit ($get)
	{
			
		$this->contacts_defender ( $get['id'], $_SESSION ['id'] );
				
		$select_user_contacts = new Information ();
				
		$contactUser = $select_user_contacts->select(
				
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
			

		if ( $contactUser === 'No connect' )
		{
		
			header( 'Location: /' );
		}
			
		if ( ! empty ( $_POST ['FirstName'] ) ) 
		{
			
			if ( empty ( $_POST ['radio'] ) ) 
			{
				$phone = $_POST ['Cell'];
			}
				
			if ( isset ( $_POST ['radio'] ) ) 
			{
				if ( $_POST ['radio'] === 'Home' )
				{
					$phone = $_POST ['Home'];
				}
				
				if ( $_POST ['radio'] === 'Work' )
				{
					$phone = $_POST ['Work'];
				}
				
				if ( $_POST ['radio'] === 'Cell' )
				{
					$phone = $_POST ['Cell'];
				}
			}
				
			$update_contact = new Information ();
				
			$update_contact->update (
					
								$what = array(
										
									'fields' => array(
												
												'Firstname' => $_POST ['FirstName'],
												'Lastname' => $_POST ['LastName'],
												'Email' => $_POST ['Email'],
												'Home' => $_POST ['Home'],
												'Work' => $_POST ['Work'],
												'Cell' => $_POST ['Cell'],
												'Adress1' => $_POST ['Adress1'],
												'Adress2' => $_POST ['Adress2'],
												'City' => $_POST ['City'],
												'State' => $_POST ['State'],
												'Zip' => $_POST ['Zip'],
												'Country' => $_POST ['Country'],
												'BirthDate' => $_POST ['year'] . '-' . $_POST ['month'] . '-' . $_POST ['day'],
												'Telephone' => $phone,
											
									),
												
									'id' => $get['id']
						
								)
						
						);
				
			if ( $update_contact === 'No connect' )
			{
				
				header ( 'Location: contacts/editcontact' );
			}
				
				header ( 'Location: /' );
		}
			
		$view = new View ();
			
		$view->set ( 'contactUser', $contactUser );

		if( ! empty ( $phone ) )
		{
			
			$view->set ( 'phone', $phone );
		}
			
		$view->render ( 'contacts', 'edit' );
			
		return;
	}
		
	public function index ( $get )
	{
		
		if ( empty ( $_SESSION ['id'] ) )
		{
			
			header ( 'Location: user/autorization' );
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
				
			$get['sort'] = 0 & $get['sortparam'] = 0 ;
		}
			
		$user_contact = new Contacts ();
		
		$count_contacts = $user_contact->count_contacts($_SESSION['id']);
			
		$contacts = array ();
		$contacts = $this->return_contact ( $_SESSION ['id'], $page, $get['sort'], $get['sortparam'] );
			
		$count_for_pagin = $this->count_pages ( $_SESSION ['id'], $page );
		$count_pages = ceil ( $this->count_contacts () / 5 );
		
		$i = 1;
		($page > 1) ? $i = $page * ROWLIMIT - ROWLIMIT + 1 : '';  // to number of contacts
			
		$view = new View();
			
		$view->set ( 'count_contacts', $count_contacts );
		$view->set ( 'count_for_pagin', $count_for_pagin );
		$view->set ( 'page', $page );
		$view->set ( 'count_pages', $count_pages );
		$view->set ( 'contacts', $contacts );
		$view->set ( 'i', $i);
		$view->set ( 'get[\'sort\']', $get['sort']);
			
		$view->render ( 'contacts', 'index' );
		
	}
		
	public function select ( $get )
	{
		
		$mail = NULL;
		$new_mail = NULL;
		
		if ( ! empty ( $_POST['mails'] ) && ! empty ( $_SESSION['mail'] ) && ! empty ( $_POST['add'] ) )
		{
			
			$new_mail = implode ( ', ', array_diff ( explode ( ', ', $_POST['mails'] ), $_SESSION['mail'] ) ) ;
			
			unset ( $_SESSION ['mail'] );
		}
		
		if ( ! empty ( $_POST['Select'] ) )
		{
			
			$mail = $this->add_letter();			
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
			
		$contacts = array ();
		$contacts = $this->return_contact ( $_SESSION ['id'], $page, $get['sort'], $get['sortparam'] );
			
		$count_for_pagin = $this->count_pages ( $_SESSION ['id'], $page );
		$count_pages = ceil ( $this->count_contacts ( $_SESSION ['id'] ) / 5 );
			
			
		$view = new View ();
			
		$view->set ( 'count_for_pagin', $count_for_pagin );
		$view->set ( 'page', $page );
		$view->set ( 'count_pages', $count_pages );
		$view->set ( 'contacts', $contacts );
		$view->set ( 'i', $i);
		$view->set ( 'get[\'sort\']', $get['sort']);
		$view->set ( 'mail', $mail);
		$view->set ( 'new_mail', $new_mail);
			
		$view->render ( 'contacts', 'select' );
	}
		
	public function view ( $get )
	{	
		
		$contact_view = new Information ();

		if ( ( int ) ($get['id']) > 0 )
		{
				
			$contactUser = $contact_view->select (	
					
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
				
			if($contactUser === 'No connect')
			{
	
				header('Location: /');
			}
		}
		else{
				
			header ( 'Location: /' );
		}
		
		$view = new View ();
			
		$view->set ( 'contactUser', $contactUser );
			
		$view->render ( 'contacts', 'view' );
			
		return;
	}
		
	function delete ( $get )
	{
		
		if ( ! empty ( $get['id'] ) )
		{
			
			$protection = $this->contacts_defender ( $get['id'], $_SESSION ['id'] );
		
			if ( ! empty ( $protection )  )
			{	
				
				$delete_contact = new Information ();
						
				$delete_contact->delete ( $get['id'] );
	
				header('Location: /');
		
			}
		}

	}
			
	function count_contacts ()
	{	
		
		$count_contacts = new Information ();
			
		$res = $count_contacts->select(
				
									$what = array(
											
											'fields' => array(
													
															'COUNT(*)'
																			
											),
											
											'conditions' => array(
													
															'users_id' => $_SESSION['id'],
																				
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
			}                                 //
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
				
		if ( $sorting == 'up' && $sortparam == 'FirstName' or $sortparam == 'LastName' )
		{
					
			$sort = $sortparam;
		}
		elseif ( $sorting == 'down' && $sortparam == 'FirstName' or $sortparam == 'LastName' )
		{
					
			$sort = $sortparam;
			$deck = 'DESC';
		}
		else {
			header ( 'Location: /' );
		}

		$return_contact = new Information ();
			
		$result = $return_contact->select (
				
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
	
	function add_letter ()
	{
		$mail = array();
		
		if ( count($_POST) > 1 && ! empty ( $_POST['Select'] ) )
		{	
			
			foreach ( $_POST as $key => $val )
			{
					
				if ( is_int ( $key ) )
				{
						
					$mail[] = $val;
				}
			}
			$_SESSION['mail'] = array_unique ( $mail );
			
			$mail = implode ( ', ', array_unique ( $mail ) );
		}
		
		return $mail;
	}

}
	