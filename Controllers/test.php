<?php


Class Test extends Autocompleter
{
	public $model = array('task');
	
	function string($argument)
	{
		$res = NULL;
		
		if(!empty($_POST['some_text']))
		{		
			
			$post = $this->post_controller();
			
			if((int)($post['num'])>3)
			{
				$count = $post['num'];
			}
			else{
				$count = 5;
			}
			
			$res = chunk_split($post['some_text'], $count-4, '/!?|');			
			$res = explode('/!?|', $res);		
			$res = $res[0];		
			$res = explode(' ', $res);
			
			if(count($res)>1)
			{			
				$res = implode(' ', $res);
				$res = $res . ' ...';
				
			}
			else{
				$res = ' ...';
			}
				
		}
		$this->view->set('res', $res);
		
		$this->view->render( $argument );	
	}
	
	function word($argument)
	{
		$string = 'wer ! asd s asd asdsd, s wer ! asd s asd asdsd, s wer ! asd s asd asdsd, s';
		$count = 8; // mast be >10

		$string = explode(' ', $string);
		
		$string = implode(' ', array_slice($string, 0, $count)) . ' ...';
		var_dump($string);	
		
		$this->view->render ($argument);	
	}
	
	function bubble($argument)
	{
		$bubble = NULL;
		
		if(!empty($_POST['some_text']))
		{		
			$post = $this->post_controller();
			
			$bubble = explode(',', str_replace(' ', '', $post['some_text']));
			
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
			$bubble = implode(', ', $bubble);
		}
		
		$this->view->set('bubble', $bubble);
		
		$this->view->render( $argument );
	}
	
	function autocomplete($argument)
	{	
		
		if(!empty($_POST['num']))
		{	
			$post = $this->post_controller();
			
			$count = (int)($post['num']);
			
			$sql = $this->task->selectinfo();
			
			$array = array();
			$data = array();
			
			foreach ($sql as $key=>$val)
			{	
				if($val['EXTRA'] == 'auto_increment')
				{
					unset($sql[$key]);
				}
				else{
					$val['DATA_TYPE'] = array($val['DATA_TYPE'] => $val['COLUMN_TYPE']);
					$array[$val['COLUMN_NAME']] = $val['DATA_TYPE'];
				}
			}
			
			for($i=0; $i<$count; $i++)
			{
				$sql = $array;
				
				foreach ($sql as $num=>$value)
				{				
					foreach ($value as $key=>$val)
					{	
						switch ($key)
						{
							case 'int': 
								$sql[$num] = $this->int($val);
								break;
							case 'varchar':
								$sql[$num] = $this->varchar($val);
								break;
							case 'decimal':
								$sql[$num] = $this->decimal($val);
								break;
							case 'enum':
								$sql[$num] = $this->enum($val);
								break;
							case 'date':
								$sql[$num] = $this->date();
								break;
						}
					}
				}
					
				$this->task->insert ($sql);				
			}
			
			$this->view->set ('num', $post['num']);
		}
		
		$this->view->render ($argument);
	}
	
}