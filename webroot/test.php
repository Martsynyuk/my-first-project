<?php
date_default_timezone_set ( 'Europe/Kiev' );
error_reporting ( E_ALL );
$f=array();
$x = '1';
$array = array(
		
		'a'=>array(
				'1',
				'2',
				'3'
				),
		'b'=>array(
				'4',
				'5',
				'6',
				'8'
				),
		'c'=>array(
				'7',
				'8',
				'9',
				'1'
				)
);
	
foreach ($array as $key=>$val)
{
	
	foreach ($val as $a)
	{
		
		if ($a==$x)
		{
			$f[] = $key; 
			break ;
		}
	}
}
var_dump($f);