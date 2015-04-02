<?php
/**
 * Created by PhpStorm.
 * User: kel
 * Date: 01.04.2015
 * Time: 12:24
 */

class UserController extends Controller {

    public function actionLogin()
    {
        $name = App::$request->getPost('name', null);
        $pass = App::$request->getPost('pass', null);
        $message = null;

        if (app::$request->isPost()) {
            $aut = new User($name, $pass);
            if ($aut->getLogged()) $this->redirect('user/profile');
            $message = 'Bad name or password!';
        }

        $this->view->render('login', array('message'=>$message));
    }

    public function actionProfile()
    {
        if (App::$user->getLogged() === false) $this->redirect('user/login');
        $this->view->render('profile', array('user'=>App::$user->data));
    }

}