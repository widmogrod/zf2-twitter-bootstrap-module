<?php
/**
 * @author gabriel
 */
 
namespace TwitterBootstrap\Form\Decorator;

use \Zend\Form\Decorator\AbstractDecorator;

class ElementWrapper extends AbstractDecorator
{
    /**
     * Decorate content and/or element
     *
     * @param  string $content
     * @return string
     */
    public function render($content)
    {
        /* @var $element \Zend\Form\Element */
        $element = $this->getElement();
        if (!$element instanceof \Zend\Form\Element) {
            return $content;
        }

        $class = $this->getOption('class');
        $class = trim($class);
        $class = array(
            empty($class) ? 'clearfix' : $class,
        );

        if ($element->hasErrors()) {
            $class[] = 'error';
        }

        $class = implode(' ', $class);

        $deoration = '<div class="%s">%s</div>';
        $deoration = sprintf($deoration, $class, $content);

        return $deoration;
    }
}