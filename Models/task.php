<?php


Class Test extends Model
{
	public $class = 'test';
	
	function string($string, $count)
	{
		//$string = 'wer ! asd s asd asdsd s';
		//$count = 20; // mast be >10
		$res = chunk_split($string, $count-4, '/!?|');
		
		$res = explode('/!?|', $res);
		$res = $res[0];
		$res = explode(' ', $res);
		unset($res[count($res)-1]);
		$res = implode(' ', $res);
		$res = $res . ' ...';
		var_dump($res);
		
		return $res;
	}
	
	function bildArray($a)
	{
		if(is_array($a))
		{
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
		}
		
		return $a;
	}
	
}