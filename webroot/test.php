<?php
date_default_timezone_set ( 'Europe/Kiev' );
error_reporting ( E_ALL );

$integerMin = 0;
$integerMax = 100;
$decimal = 3;

	$num = rand($integerMin, $integerMax);
		
		if($decimal>0)
		{
			$dec ='';
			for($i = 1; $i <= $decimal; $i++)
			{
				$dec = $dec . rand(0, 9);
			}
			
			$num = $num . '.' . $dec;
		}
		
var_dump($num);