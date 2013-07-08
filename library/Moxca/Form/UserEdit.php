<?php
class Moxca_Form_UserEdit extends Moxca_Form_UserCreate
{
    public function init()
    {
        parent::init();

        // initialize form
        $this->setName('editUserForm')
            ->setAction('/auth/user/edit')
            ->setMethod('post');

        $password = $this->getElement('password');
        $password->setRequired(false);

        $id = new Zend_Form_Element_Hidden('id');
        $id->addValidator('Int')
            ->addFilter('StringTrim');
        $this->addElement($id);
    }

    public function process($data) {

        $db = Zend_Registry::get('db');
        $userMapper = new Moxca_Auth_UserMapper($db);

        if ($this->isValid($data) !== true) {
            throw new Moxca_Form_UserEditException(_('#Invalid data!'));
        } else {
            $id = $data['id'];
            $user = $userMapper->findById($id);
            $user->SetName($data['name']);
            $user->SetLogin($data['login']);
            $user->SetEmail($data['email']);
            $user->SetRole($data['role']);

            if ($data['password'] != "") {
                $user->SetPassword($data['password']);
            }
            $userMapper->update($user);
        }
    }
 }