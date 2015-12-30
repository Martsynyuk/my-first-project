<?php
date_default_timezone_set ( 'Europe/Kiev' );
error_reporting ( E_ALL );

$bubble = array(23, 1, 5, 77, 2);

if(is_array($bubble))
{
	$length = count($bubble);
		
	for ( $i = 0; $i < $length-1; $i++)
	{
		for ($j = 0; $j < $length-$i-1; $j++)
		{
			if ($bubble[$j] > $bubble[$j+1]) {
				$container = $bubble[$j]; //change for elements
				$bubble[$j] = $bubble[$j+1];
				$bubble[$j+1] = $container;
			}
		}
	}
}

var_dump($bubble);