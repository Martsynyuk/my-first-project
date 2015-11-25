<?php
date_default_timezone_set ( 'Europe/Kiev' );
error_reporting ( E_ALL );

$a = array(
		
		'1',
		'2',
		'3',
		'1'
);
 
$b = array_unique($a);
var_dump($b);