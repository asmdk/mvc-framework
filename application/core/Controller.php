<?php 

	class Controller {
		
		public $model;
		public $view;
        public $layout = 'default';
		
		public $name;
		public $actionName;
        public $defaultAction = 'Index';

		function __construct($name, $actionName = null)
		{
			$this->name = $name;
			$this->actionName = !empty($actionName) ? $actionName : $this->defaultAction;
			$this->view = App::createView($this);
		}

        /** return array actions classes
         *  return array('action'=>'ExportAction')
         *
         *  then you must create folder in Controller/{controller_name|lowercase}/ExportAction.php
         *  ExportAction extends form Action and override method run()
         */
        protected function actions()
        {
            return array();
        }

        /**
         * if action have class, include class file and return ClassName
         *
         * @param $action
         * @param $parameters
         * @return bool
         * @throws
         */
        public function checkActionClass($action, $parameters = null)
        {
            $actions = $this->actions();
            $className = false;
            if (is_array($actions) && isset($actions[$action])) {
                try {
                    require_once CONTROLLERS.strtolower($this->name).DS.$actions[$action].'.php';
                    $className = $actions[$action];
                        /** @var Action $actionClass */

                    $actionClass = new $className($this);
                    call_user_func_array(array($actionClass, 'run'), $parameters);
                }
                catch (ExtException $e) {
                    throw new ExtException($e->getMessage());
                }
            }
            return $className;
        }

        public static function ErrorPage404()
        {
            //$host = 'http://'.$_SERVER['HTTP_HOST'].'/';
            header('HTTP/1.1 404 Not Found');
            header("Status: 404 Not Found");
            //header('Location:'.$host.'404');
        }

	}
