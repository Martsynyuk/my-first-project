<?php
	

$a = array(
		'contacts',
		'controller',
		'user'
);
$b = array(
		'contacts_controllers',
		'controller_controllers',
		'user_controllers'
);
$string = 'controller';

echo str_ireplace($a,$b,$string);

// Echo I like to eat an orange with my cat in my ford
?>
		