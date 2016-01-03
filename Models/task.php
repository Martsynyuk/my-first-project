<?php


Class Test extends Autocompleter
{
	public $name = array('Anton', 'Oleg', 'etc :)');
	public $skills = array(0, 1, 2, 3);
	
	function string($string, $count)
	{
		//$string = 'wer ! asd s asd asdsd s';
		//$count = 20; // mast be >10
		$res = chunk_split($string, $count-4, '/!?|');
		
		$res = explode('/!?|', $res);
		$res = $res[0];
		$res = explode(' ', $res);
		$res = implode(' ', $res);
		$res = $res . ' ...';
		
		return $res;
	}
	
	function word($string, $count)
	{
		//$string = 'wer ! asd s asd asdsd, s wer ! asd s asd asdsd, s wer ! asd s asd asdsd, s';
		//$count = 8; // mast be >10

		$string = implode(' ', array_slice(explode(' ', $string), 0, $count)) . ' ...';
				
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
		$sql = $this->selectinfo();
		$array = array();
		
		foreach ($sql as $val)
		{
			$array[$val['COLUMN_NAME']] = $val['DATA_TYPE'];
		}
		
		$sql = $array; 
		unset($sql['id']);
		
		foreach ($sql as $key=>$val)
		{		
			switch ($val)
			{
				case 'int': 
					$sql[$key] = $this->int(18, 99);
					break;
				case 'varchar':
					$sql[$key] = $this->varchar($this->name);
					break;
				case 'decimal':
					$sql[$key] = $this->decimal(0, 999, 2);
					break;
				case 'enum':
					$sql[$key] = $this->enum($this->skills);
					break;
				case 'date':
					$sql[$key] = $this->date(array('Y', 'm', 'd'));
					break;
			}
		}
		
		for($i=0; $i<$count; $i++)
		{		
			$sql = parent::insert ($sql);				
		}
		
		return $sql;
	}
	
}