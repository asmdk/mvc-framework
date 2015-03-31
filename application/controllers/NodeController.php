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
        //$model = new NodeModel();
        //$nodes = $model->getNodeList();

        /** @var NodeRepository $nodeRepository */
        $nodeRepository = $this->getEntityManager()->getRepository('Node');
        $nodes = $nodeRepository->findAll();
        $this->view->render('list', array('nodes'=>$nodes));
    }

    public function actionRandom()
    {
        /** @var NodeRepository $nodeRepository */
        $nodeRepository = $this->getEntityManager()->getRepository('Node');
        $nodes = $nodeRepository->getRandomNode();
        $this->view->render('list', array('nodes'=>$nodes));
    }

    public function actionView($id)
    {
        //$model = new NodeModel();
        //$model->findByPk($id);

        $node = $this->getEntityManager()->getRepository('Node')->find($id);
        $this->view->render('view', array('node'=>$node));
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