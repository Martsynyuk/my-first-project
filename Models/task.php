<?php


Class Task extends Model
{
	public $class = TABLE;
	
	function insert ( $what )
	{		
		$result = parent::insert ( $what );
	
		return $result;
	}
	
	function selectinfo()
	{	
		$sql = 'SELECT COLUMN_NAME, DATA_TYPE, EXTRA, COLUMN_TYPE FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME=\'' . TABLE . '\'';
	
		$res = $this->query ( $sql );
	
		$result = mysqli_fetch_all ( $res,MYSQLI_ASSOC );
	
		return $result;
	}
}