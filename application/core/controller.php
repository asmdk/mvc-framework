<?php 

	class Controller {
		
		public $model;
		public $view;
        public $layout = 'default';
		
		public $name;
		public $actionName;
		
		function __construct($name, $actionName)
		{
			$this->name = $name;
			$this->actionName = $actionName;
			$this->view = new View($this);
		}
	}