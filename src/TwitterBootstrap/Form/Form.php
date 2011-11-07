<?php
/**
 * @author gabriel
 */
 
namespace TwitterBootstrap\Form;

class Form extends \Zend\Form\Form
{
    const DISPLAY_GROUP_ACTION = 'actions';

    private $customeElementDecoratorDefault = array(
        'ViewHelper',
        array('Errors', array('tag' => 'span', 'class' => 'help-inline')),
        array('Description', array('tag' => 'span', 'class' => 'help-block')),
        array('HtmlTag', array('tag' => 'div', 'class' => 'input')),
        'Label',
        'ElementWrapper'
    );

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
        'textarea' => array(
            'options' => array(
                'class' => 'xxlarge',
                'rows' => 3
            ),
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
                array('AdditionalElement', array('placement' => 'PREPEND')),
                array(array('input' => 'HtmlTag'), array('tag' => 'div', 'class' => 'input-prepend')),
                array('Errors', array('tag' => 'span', 'class' => 'help-inline')),
                array('Description', array('tag' => 'span', 'class' => 'help-block')),
                array('HtmlTag', array('tag' => 'div', 'class' => 'input')),
                'Label',
                'ElementWrapper'
            ),
        ),
        'appendtext' => array(
            'helper' => 'text',
            'decorators' => array(
                'ViewHelper',
                array('AdditionalElement', array('placement' => 'APPEND')),
                array(array('input' => 'HtmlTag'), array('tag' => 'div', 'class' => 'input-append')),
                array('Errors', array('tag' => 'span', 'class' => 'help-inline')),
                array('Description', array('tag' => 'span', 'class' => 'help-block')),
                array('HtmlTag', array('tag' => 'div', 'class' => 'input')),
                'Label',
                'ElementWrapper'
            ),
        ),
        'button' => array(
            'options' => array(
                'class' => 'btn'
            ),
        ),
        'reset' => array(
            'options' => array(
                'class' => 'btn'
            ),
        ),
        'submit' => array(
            'options' => array(
                'class' => 'btn primary'
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
        if (is_string($element))
        {
            $element = strtolower($element);
            if (isset($this->customeElementDecorators[$element]))
            {
                $baseOptions = $this->customeElementDecorators[$element];

                if (isset($baseOptions['decorators']))
                {
                    $decorators = $baseOptions['decorators'];
                    $options['decorators'] = (isset($options['decorators']))
                            ? array_merge($options['decorators'], $decorators)
                            : $decorators;
                }
                else
                {
                    $options['decorators'] = $this->customeElementDecoratorDefault;
                }

                if (isset($baseOptions['helper'])) {
                    $element = $baseOptions['helper'];
                }

                if (isset($baseOptions['options']))
                {
                    foreach($baseOptions['options'] as $key => $value)
                    {
                        if (!isset($options[$key])) {
                            $options[$key] = null;
                        }

                        switch($key)
                        {
                            case 'class':
                                $options[$key] .= ' '.$baseOptions['options'][$key];
                                break;

                            case 'rows':
                                $options[$key] = (null !== $options[$key]) ?: $baseOptions['options'][$key];
                                break;

                            default:
                                throw new \InvalidArgumentException('Merging option key "'.$key.'" is not defained');
                        }
                    }
                }

                return parent::addElement($element, $name, $options);
            }
        }

        return parent::addElement($element, $name, $options);
    }

    /**
     * @param string $element
     * @param string $name
     * @param null|array $options
     * @return void
     */
    public function addActionElement($element, $name, $options = null)
    {
        $this->addElement($element, $name, $options);
        $element = $this->getElement($name);

        /* @var $displayGroup \Zend\Form\DisplayGroup */
        $displayGroup = $this->getDisplayGroup(self::DISPLAY_GROUP_ACTION);
        if (!$displayGroup instanceof \Zend\Form\DisplayGroup)
        {
            $elements = array(
                $name
            );
            $options = array(
                'displayGroupClass' => 'TwitterBootstrap\Form\DisplayGroup\Actions'
            );
            $this->addDisplayGroup($elements, self::DISPLAY_GROUP_ACTION, $options);
        }
        else
        {
            $displayGroup->addElement($element);
        }
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
}