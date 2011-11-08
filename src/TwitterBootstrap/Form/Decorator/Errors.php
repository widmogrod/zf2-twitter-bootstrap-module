<?php
/**
 * @author gabriel
 */

namespace TwitterBootstrap\Form\Decorator;

use \Zend\Form\Decorator\AbstractDecorator;

class Errors extends AbstractDecorator
{
    /**
     * Render errors
     *
     * @param  string $content
     * @return string
     */
    public function render($content)
    {
        $element = $this->getElement();
        $view    = $element->getView();
        if (null === $view) {
            return $content;
        }

        $errors = $element->getMessages();
        if (empty($errors)) {
            return $content;
        }

        /* @var $formErrors \Zend\View\Helper\FormErrors */
        $formErrors = $view->plugin('formErrors');
        $formErrors->setElementSeparator('</span><span>');
        $formErrors->setElementStart('<span%s>');
        $formErrors->setElementEnd('</span>');

        $separator = $this->getSeparator();
        $placement = $this->getPlacement();
        $errors    = $formErrors($errors, $this->getOptions());

        switch ($placement) {
            case self::APPEND:
                return $content . $separator . $errors;
            case self::PREPEND:
                return $errors . $separator . $content;
        }
    }
}
