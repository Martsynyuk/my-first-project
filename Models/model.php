<?php
	Class Model implements For_model
	{
		
		/**
		 * 
		 * 
		 * @param string $host
		 * @param string $db_name
		 * @param string $user_name
		 * @param string $password
		 * @return array mysqli
		 * 
		 */
		
		function conect($host, $db_name, $user_name, $password)
		{			
			
			$mysqli = @new mysqli($host, $user_name, $password, $db_name);
			
			if ($mysqli->connect_errno) 
			{
				echo 'No connect';  //: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
							
			}

			return $mysqli;
				
		}
		
		function disconect($host, $db_name, $user_name, $password)
		{
			
			mysqli_close($this->conect($host, $db_name, $user_name, $password));
		}
		
		/**
		* 
		* 
		* 
		* 
		* @param array $what = array(
		*						 'fields' => array(
		*										 'firstname',
		*										 'lastname'
		*						 	
		*										 ),
		*						 'conditions' => array(
		*												 'users_id' => '1',
		*												 'firstname' => 'Terr',
		*												 'town' => 'Kherson'
		*												 ),
		*						 'order' => array(
		*										 'by' => 'created',
		*										 'direction' => 'DESC'
		*										 
		*										 ),
		*						 'limit' => array(
		*											 'start' => '0',
		*											 'end'=> ''
		*										 )
		*					 );
		*/
		
		function select($what)
		{
			$mysqli = $this->conect('localhost', 'user', 'root', '');
			
			if ($mysqli->connect_errno) 
				{
					
					$result = 'No connect';			
				}
				else{
						
						$this->disconect('localhost', 'user', 'root', '');
					
						if(!empty($what['fields']))
						{
							$fields = implode(', ', $what['fields']);
						}
						else{
							
							$fields = '*';
						}
						
						$sql = 'SELECT ' . $fields . ' FROM  '. $this->table;
						
						if(!empty($what['conditions']))
						{		
							
							$where = '';
						
							foreach($what['conditions'] as $key => $value)
							{
			
								$where= $where . ' AND ' .  $key . '=\'' . $value . '\'';				
							}
							
							$where = ltrim($where,' AND');
								
							$sql = $sql . ' WHERE  ' . $where ;
			
						}
						
						if (!empty($what['order']['by']) && !empty($what['order']['direction']))
						{
						
							$sql = $sql . ' ORDER BY ' . $what['order']['by'] . ' ' . $what['order']['direction'] ;
						}
						elseif(!empty($what['order']['by']))
						{
							$sql = $sql . ' ORDER BY ' . $what['order']['by'] ;
						}
						
						if(!empty($what['limit']['start']) or $what['limit']['start'] == 0 && !empty($what['limit']['end']))
						{
						
							$sql = $sql . ' LIMIT ' . $what['limit']['start'] . ',' . $what['limit']['end'];
						}
						
						$sql = $sql . ' ;' ;
						
						$res = $this->query($sql);
						
						if(!empty($res))
						{
							$result = mysqli_fetch_all($res,MYSQLI_ASSOC);
						}
				}

			return $result;
		}
		
		/**
		* 
		* 
		* @param array $what = array(
		*				'user_id' => 101, // mast be int its importent
		*				'firstname' => 'Terr'
		*			
		*				)
		* 
		*/
	
		function insert($what)
		{
			$mysqli = $this->conect('localhost', 'user', 'root', '');
				
			if ($mysqli->connect_errno)
			{
				 	
				$result = 'No connect';
			}
			else{
				
				$this->disconect('localhost', 'user', 'root', '');
			
				if(!empty($what))
				{
						
					$val = '';
					$key = '';
						
					foreach ($what as $index => $value)
					{

						$key = $key . ', ' . $index;
						$val = $val . ', \'' . $value . '\'';				
					}
					
					$key = ltrim($key,', ');
					$val = ltrim($val,', ');
					
					$sql ='INSERT INTO ' . $this->table . ' (' . $key . ') VALUE (' . $val . ');';
					
				}
					
					$this->query($sql);
					
					$result = TRUE;
			}

			return $result;
		}
		
		/**
		* 
		* 
		* 
		* @param array $what = array(
		*				 'fields' => array(
		*								   'firstname' => 'Terr',
		*								 	'lastname' => 'Mops',
		*								 	'telephone' => '1254215'
		*								),
		*				'id' => 1
        *
		*				);
		* 
		*/
		
		function update($what)
		{
			
			if ($mysqli->connect_errno)
			{
			
				$result = 'No connect';
			}
			else{
					if(!empty($what) && (int)($what['id'] > 0))
					{
		
						$field = '';
					
						foreach ($what['fields'] as $key => $value)
						{
		
							$field = $field . ', ' . $key . '= \'' . $value . '\'';					
						}
					
						$field = ltrim($field,', ');
						
						$sql = 'UPDATE information SET ' . $field . ' WHERE id=' . $what['id'] . ';';			
		
					}	
						
						$this->query($sql);
						
						$result = TRUE;
			}
			
			return $result;
		}
		
		/**
		 * 
		 * 
		 * @param $value
		 * @return string|array
		 */
		
		function delete($value)
		{	
			
			if ($mysqli->connect_errno)
			{
					
				$result = 'No connect';
			}
			else{
			
				$sql = 'DELETE FROM ' . $this->table . ' WHERE id=' . $value . ';';
				
				$mysqli = $this->conect('localhost', 'user', 'root', '');
				
				$result = $mysqli->query($sql);
				
				$this->disconect('localhost', 'user', 'root', '');
				
				$result = TRUE;
				
			}

			return $result;
		}
		
		/**
		* 
		* @param $sql
		* 
		*/
		
		function query($sql)
		{
			$mysqli = $this->conect('localhost', 'user', 'root', '');
			
			$result = $mysqli->query($sql);
				
			$this->disconect('localhost', 'user', 'root', '');
			
			return $result;
			
		}
			
	}