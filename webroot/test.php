<?php
date_default_timezone_set ( 'Europe/Kiev' );
error_reporting ( E_ALL );

$a =  preg_match('/50/', '50, 50, 1, 10, 12');

var_dump($a);