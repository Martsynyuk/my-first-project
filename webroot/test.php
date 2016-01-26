<?php
date_default_timezone_set ( 'Europe/Kiev' );
error_reporting ( E_ALL );
		
if(isset($_POST['z'])) {
	
	header("Content-type: text/txt; charset=UTF-8");
	
	if($_POST['z']=='1') {
		$i = 1;
		echo $i;		
	}
	
	
}
		