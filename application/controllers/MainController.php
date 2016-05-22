<?php

class MainController extends Controller
{
    protected function actions()
    {
        return array(
            'export'=>'ExportAction',
        );
    }

    public function actionIndex()
    {
        $this->view->render('index');
    }

    public function actionErrorPage()
    {
        echo '404';
    }

    public function actionAbout()
    {
        $this->view->render('about');
    }
}