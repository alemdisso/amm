<?php
class Author_Form_IsbnChange extends Zend_Form
{
    public function init()
    {
        parent::init();

        // initialize form
        $this->setName('isbnChangeForm')
            ->setAction('/admin/edition/change-isbn')
            ->setMethod('post');

        $element = new Zend_Form_Element_Hidden('id');
        $element->addValidator('Int')
            ->addFilter('StringTrim');
        $this->addElement($element);
        $element->setDecorators(array('ViewHelper'));

        $element = new Zend_Form_Element_Text('isbn');
        $validator = new Moxca_Util_ValidIsbn();
        $element->setLabel(_('#ISBN:'))
                ->setDecorators(array(
                    'ViewHelper',
                    'Errors',
                    array(array('data' => 'HtmlTag'), array('tagClass' => 'div', 'class' => 'input')),
                    array('Label', array('tag' => 'div', 'tagClass' => 'label')),
                ))
                ->setOptions(array('class' => ''))
                ->addValidator($validator)
                ->addFilter('StringTrim');
        $this->addElement($element);

        // create submit button
        $element = new Zend_Form_Element_Submit('submit');
        $element->setLabel('#Submit') //Gravar
               ->setDecorators(array('ViewHelper','Errors',
                    array(array('data' => 'HtmlTag'),
                    array('tag' => 'div','class' => '')),
                  ))
               ->setOptions(array('class' => ''));
        $this->addElement($element);
    }

    public function process($data) {

        if ($this->isValid($data) !== true) {
            throw new Author_Form_EditionCreateException('Invalid data!');
        } else {
            $db = Zend_Registry::get('db');
            $editionMapper = new Author_Collection_EditionMapper($db);
            $editionId = $data['id'];
            $editionObj = $editionMapper->findById($editionId);
            $editionObj->setIsbn($data['isbn']);
            $editionMapper->update($editionObj);
            return $editionObj;
        }
    }
 }