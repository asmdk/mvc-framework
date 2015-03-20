<?php

	class MainController extends Controller
{
    function actionIndex()
    {
        $model = new NodeModel();
        $nodes = $model->getNodeList();
        $this->view->render('index', array('nodes'=>$nodes));
    }

    function actionView()
    {
        $id = App::$request->getParam('id');
        $model = new NodeModel();
        $model->findByPk($id);
        $this->view->render('view', array('node'=>$model->getAttributes()));
    }

    function actionAdd()
    {
        $model = new NodeModel();
        $model->setAttributes(
            array(
                'title'=>'Заголовок 4',
                'body'=>'Тело 4',
            )
        );
        $model->save();
        var_dump($model);exit;
    }

    function actionUpdate()
    {
        $id = App::$request->getParam('id');
        $model = new NodeModel();
        $model->findByPk($id);
        $model->setAttribute('title', 'title 5');
        $model->save();
        var_dump($model);exit;
    }
}