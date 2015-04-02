<?php 

	class Controller {
		
		public $model;
		public $view;
        public $layout = 'default';
		
		public $name;
		public $actionName;
        public $defaultAction = 'Index';

        /** @var  Doctrine\ORM\EntityManager */
        protected $em = null;

		function __construct($name, $actionName = null)
		{
			$this->name = $name;
			$this->actionName = !empty($actionName) ? $actionName : $this->defaultAction;
			$this->view = App::createView($this);
            if (empty($this->em)) {
                $this->em = $this->setEntityManager();
            }
		}

        private function setEntityManager()
        {
            $paths = array(ENTITIES);
            $proxyDir = CACHE.'proxy';
            $isDevMode = Config::get('app_environment') == 'development';

            // the connection configuration
            $dbParams = Config::get('doctrine');
            $config = Doctrine\ORM\Tools\Setup::createAnnotationMetadataConfiguration($paths, $isDevMode, $proxyDir);
            return Doctrine\ORM\EntityManager::create($dbParams, $config);
        }

        /** @return Doctrine\ORM\EntityManager */
        protected function getEntityManager()
        {
            return $this->em;
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

        public function redirect($uri)
        {
            $uri = '/' . trim($uri, '/');
            header('Location: '.$uri);
        }

	}
