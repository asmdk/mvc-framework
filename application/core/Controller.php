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
            $viewClass = Config::get('View');
			$this->view = !empty($viewClass) ? new $viewClass($this) : new View($this);
		}

        /** return array actions classes */
        protected function actions()
        {
            return array();
        }

        /**
         * if action have class, include class file and return ClassName
         *
         * @param $action
         * @return bool
         * @throws
         */
        public function checkActionClass($action)
        {
            $actions = $this->actions();
            $className = false;
            if (is_array($actions) && isset($actions[$action])) {
                try {
                    require_once CONTROLLERS.strtolower($this->name).DS.$actions[$action].'.php';
                    $className = $actions[$action];
                        /** @var Action $actionClass */
                    $actionClass = new $className($this);
                    $actionClass->run();
                }
                catch (ExtException $e) {
                    throw new ExtException($e->getMessage());
                }
            }
            return $className;
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
