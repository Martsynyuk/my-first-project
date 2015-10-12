<?php
		// for TEST 22
	/*$what = array(
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
			'Country' => $_POST ['Country'],
			'BirthDate' => $_POST ['year'] . '-' . $_POST ['month'] . '-' . $_POST ['day'],
			'Telephone' => $phone
	
	);*/
		
	$_POST ['FirstName'] = 'Terr';
	$_POST ['LastName'] = 'Infanti';
	$_POST ['Home'] = '15464545';
	$_POST ['Work'] = '1545545';
	$_POST ['Cell'] = '1544554';
	$_POST ['Adress1'] = 'dsfdf';
	$_POST ['Adress2'] = 'sdfds';
	$_POST ['City'] = 'dsfdsf'; 
	$_POST ['State'] = 'dsfsdf';
	$_POST ['Zip'] = 'dsf';
	$_POST ['Country'] = 'sdf';
	$_POST ['year'] = '1512';
	$_POST ['month'] = '09';
	$_POST ['day'] = '31';
	
	// strpbrk — Ищет в строке любой символ из заданного набора string strpbrk ( string $haystack , string $char_list )
	
	
	if(!isset($_POST ['FirstName']))
	{
		header('Location: /');
	}
	
	if (!isset($_POST ['LastName']))
	{
		header('Location: /');
	}
	
	if (!isset($_POST ['Home']))
	{
		header('Location: /');
	}
	
	foreach ($_POST as $key)
	{
		
		if(iconv_strlen($_POST [$key]) < 1 && iconv_strlen($_POST [$key]) > 25)
		{
			
			header('Location: /');
		}
	}