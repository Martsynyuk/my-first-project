<?php
date_default_timezone_set ( 'Europe/Kiev' );
error_reporting ( E_ALL );

$key = '';
$array = range('a','z');

$count = count($array)-1;

for($i=0;$i<10;$i++)
{
$key = $key . $array[rand(0,$count)];
}
$key = ucfirst($key);
var_dump($key);