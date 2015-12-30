<?php


Class Test extends Model
{
	public $class = 'task';
	public $name = array('Anton', 'Oleg', 'etc :)');
	public $skills = array('long', 'short', 'toll', 'stupid');
	
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
	
	function word($string, $count)
	{
		//$string = 'wer ! asd s asd asdsd, s wer ! asd s asd asdsd, s wer ! asd s asd asdsd, s';
		//$count = 8; // mast be >10
		
		$res = explode(' ', $string);
		
		$string = $res[0];
		
		for($i=1; $i<$count; $i++)
		{
			$string = $string . ' ' . $res[$i];
		}
		$string = $string . ' ...';
		
		return $string;
	}
	
	function sortArray($bubble)
	{
		if(is_array($bubble))
		{
			$length = count($bubble);
			
			for ( $i = 0; $i < $length-1; $i++)
			{
				for ($j = 0; $j < $length-$i-1; $j++)
				{
					if ($bubble[$j] > $bubble[$j+1]) {
						$container = $bubble[$j]; //change for elements
						$bubble[$j] = $bubble[$j+1];
						$bubble[$j+1] = $container;
					}
				}
			}
		}
		
		return $bubble;
	}
	
	function autocomplete($count)
	{
		
		for($i=0; $i<$count; $i++)
		{
		
			$sql = parent::insert ( $what = array(
											'age'=>rand(18, 99),
											'Fullname'=>$this->name[array_rand($this->name)],
											'skills'=>$this->skills[array_rand($this->skills)],
											'price'=>rand(0, 999) . '.' . rand(0, 9) . rand(0, 9),
											'date_creation'=>date('Y') . '-'
																			. date('m') . '-'
																			. date('d')
											)
					);
		}
		
		return $sql;
	}
	
}