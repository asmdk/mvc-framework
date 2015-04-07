<?php
/**
 * Created by PhpStorm.
 * User: kel
 * Date: 23.03.2015
 * Time: 13:21
 */

/**
 * view for use twig template in project
 * for use you need
 * 1. set to settings.php View twig:
 *  Config::set('View', 'ViewTwig');
 * 2. Create "templates" folder in "application" folder, when you create all your templates
 * 3. Create "compilation_cache" folder in "root" folder, for cache
 *
 * Now you can use twig.
 *
 *
 * Class ViewTwig
 */
class ViewTwig extends View {

    protected $cachePath;
    /** @var  Twig_Environment */
    protected $twig;

    protected function init()
    {
        $this->templateView = APPLICATION.'templates';
        $this->tplFilePath = get_class($this->controller)!='Controller' ? strtolower($this->controller->name).DS : '';
        $this->cachePath = CACHE.'twig';
        $this->includeTwig();
    }

    protected function includeTwig()
    {
        //require_once VENDOR.'twig\twig\lib\Twig'.DS.'Autoloader.php';
        Twig_Autoloader::register();
        $loader = new Twig_Loader_Filesystem($this->templateView);
        $this->twig = new Twig_Environment($loader, array(
            'cache'       => $this->cachePath,
            'auto_reload' => true,
            'debug'       => Config::get('app_environment') == 'development',
        ));

        //add core twig extensions
        $twigExt = App::getTwigExtensions();
        if (!empty($twigExt)) {
            foreach($twigExt as $ext) {
                $this->twig->addExtension(new $ext);
            }
        }

        //add global variables
        $this->twig->addGlobal('messages', App::$messages);
        $this->twig->addGlobal('controller', $this->controller);
        $this->twig->addGlobal('user', App::$user);
        $this->twig->addGlobal('request', App::$request);

        //add debug
        if (Config::get('app_environment') == 'development') {
            $this->twig->addExtension(new Twig_Extension_Debug());
        }
    }

    public function render($content_view, $data = array())
    {
        //twig template
        echo $this->twig->render($this->tplFilePath.DS.$content_view.'.twig', $data);
    }

    public function renderPartial($content_view, $data = null, $return = false)
    {
        $this->render($content_view, $data);
    }

}