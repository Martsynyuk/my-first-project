<?php

$myStr = 'home my home go homelol';
$myStr = preg_replace ("/(home)([ \.)])/", 
		'bum', 
		$myStr);
		
echo $myStr;
?> 	