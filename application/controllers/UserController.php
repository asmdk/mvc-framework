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
        $name = App::$request->getPost('name', false);
        $pass = App::$request->getPost('pass', false);

        $aut = new User($name, $pass);
        $message = $aut->logged ? 'you are true' : 'false';

        $this->view->render('login', array('message'=>$message));
    }

}