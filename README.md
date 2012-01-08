# TwitterBootstrap

TwitterBootstrap is Zend Framework 2 module, which add integration with [twitter bootstrap toolkit](https://github.com/twitter/bootstrap).

*P.S.* Sory for my english. If You wish to help me with this project or correct my english description - You are welcome :)

# Requirements

* Zend Framework 2 (https://github.com/zendframework/zf2)
* ZF2 Assetic module (https://github.com/widmogrod/zf2-assetic-module)

# Installation

Simplest way:

  1. cd my/project/folder
  2. git clone git://github.com/widmogrod/zf2-twitter-bootstrap-module.git modules/TwitterBootstrap --recursive
  3. git clone git@github.com:widmogrod/zf2-datagrid-bundle.git modules/AsseticBundle --recursive
  4. open my/project/folder/configs/application.config.php and add 'TwitterBootstrap' and 'AsseticBundle' to your 'modules' parameter.
  5. run in browser your project ie. http://example.com/twittertest


# Stylesheet attachment.

Stylesheet attachment to HTML document is done automaticly by [zf2-assetic-module](https://github.com/widmogrod/zf2-assetic-module) (this module is still in development).

# Project plan

* TODO
   * Messenger integration
   * View helper for alerts&errors
   * Configuration option witch allow use bootstrap with less
   * Create simple DataGrid

* DONE
   * create better stylesheet & JS attachment

# Zend\Form integration.

![Example output of Zend_Form](https://raw.github.com/widmogrod/zf2-twitter-bootstrap-module/master/docs/img/advence_form.png)

```
<?php
// SIMPLE EXAMPLE
class Form extends \TwitterBootstrap\Form\Form
{
    public function init()
    {
        $this->setMethod(self::METHOD_POST);

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
?>
```


```
<?php
// ADVENCE EXAMPLE
namespace Quiz\Form;

use \TwitterBootstrap\Form as TwitterForm,
    \Quiz\Entity\Question as QuestionEntity;

class Question extends TwitterForm\Form
{
    public function init()
    {
        $this->setMethod(self::METHOD_POST);
//        $this->setAction('/quizadmin/quizmanage');
        $this->setLegend('Pytanie');

        $this->addElement('text', 'title', array(
            'label' => 'Tytuł',
            'description' => 'Imperatyw skłaniający do działania, np.: "Odpowiedz na pytanie" lub "Co widzisz na zdjęciu?"',
            'required' => true,
            'filters' => array(
                'StripTags',
            ),
            'validators' => array(
                array(
                    'validator' => 'StringLength',
                    'options' => array('max' => 255)
                )
            )
        ));

        $this->addElement('select', 'type', array(
            'label' => 'Rozaj pytania',
            'multiOptions' => QuestionEntity::getAvailableTypes(),
            'required' => true
        ));

        /*
         * Diffrent types of questions
         */
        {{
            $this->addElement('textarea', 'content_' . QuestionEntity::TYPE_TEXT , array(
                'label' => 'Treść pytania',
                'description' => 'Proszę podać treść pytania, na które użytkownik ma odpowiedzieć',
                'filters' => array(
                    'StripTags',
                ),
                'validators' => array(
                    array(
                        'validator' => 'StringLength',
                        'options' => array('max' => 255)
                    )
                )
            ));
            $this->addElement('file', 'content_' . QuestionEntity::TYPE_IMAGE , array(
                'label' => 'Treść pytania',
                'description' => 'Proszę załączyć zdjęcie o szerokości nie mniejszej niż 340px',
                'destination' => APPLICATION_PATH . '/public/upload',
                'validators' => array(
//                    'IsImage',
                    array(
                        'validator' => 'ImageSize',
                        'options' => array(
                            'minWidth' => 340
                        )
                    ),
                )
            ));
            $this->addElement('text', 'content_' . QuestionEntity::TYPE_AUDIO , array(
                'label' => 'Treść pytania',
                'description' => 'Proszę wkleić link do materiału w serwisie YouTube',
                'filters' => array(
                    'StripTags',
                ),
                'validators' => array(
                    array(
                        'validator' => 'StringLength',
                        'options' => array('max' => 255)
                    ),
                    new \Quiz\Validator\YouTube()
                )
            ));
            $this->addElement('text', 'content_' . QuestionEntity::TYPE_VIDEO , array(
                'label' => 'Treść pytania',
                'description' => 'Proszę wkleić link do materiału w serwisie YouTube',
                'filters' => array(
                    'StripTags',
                ),
                'validators' => array(
                    array(
                        'validator' => 'StringLength',
                        'options' => array('max' => 255)
                    ),
                    new \Quiz\Validator\YouTube()
                )
            ));
        }}

        $this->addElement('checkbox', 'isActive', array(
            'label' => 'Widoczne',
            'description' => 'Czy wyświetlać pytanie użytkownikowi?',
        ));

        $this->initAnswers();

        $this->addActionElement('submit', 'save', array(
            'label' => 'Zapisz'
        ));
        $this->addActionElement('reset', 'cancel', array(
            'label' => 'Anuluj'
        ));
    }

    public function initAnswers()
    {
        /*
         * Validation for "<input type="radio" name="correct" value="3">"
         * defined in answer
         */
        $this->addElement('hidden', 'correct', array(
            'required' => true,
//            'validators' => array(
//                array('NotEmpty', array('breakChainOnFailure' => true, 'message' => array(\Zend\Validator\NotEmpty::IS_EMPTY => "Zaznacz przy odpowiedzi, która z nich jest prawidłowa",)))
//            )
        ));
//        /** @var $validator  \Zend\Validator\NotEmpty */
//        $validator = $this->getElement('correct')->getValidators('Zend\Validator\NotEmpty');
//        $validator->setMessage("Zaznacz przy odpowiedzi, która z nich jest prawidłowa", \Zend\Validator\NotEmpty::IS_EMPTY);

        $form = new TwitterForm\SubForm();
        $form->setLegend('Odpowiedzi');
        $form->addElement(self::ELEMENT_APPENDED_TEXT, '1', array(
            'label' => 'Odpowiedź pierwsza',
            'content' => '<input type="radio" name="correct" value="1">',
            'required' => true,
        ));
        $form->addElement(self::ELEMENT_APPENDED_TEXT, '2', array(
            'label' => 'Odpowiedź druga',
            'content' => '<input type="radio" name="correct" value="2">',
            'required' => true,
        ));
        $form->addElement(self::ELEMENT_APPENDED_TEXT, '3', array(
            'label' => 'Odpowiedź trzecia',
            'content' => '<input type="radio" name="correct" value="3">',
            'required' => true,
        ));

        $this->addSubForm($form, 'answers');
    }

    public function isValid($data)
    {
        if (isset($data['correct'])) {
            $this->changeAnswerAdditionalElementToCheckedCheckbox($data['correct']);
        }

        /*
         * Enable validation fo content, depending of type.
         */
        $type = $data['type'];
        switch($type)
        {
            case QuestionEntity::TYPE_AUDIO:
            case QuestionEntity::TYPE_IMAGE:
            case QuestionEntity::TYPE_VIDEO:
            case QuestionEntity::TYPE_TEXT:

                $name = sprintf('content_%s', $type);

                /*
                 * Reseting other types of values
                 */
                foreach($data as $key => $value) {
                    if ($name !== $key && false !== strpos($key, 'content_')) {
                        $data[$key] = null;
                    }
                }

                /**
                 * If editable, image upload is not required
                 */
                $required = true;
                if ($type == QuestionEntity::TYPE_IMAGE && $this->isPopulate) {
                    $required = false;
                }

                $this->getElement($name)->setRequired($required);
                break;
        }

        return parent::isValid($data);
    }

    public function getValues($suppressArrayNotation = false)
    {
        $result = parent::getValues($suppressArrayNotation);

        $type = $result['type'];
        $result['content'] = $result[sprintf('content_%s', $type)];

        return $result;
    }

    protected $isPopulate = false;

    public function populate(array $values)
    {
        if (isset($values['correct'])) {
            $this->changeAnswerAdditionalElementToCheckedCheckbox($values['correct']);
            unset($values['correct']);
        }

        $type = $values['type'];
        if (empty($values[sprintf('content_%s', $type)])) {
            $values[sprintf('content_%s', $type)] = $values['content'];
        }

        $this->isPopulate = true;

        return parent::populate($values);
    }

    private function changeAnswerAdditionalElementToCheckedCheckbox($elementName)
    {
        $element = $this->getSubForm('answers')->getElement($elementName);
        if ($element instanceof \Zend\Form\Element)
        {
            $element->setAttrib('content', sprintf('<input type="radio" name="correct" value="%s" checked>', $element->getName()));
        }
    }
}
?>
```