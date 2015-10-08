<?php
Class View {
		
		private $var = array();
		
		public function set($name, $value)
		{
			
			$this->var[$name] = $value; 
		} 
		
		public function render($view)
		{
			
			ob_start();
			
			extract($this->var);
			
			switch ($view)
			{
				
				case file_exists(APP . '/View/contacts/' . $view . '.html'):
					
					include_once APP . '/View/contacts/' . $view . '.html';
					break;
					
				case file_exists(APP . '/View/users/' . $view . '.html');
				
					include_once APP . '/View/users/' . $view . '.html';
					break;
			}
			
			echo ob_get_clean();
		}
		
}
