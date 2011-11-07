<?php
/**
 * @author gabriel
 */
 
namespace TwitterBootstrap\Test;

class Form extends \TwitterBootstrap\Form\Form
{
    public function init()
    {
        $this->setMethodg(self::METHOD_POST);

        $this->addElement('text', 'title', array(
            'label' => 'Title',
        ));

        $this->addElement('prependedtext', 'prepended_title', array(
            'label' => 'Prepended text',
            'content' => '@',
            'description' => 'Here\'s some help text'
        ));

        $this->addElement('appendtext', 'appendtext_title', array(
            'label' => 'Appended checkbox',
            'content' => '<input type="checkbox"/>',
             'isActive' => true,
        ));

        $this->addElement('textarea', 'textarea_content', array(
            'label' => 'Textarea',
            'description' => 'Block of help text to describe the field above if need be.'
        ));

        $this->addActionElement('submit', 'save', array(
            'label' => 'Save changes'
        ));
        $this->addActionElement('reset', 'clear', array(
            'label' => 'Cancel'
        ));
    }
}