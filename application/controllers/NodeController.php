<?php
/**
 * Created by PhpStorm.
 * User: kel
 * Date: 25.03.2015
 * Time: 7:19
 */

class NodeController extends Controller {

    public function actionIndex()
    {
        $model = new NodeModel();
        $nodes = $model->getNodeList();
        $this->view->render('list', array('nodes'=>$nodes));
    }

    public function actionView($id)
    {
        $model = new NodeModel();
        $model->findByPk($id);
        $this->view->render('view', array('node'=>$model->getAttributes()));
    }

    public function actionAdd()
    {
        $attributes = App::$request->getPost('node', array());
        if (!empty($attributes)) {
            $model = new NodeModel();
            $model->setAttributes($attributes);
            $model->save();
        }
        $this->view->render('add', array('attributes'=>$attributes));
    }

    public function actionUpdate()
    {
        $id = App::$request->getParam('id');
        $model = new NodeModel();
        $model->findByPk($id);
        $model->setAttribute('title', 'title 5');
        $model->save();
        var_dump($model);exit;
    }

    public function actionDelete()
    {
        $id = App::$request->getParam('id');
        $model = new NodeModel();
        $model->findByPk($id);
        $result = $model->delete();
        var_dump($result);exit;
    }

}