<?php
Class Autocompleter extends Controller
{
	function __construct()
	{
		require_once APP . '/Models/model.php';
		require_once APP . '/Models/task.php';
		
		foreach ($this->model as $madel => $class)
		{
			$this->$class = new $class();
		}
		
		$this->view = new View();
	}
	
	function int($num)
	{
		$num = rtrim(ltrim($num, 'int('), ')');
		$max = 9;
		
		if($num > 11)
		{
			$num = 11;
		}
		
		for($i = 1; $i < $num; $i++)
		{
			$max = $max . 9;
		}
		
		$num = rand(0, (int)($max));
		
		return $num;
	}
	
	function varchar($data)
	{	
		$data = rtrim(ltrim($data, 'varchar('), ')');
		
		$string = '';
		$maxlangs = rand(1, $data);
		$array = range('a','z');		
		$count = count($array)-1;
		
		for($i = 0; $i < $maxlangs; $i++)
		{
			$string = $string . $array[rand(0, $count)];
		}
		$string = ucfirst($string);
		
		return $string;
	}
	
	function enum($skills)
	{	
		$skills = rtrim(ltrim($skills, 'enum('), ')');
		$skills = count(explode(',', $skills));
		
		$enum = rand(1, $skills);
		
		return $enum;
	}
	
	function decimal($num)
	{
		$num = rtrim(ltrim($num, 'decimal('), ')');
		$num = explode(',', $num);
		
		$max = 9;
		
		for($i = 1; $i < $num[0]-$num[1]; $i++)
		{
			$max = $max . 9;
		}
				
		$numeric = rand(0, $max);
		
		if($num[1]>0)
		{
			$dec ='';
			for($i = 1; $i <= $num[1]; $i++)
			{
				$dec = $dec . rand(0, 9);
			}
			
			$num = $numeric . '.' . $dec;
		}
		
		return $num;
	}
	
	function date()
	{

		$date = date('Y-m-j', mt_rand(strtotime(1900-01-01), strtotime(2000-01-01)));;
		
		return $date;
	}
	
}