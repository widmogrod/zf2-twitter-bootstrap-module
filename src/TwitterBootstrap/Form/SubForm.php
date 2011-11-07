<?php
/**
 * @author gabriel
 */
 
namespace TwitterBootstrap\Form;

class SubForm extends Form
{
    /**
     * Whether or not form elements are members of an array
     * @var bool
     */
    protected $_isArray = true;

    public function loadDefaultDecorators()
    {
        //return parent::loadDefaultDecorators();
        if ($this->loadDefaultDecoratorsIsDisabled()) {
            return $this;
        }

        $decorators = $this->getDecorators();
        if (empty($decorators)) {
            $this->addDecorator('FormElements')
                 ->addDecorator('Fieldset')
                 ->addDecorator('FormDecorator');
        }
        return $this;
    }
}