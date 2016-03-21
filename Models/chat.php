<?php

Class Chat extends Model
{
	public $class = 'chat';
	
	function select ( $what )
	{
			
		$result = parent::select ( $what );
			
		return $result;
	}
	
	function insert ( $what )
	{
			
		$result = parent::insert ( $what );
			
		return $result;
	}
}