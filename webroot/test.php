<?php
date_default_timezone_set ( 'Europe/Kiev' );
error_reporting ( E_ALL );

$string = 'wer ! asd s asd asdsd, s wer ! asd s asd asdsd, s wer ! asd s asd asdsd, s';
$count = 8; // mast be >10

$res = explode(' ', $string);

$string = implode(' ', array_slice($res, 0, $count)) . ' ...';

var_dump($string);