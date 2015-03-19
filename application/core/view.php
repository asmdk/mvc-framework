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
            $this->templateView = VIEWS.'layout'.DS.$controller->layout.'.php';
		}

        private function generate($content_view, $data = null)
        {
            $content = '';
            $this->tplName = $content_view;
            $this->tplFilePath = VIEWS.strtolower($this->controller->name).DS.$content_view.'.php';
            if(!empty($data) && is_array($data)) {
                // преобразуем элементы массива в переменные
                extract($data);
            }

            if (file_exists($this->templateView)) {
                ob_start();
                include $this->tplFilePath;
                $content = ob_get_contents();
                ob_end_clean();
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
                throw new Exception('Layout not found: '.$this->templateView);
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