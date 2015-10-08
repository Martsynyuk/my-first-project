<?php
	class Contacts extends Controller
	{
		
		public function  addContact()
		{
			
			if (! empty ( $_POST ['FirstName'] )) 
			{
			
				if (isset ( $_POST ['radio'] )) 
				{
					if ($_POST ['radio'] === 'Home')
					{
						$phone = $_POST ['Home'];
					}
					if ($_POST ['radio'] === 'Work')
					{
						$phone = $_POST ['Work'];
					}
					if ($_POST ['radio'] === 'Cell')
					{
						$phone = $_POST ['Cell'];
					}
				} 
				else{
					$phone = $_POST ['Cell'];
				}
				
				$add_user_contact = new Information();
				
				$new_contact = $add_user_contact->insert(
															$what = array(
																	'users_id' => $_SESSION ['id'], // mast be int its importent
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
				
				if($new_contact === 'No connect')
				{
					echo $new_contact;
				
					header('Location: /contacts/addcontact');
				}
			}
		
			$view = new View();
			
			if(!empty($phone))
			{
				$view->set('phone', $phone);
			}
			
			$view->render('contacts_addcontact');
		}
		
		public function editcontact()
		{
			
			$this->contactsDefender ( $_GET ['id'], $_SESSION ['id'] );
				
				$select_user_contacts = new Information();
				
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
																					'id' => $_GET['id'],
			
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
					echo $contactUser;
				
					header('Location: /');
				}
			
			if (! empty ( $_POST ['FirstName'] )) 
			{
				if (empty ( $_POST ['radio'] )) 
				{
					$phone = $_POST ['Cell'];
				}
				
				if (isset ( $_POST ['radio'] )) 
				{
					if ($_POST ['radio'] === 'Home')
					{
						$phone = $_POST ['Home'];
					}
					if ($_POST ['radio'] === 'Work')
					{
						$phone = $_POST ['Work'];
					}
					if ($_POST ['radio'] === 'Cell')
					{
						$phone = $_POST ['Cell'];
					}
				}
				
				$update_contact = new Information();
				
				$update_contact->update(
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
												'id' => $_GET ['id']
						
											)
						
						);
				
				if($update_contact === 'No connect')
				{
					echo $update_contact;
				
					header('Location: /contacts/editcontact');
				}
				
				header ( 'Location: /' );
			}
			
			$view = new View();
			
			$view->set('contactUser', $contactUser);

			if(!empty($phone))
			{
				$view->set('phone', $phone);
			}
			
			$view->render('contacts_editcontact');
			
			return;
		}
		
		public function index()
		{

			if(empty ( $_SESSION ['id'] ))
			{
				header ( 'Location: /user/autorization' );
			}
			
			if(! empty ( $_GET ['id'] ) && ! empty ( $_SESSION ['id'] ))
			{
				
				$this->deleteContact ( $_GET ['id'], $_SESSION ['id'] );
			}
			
			if(empty ( $_GET ['page'] ))
			{
				$page = 1;
			}
			else{
				$page = $_GET ['page'];
			}
			
			if(empty ( $_GET ['sort'] ) && empty ( $_GET ['sortparam'] ))
			{
				$_GET ['sort'] = 0 & $_GET ['sortparam'] = 0 ;
			}
			
			$userContact = new Contacts();
			
			$contacts = array ();
			$contacts = $this->returnContact ( $_SESSION ['id'], $page, $_GET ['sort'], $_GET ['sortparam'] );
			
			$count_for_pagin = $this->countPages ( $_SESSION ['id'], $page );
			$count_pages = ceil ( $this->countContacts () / 5 );
			
			$url = $this->url;
			$url_page = $this->url_page;
			$sortup = $this->sortup;
			$sortdown = $this->sortdown;
			
			$editcontact = "/contacts/editcontact?id=";
			$viewcontact = "/contacts/viewcontact?id=";
			$deletecontact = "/?id=";
			
			$view = new View();
			
			$view->set('userContact', $userContact);
			$view->set('count_for_pagin', $count_for_pagin);
			$view->set('page', $page);
			$view->set('count_pages', $count_pages);
			$view->set('contacts', $contacts);
			$view->set('editcontact', $editcontact);
			$view->set('viewcontact', $viewcontact);
			$view->set('deletecontact', $deletecontact);
			$view->set('sortup', $sortup);
			$view->set('sortdown', $sortdown);
			$view->set('url', $url);
			$view->set('url_page', $url_page);
			
			$view->render('contacts_index');
		}
		
		public function selectcontact()
		{

			
			if(empty ( $_GET ['page'] )) 
			{
				$page = 1;
			}
			else{
				$page = $_GET ['page'];
			}
			
			if (empty ( $_GET ['sort'] ) && empty ( $_GET ['sortparam'] )) {
				$_GET ['sort'] = 0;
				$_GET ['sortparam'] = 0;
			}
			
			$contacts = array ();
			$contacts = $this->returnContact ( $_SESSION ['id'], $page, $_GET ['sort'], $_GET ['sortparam'] );
			
			$count_for_pagin = $this->countPages ( $_SESSION ['id'], $page );
			$count_pages = ceil ( $this->countContacts ( $_SESSION ['id'] ) / 5 );
			
			$url = $this->url;
			$url_page = $this->url_page;
			$sortup = $this->sortup;
			$sortdown = $this->sortdown;
			
			$view = new View();
			
			$view->set('count_for_pagin', $count_for_pagin);
			$view->set('page', $page);
			$view->set('count_pages', $count_pages);
			$view->set('contacts', $contacts);			
			$view->set('sortup', $sortup);
			$view->set('sortdown', $sortdown);
			$view->set('url', $url);
			$view->set('url_page', $url_page);
			
			
			$view->render('contacts_selectcontact');
		}
		
		public function viewcontact()
		{	
		
			$contact_view = new Information();

			if (( int ) $_GET['id'] > 0)
			{

				$contactUser = $contact_view->select(	
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
																					'id' => $_GET['id'],
			
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
					echo $contactUser;
				
					header('Location: index');
				}
			}
			else{
				
				header ( 'Location: index' );
			}
		
			$view = new View();
			
			$view->set('contactUser', $contactUser);
			
			$view->render('contacts_viewcontact');
			
			return;
		}
		
		function deleteContact($id, $user)
		{
			$protection = $this->contactsDefender ( $id, $user );

			if(!empty($protection))
			{	

					$delete_contact = new Information();
					
					$delete_contact->delete($id);
					
					if($delete_contact === 'No connect')
					{
						echo $delete_contact;
					
						header('Location: index');
					}
			}
			else{
				
				echo'You have no rights to this';
			}
		}
		
		function contactsDefender($id, $user_id)
		{
			if (( int ) $id > 0)
			{
				
				$protection_contact = new Information();
				
				$user_contact = $protection_contact->select(
															$what = array(
																			'fields' => array(
																					'id',
																					'users_id'
													
																			),
																			'conditions' => array(
																					'id' => $id,
																					'users_id' => $user_id
																					
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
				if($user_contact === 'No connect')
				{
					echo $delete_contact;
						
					header('Location: index');
				}
					
				if (empty ( $user_contact ))
				{
					header ( 'Location: index' );
				}
			}
			else{
				header ( 'Location: index' );
			}
			
			return $user_contact;
		}
		
		function countContacts()
		{	
			$countContacts = new Information();
			
			$res = $countContacts->select(
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
																		))
																	
										);

			return $res ['0']['COUNT(*)'];
		}
		
		function countPages($page)
		{
			$count_pages = ceil ( $this->countContacts () / 5 );
			$count_show_pages = SHOWPAGES;
			$start = 1;
			$end = 1;
		
			if ($count_pages > 1)
			{
				$left = $page - 1;
				$right = $count_pages - $page;
					
				if ($left < floor ( $count_show_pages / 2 ))
				{
					$start = 1;
				}
				else {
					$start = $page - floor ( $count_show_pages / 2 );
				}
					
				$end = $start + $count_show_pages - 1;
					
				if ($end > $count_pages)
				{
					$start -= ($end - $count_pages);
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
		
		function returnContact($user_id, $page, $sorting, $sortparam) 
		{
				$sort = '';
				$deck = '';
				
				if ($sorting == 'up' && $sortparam == 'FirstName' or $sortparam == 'LastName')
				{
					
					$sort = $sortparam;
				}
				elseif($sorting == 'down' && $sortparam == 'FirstName' or $sortparam == 'LastName')
				{
					
					$sort = $sortparam;
					$deck = 'DESC';
				}
				else {
					header ( 'Location: index.php' );
				}

			$returnContact = new Information();
			
			$result = $returnContact->select(
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
																		))
												
												);

			$contacts = $result;

			if (empty ( $contacts ))
			{
				$contacts = array ();
			}
		
			return ($contacts);
		}

	}

	