<?php
Class User extends Model
{
		
	public $class = 'users';
		
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
		
	function deletes ( $value )
	{
		
		$result = parent::delete( $value );
			
		return $result;
	}
}