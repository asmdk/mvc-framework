<?php

	class View
	{
		public $templateView;
		public $controller;
        public $tplName;
        public $tplFilePath;

		public function __construct($controller)
		{
			$this->controller = $controller;
            $this->init();
		}

        protected function init()
        {
            $this->templateView = get_class($this->controller)!='Controller' ? VIEWS.'layout'.DS.$this->controller->layout.'.php' : CORE_VIEWS.$this->controller->layout.'.php';
            $this->tplFilePath = get_class($this->controller)!='Controller' ? VIEWS.strtolower($this->controller->name).DS : CORE_VIEWS;
        }

        public function setTplFilePath($path)
        {
            $this->tplFilePath = $path;
        }

        public function setTemplateView($path)
        {
            $this->templateView = $path;
        }

        private function generate($content_view, $data = null)
        {
            $content = '';
            $this->tplName = $content_view;
            $this->tplFilePath .= $content_view.'.php';
            if(!empty($data) && is_array($data)) {
                // преобразуем элементы массива в переменные
                extract($data);
            }

            if (file_exists($this->templateView)) {
                try {
                    ob_start();
                    include $this->tplFilePath;
                    $content = ob_get_contents();
                    ob_end_clean();
                }
                catch (ExtException $e) {
                    throw new ExtException($e->getMessage());
                }
            }
            else {
                throw new Exception('Layout not found: '.$this->templateView);
            }
            return $content;
        }

		public function render($content_view, $data = null)
		{
            $content = $this->generate($content_view, $data);

            if (file_exists($this->templateView)) {
                include $this->templateView;
            }
            else {
                throw new ExtException('Layout not found: '.$this->templateView);
            }
		}

        public function renderPartial($content_view, $data = null, $return = false)
        {
            $content = $this->generate($content_view, $data);

            if ($return) {
                return $content;
            }
            else {
                echo $content;
            }
        }
	}
