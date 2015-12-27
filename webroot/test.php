<?php
date_default_timezone_set ( 'Europe/Kiev' );
error_reporting ( E_ALL );

$a = array(
		'1',
		'0',
		'3',
		'5',
		'4',
		'2'
);

$length = count($a);

for ( $i = 0; $i < $length-1; $i++)
{
	for ($j = 0; $j < $length-$i-1; $j++)
	{
		if ($a[$j] > $a[$j+1]) {
			$b = $a[$j]; //change for elements
			$a[$j] = $a[$j+1];
			$a[$j+1] = $b;
		}
	}
}

echo '<pre>' ;  var_dump($a); echo '</pre>' ;