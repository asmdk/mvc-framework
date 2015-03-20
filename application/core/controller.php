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

        public function actionIndex() {

        }

        public static function ErrorPage404()
        {
            //$host = 'http://'.$_SERVER['HTTP_HOST'].'/';
            header('HTTP/1.1 404 Not Found');
            header("Status: 404 Not Found");
            //header('Location:'.$host.'404');
        }

	}