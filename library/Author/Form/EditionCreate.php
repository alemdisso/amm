<?php
class Author_Form_EditionCreate extends Zend_Form
{
    public function init()
    {
        parent::init();

        // initialize form
        $this->setName('newEditionForm')
            ->setAction('/admin/edition/create')
            //->setAction('javascript:callEditionCreate();')
            ->setMethod('post');

        $element = new Zend_Form_Element_Text('title');
        $titleValidator = new Moxca_Util_ValidTitle();
        $element->setLabel(_('#Title:'))
                ->setDecorators(array(
                    'ViewHelper',
                    'Errors',
                    array(array('data' => 'HtmlTag'), array('tagClass' => 'div', 'class' => 'input')),
                    array('Label', array('tag' => 'div', 'tagClass' => 'label')),
                ))
                ->setOptions(array('class' => 'Full alpha omega'))
                ->setRequired(true)
                ->addErrorMessage(_("#Title is required"))
                ->addValidator($titleValidator)
                ->addFilter('StringTrim');
        $this->addElement($element);


        $typesObj = new Author_Collection_WorkTypes();
        $titlesArray = $typesObj->allTitles();


        $element = new Zend_Form_Element_Radio('type');
	$element->setLabel('#Tipo de livro?')
                ->setDecorators(array(
                    'ViewHelper',
                    'Errors',
                    array(array('data' => 'HtmlTag'), array('tagClass' => 'div', 'class' => 'option')),
                    array('Label', array('tag' => 'div', 'tagClass' => 'label')),
                ))
		->setMultiOptions($titlesArray)
                ->setSeparator('');
        $this->addElement($element);



        $element = new Zend_Form_Element_Select('editor');
        $element->setLabel('#Editor ')
                ->setDecorators(array(
                    'ViewHelper',
                    'Errors',
                    array(array('data' => 'HtmlTag'), array('tagClass' => 'div', 'class' => 'input')),
                    array('Label', array('tag' => 'div', 'tagClass' => 'label')),
                ))
                ->setOptions(array('class' => 'Full alpha omega'))
                ->setRegisterInArrayValidator(false);
        $this->addElement($element);


        $element = new Zend_Form_Element_Textarea('summary');
        $element->setLabel('#Summary:')
              ->setDecorators(array(
                  'ViewHelper',
                  'Errors',
                    array(array('data' => 'HtmlTag'), array('tagClass' => 'div', 'class' => 'input item_formulario')),
                    array('Label', array('tag' => 'div', 'tagClass' => 'label')),
              ))
            ->setAttrib('rows','3')
            ->setOptions(array('class' => 'Full alpha omega'))
            ->setRequired(false)
            ->addFilter('StringTrim');
        $this->addElement($element);

        $element = new Zend_Form_Element_Textarea('description');
        $element->setLabel('#Description:')
              ->setDecorators(array(
                  'ViewHelper',
                  'Errors',
                    array(array('data' => 'HtmlTag'), array('tagClass' => 'div', 'class' => 'input')),
                    array('Label', array('tag' => 'div', 'tagClass' => 'label')),
              ))
            ->setAttrib('rows','8')
            ->setOptions(array('class' => 'Full alpha omega'))
            ->setRequired(false)
            ->addFilter('StringTrim');
        $this->addElement($element);

        // create submit button
        $element = new Zend_Form_Element_Submit('submit');
        $element->setLabel('#Submit') //Gravar
               ->setDecorators(array('ViewHelper','Errors',
                    array(array('data' => 'HtmlTag'),
                    array('tag' => 'div','class' => 'two columns inset-by-nine omega')),
                    array('Label',
                      array('tag' => 'div','tagClass' => 'three columns alpha Invisible')
                    ),
                  ))
               ->setOptions(array('class' => 'submit Full alpha omega'));
        $this->addElement($element);



    }

    public function process($data) {

        if ($this->isValid($data) !== true) {
            throw new Author_Form_EditionCreateException('Invalid data!');
        } else {
            $db = Zend_Registry::get('db');
            $workMapper = new Author_Collection_WorkMapper($db);


            $work = new Author_Collection_Work();

            $work->SetTitle($data['title']);
            $work->SetType($data['type']);
            $work->SetDescription($data['description']);
            $work->SetSummary($data['summary']);
            $workMapper->insert($work);


            $editionMapper = new Author_Collection_EditionMapper($db);
            $edition = new Author_Collection_Edition($work->getId(), $data['editor']);

            $editionMapper->insert($edition);


            return $work->getId();
        }
    }
 }