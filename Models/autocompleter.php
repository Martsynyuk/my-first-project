<?php
Class Autocompleter extends Model
{
	public $class = TABLE;
	
	function int($min, $max)
	{
		$num = rand($min, $max);
		
		return $num;
	}
	
	function varchar($name)
	{	
		$text = $name[array_rand($name)];
		
		return $text;
	}
	
	function enum($skills)
	{	
		$enum = $skills[array_rand($skills)];
		
		return $enum;
	}
	
	function decimal($integerMin, $integerMax, $decimal)
	{
		
		$num = rand($integerMin, $integerMax);
		
		if($decimal>0)
		{
			$dec ='';
			for($i = 1; $i <= $decimal; $i++)
			{
				$dec = $dec . rand(0, 9);
			}
			
			$num = $num . '.' . $dec;
		}
				
		return $num;
	}
	
	function date($date)
	{
		foreach ($date as $val)
		{
			$num[] = date($val);
		}
		
		$date = implode('-', $num);
		
		return $date;
	}
	
	function insert ( $what )
	{
	
		$result = parent::insert ( $what );
	
		return $result;
	}
	
	function selectinfo()
	{
		
		$sql = 'SELECT COLUMN_NAME, DATA_TYPE FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME=\'' . TABLE . '\'';
		
		$res = $this->query ( $sql );
		
		$result = mysqli_fetch_all ( $res,MYSQLI_ASSOC );
		
		return $result;
	}
}