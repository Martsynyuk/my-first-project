<?php


interface For_model
{
	
	public function conect($host, $db_name, $user_name, $password);
	public function disconect($mysqli);
	public function select($what);
	public function insert($what);
	public function update($what);
	public function delete($value);
	public function query($sql); 
	public function contacts_defender($id, $user_id);
}