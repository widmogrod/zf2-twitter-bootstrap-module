<?php
/**
 * @author gabriel
 */
 
namespace TwitterBootstrap\Form;

class Form extends \Zend\Form\Form
{
    private $customeElementDecorators = array(
        'text' => array(
            'decorators' => array(
                'ViewHelper',
                array('Errors', array('tag' => 'span', 'class' => 'help-inline')),
                array('Description', array('tag' => 'span', 'class' => 'help-block')),
                array('HtmlTag', array('tag' => 'div', 'class' => 'input')),
                'Label',
                'ElementWrapper'
            ),
        ),
        'prependedtext' => array(
            'helper' => 'text',
            'decorators' => array(
                'ViewHelper',
                array('AdditionalElement', array('tag' => 'span', 'class' => 'add-on', 'placement' => 'PREPEND')),
                array(array('input' => 'HtmlTag'), array('tag' => 'div', 'class' => 'input-prepend')),
                array('Errors', array('tag' => 'span', 'class' => 'help-inline')),
                array('Description', array('tag' => 'span', 'class' => 'help-block')),
                array('HtmlTag', array('tag' => 'div', 'class' => 'input')),
                'Label',
                'ElementWrapper'
            ),
        ),
    );

    public function __construct($options = null)
    {
        $this->addPrefixPath(__NAMESPACE__ . '\Decorator', __DIR__ . '/Decorator', self::DECORATOR);
        parent::__construct($options);
    }

    public function addElement($element, $name = null, $options = null)
    {
//        $getId = function(Decorator $decorator) {
//            return $decorator->getElement()->getId() . '-element';
//        };

        if (is_string($element))
        {
            $element = strtolower($element);
            if (isset($this->customeElementDecorators[$element]))
            {
                $baseOptions = $this->customeElementDecorators[$element];
                $baseElement = $element;
                $decorators = $baseOptions['decorators'];
                $options['decorators'] = (isset($options['decorators']))
                        ? array_merge($options['decorators'], $decorators)
                        : $decorators;

                $element = (isset($baseOptions['helper']))
                        ? $baseOptions['helper']
                        : $element;

                $return = parent::addElement($element, $name, $options);

//                $methodPostAdd = 'handlePostAdd'.ucfirst($baseElement);
//                if (method_exists($this, $methodPostAdd))
//                {
//                    $this->$methodPostAdd($element);
//                }

                return $return;
            }
        }

        return parent::addElement($element, $name, $options);
    }

    public function loadDefaultDecorators()
    {
        //return parent::loadDefaultDecorators();
        if ($this->loadDefaultDecoratorsIsDisabled()) {
            return $this;
        }

        $decorators = $this->getDecorators();
        if (empty($decorators)) {
            $this->addDecorator('FormElements')
                 ->addDecorator('HtmlTag', array('tag' => 'div', 'class' => 'zend_form'))
                 ->addDecorator('FormDecorator');
        }
        return $this;
    }

    /*
     * Handlers for post add element action.
     */

//    private function handlePostAddPrependedtext($elementName, array $options = null)
//    {
//        if (isset($options['prependtext']))
//        {
//            $element = $this->getElement($elementName);
//            $element->getDecorator('prependtext')->setContent($options['prependtext']);
//        }
//    }
}