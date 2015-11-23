<?php
	$c = array(
			
			'a',
			'ss',
			'asd'
	);
 $a = array();
 $a = '';
 $b = array();
 $b ['mail'] = $a;
 
 foreach ( $c as $val )
 {
 	
 		$b[]=$val;
 }
 $b = implode ( ', ', $b);
 var_dump($b);
 
 