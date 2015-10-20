<?php


Class Information_models extends Model_models
{
		
	public $table = 'information';
		
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
		
	function update ( $what )
	{
				
		$result = parent::update ( $what );
				
		return $result;
	}
		
	function delete ( $value )
	{
				
		$result = parent::delete ( $value );
	
		return $result;
	}
}