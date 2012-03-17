<?php

namespace TwitterBootstrap\Controller;

use Zend\Mvc\Controller\ActionController;
use TwitterBootstrap\Test\Form;
use Zend\View\Model\ViewModel;

class TestController extends ActionController
{
    public function indexAction()
    {
        /* @var $rq \Zend\Http\PhpEnvironment\Request */
        $rq = $this->getRequest();

        $form = new Form();

        $result = new ViewModel();
        $result->form = $form;

        $this->plugin('Layout')->setTemplate('twittertest');

        if (!$rq->isPost()) {
            return $result;
        }

        if (!$form->isValid($rq->post()->toArray())) {
            return $result;
        }

        return $result;
    }
}
