<?php

	class MainController extends Controller
{
    function actionIndex()
    {
        $model = new NodeModel();
        $nodes = $model->getNodeList();
        $this->view->render('index', array('nodes'=>$nodes));
    }
}