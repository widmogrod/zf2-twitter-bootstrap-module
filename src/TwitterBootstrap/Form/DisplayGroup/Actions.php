<?php
/**
 * @author gabriel
 */
 
namespace TwitterBootstrap\Form\DisplayGroup;

use \Zend\Form\DisplayGroup;

class Actions extends DisplayGroup
{
    /**
     * Load default decorators
     *
     * @return \Zend\Form\DisplayGroup
     */
    public function loadDefaultDecorators()
    {
        if ($this->loadDefaultDecoratorsIsDisabled()) {
            return $this;
        }

        $decorators = $this->getDecorators();
        if (empty($decorators)) {
            $this->addDecorator('FormElements')
                 ->addDecorator('HtmlTag', array('tag' => 'div', 'class' => 'actions'));
        }
        return $this;
    }
}