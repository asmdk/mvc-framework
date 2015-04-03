<?php
/**
 * Created by PhpStorm.
 * User: kel
 * Date: 03.04.2015
 * Time: 4:16
 */

class MessageExtension extends Twig_Extension {

    public function getName()
    {
        return 'core_messages_extension';
    }

    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction(
                'show_messages',
                array($this, 'ShowMessagesFunction'),
                array(
                    'is_safe' => array('html'),
                    'needs_environment' => true,
                )
            ),
        );
    }

    public function ShowMessagesFunction(Twig_Environment $environment, $messages)
    {
        return $environment->render('TwigExtension'.DS.'messages.html.twig', array('messages'=>$messages));
    }

}