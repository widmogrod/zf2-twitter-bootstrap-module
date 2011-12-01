# TwitterBootstrap

TwitterBootstrap is Zend Framework 2 module, which add integration with [twitter bootstrap toolkit](https://github.com/twitter/bootstrap).

*P.S.* Sory for my english. If You wish to help me with this project or correct my english description - You are welcome :)

## Requirements

* Zend Framework 2 (https://github.com/zendframework/zf2)
* ZF2 Assetic module (https://github.com/widmogrod/zf2-assetic-module)

## Installation

Simplest way:

  1. cd my/project/folder
  2. git clone git://github.com/widmogrod/zf2-twitter-bootstrap-module.git modules/TwitterBootstrap --recursive
  3. git clone git://github.com/widmogrod/zf2-assetic-module.git modules/Assetic --recursive
  4. open my/project/folder/configs/application.config.php and add 'TwitterBootstrap' and 'Assetic' to your 'modules' parameter.
  5. run in browser your project ie. http://example.com/twittertest


## Stylesheet attachment.

Stylesheet attachment to HTML document is done automaticly by _zf2-assetic-module_ (this module is still in development).

## Zend\Form integration.

```
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
```


## Project plan

* TODO
   * Messenger integration
   * View helper for alerts&errors
   * Configuration option witch allow use bootstrap with less
   * Create simple DataGrid

* DONE
   * create better stylesheet & JS attachment