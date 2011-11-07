<?php

namespace TwitterBootstrap\Controller;

use Zend\Mvc\Controller\ActionController;
use TwitterBootstrap\Test\Form;

class TestController extends ActionController
{
    public function indexAction()
    {
        /* @var $rq \Zend\Http\PhpEnvironment\Request */
        $rq = $this->getRequest();

        $form = new Form();

        $result = array(
            'form' => $form
        );

        if (!$rq->isPost()) {
            return $result;
        }

        if (!$form->isValid($rq->post())) {
            return $result;
        }

        return $result;
    }
}
