<?php
date_default_timezone_set ( 'Europe/Kiev' );
error_reporting ( E_ALL );

		$string = 'Ww !44 ads., s, asd asdsd, s wer ! asd s asd asdsd, s wer ! asd s asd asdsd, s';
		$count = 4; // mast be >10


			
			$string = explode(' ', $string);		
			
			for($i = 1; $i < 2; $i++)
			{
				$string[$count-1] = preg_replace('/[^a-zA-Z0-9]/', '', $string[$count-1]);
				
				if($count != 0 && iconv_strlen( $string[$count-1]) < 3 )
				{
					$count -= 1;
					$i -= 1;
				}
			}
			
			$string = implode(' ', array_slice($string, 0, $count)) . ' ...';
		var_dump($string);	
		
