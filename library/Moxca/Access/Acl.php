<?php

class Moxca_Access_Acl extends Zend_Acl
{

public function __construct() {

    $rolesObj = new Moxca_Access_Roles();
    $roles = $rolesObj->AllRoles();
    $previousRole = null;
    while (list($role, $label) = each($roles)) {
        if ($role != Moxca_Access_RolesConstants::ROLE_SYSADMIN) {
            if ($previousRole === null) {
                $this->addRole(new Zend_Acl_Role($role));
            } else {
                $this->addRole(new Zend_Acl_Role($role), $previousRole);
            }
            $previousRole = $role;
        }


    }
    $this->addRole(new Zend_Acl_Role(Moxca_Access_RolesConstants::ROLE_SYSADMIN));
    $this->allow(Moxca_Access_RolesConstants::ROLE_SYSADMIN);

    $this->add(new Zend_Acl_Resource('moxca:auth'));
    $this->add(new Zend_Acl_Resource('moxca:auth.login'));
    $this->add(new Zend_Acl_Resource('moxca:auth.logout'));
    $this->add(new Zend_Acl_Resource('moxca:auth.user'));
    $this->add(new Zend_Acl_Resource('moxca:finances.outlay'));
    $this->add(new Zend_Acl_Resource('moxca:finances.receivable'));
    $this->add(new Zend_Acl_Resource('moxca:projects'));
    $this->add(new Zend_Acl_Resource('moxca:projects.index'));
    $this->add(new Zend_Acl_Resource('moxca:projects.action'));
    $this->add(new Zend_Acl_Resource('moxca:projects.contract'));
    $this->add(new Zend_Acl_Resource('moxca:projects.project'));
    $this->add(new Zend_Acl_Resource('moxca:resources.material-supply'));
    $this->add(new Zend_Acl_Resource('moxca:resources.outside-service'));
    $this->add(new Zend_Acl_Resource('moxca:resources.responsible'));
    $this->add(new Zend_Acl_Resource('moxca:resources.team-member'));
    $this->add(new Zend_Acl_Resource('moxca:register'));
    $this->add(new Zend_Acl_Resource('moxca:register.contact'));
    $this->add(new Zend_Acl_Resource('moxca:register.institution'));
    $this->add(new Zend_Acl_Resource('moxca:register.linkage'));

    $this->allow(Moxca_Access_RolesConstants::ROLE_UNKNOWN,       'moxca:auth.login', 'index');
    $this->allow(Moxca_Access_RolesConstants::ROLE_UNKNOWN,       'moxca:auth.logout', 'index');

    $this->allow(Moxca_Access_RolesConstants::ROLE_ADMINISTRATOR, 'moxca:finances.outlay', 'create');
    $this->allow(Moxca_Access_RolesConstants::ROLE_ADMINISTRATOR, 'moxca:finances.outlay', 'edit');
    $this->allow(Moxca_Access_RolesConstants::ROLE_ADMINISTRATOR, 'moxca:finances.outlay', 'notify');
    $this->deny(Moxca_Access_RolesConstants::ROLE_CONTROLLER,     'moxca:finances.outlay');
    $this->allow(Moxca_Access_RolesConstants::ROLE_COORDINATOR, 'moxca:finances.outlay', 'create');
    $this->allow(Moxca_Access_RolesConstants::ROLE_DIRECTOR, 'moxca:finances.outlay', 'edit');
    $this->allow(Moxca_Access_RolesConstants::ROLE_DIRECTOR, 'moxca:finances.outlay', 'create');
    $this->allow(Moxca_Access_RolesConstants::ROLE_DIRECTOR, 'moxca:finances.outlay', 'notify');


    $this->allow(Moxca_Access_RolesConstants::ROLE_ASSISTANT,     'moxca:finances.receivable', 'create');
    $this->allow(Moxca_Access_RolesConstants::ROLE_ASSISTANT,     'moxca:finances.receivable', 'edit');
    $this->allow(Moxca_Access_RolesConstants::ROLE_ASSISTANT,     'moxca:finances.receivable', 'notify');
    $this->allow(Moxca_Access_RolesConstants::ROLE_ASSISTANT,     'moxca:finances.receivable', 'detail');
    $this->deny(Moxca_Access_RolesConstants::ROLE_CONTROLLER,     'moxca:finances.receivable');
    $this->allow(Moxca_Access_RolesConstants::ROLE_COORDINATOR,   'moxca:finances.receivable');
    $this->allow(Moxca_Access_RolesConstants::ROLE_DIRECTOR,      'moxca:finances.receivable');
    $this->allow(Moxca_Access_RolesConstants::ROLE_ASSISTANT,     'moxca:finances.receivable');

    $this->allow(Moxca_Access_RolesConstants::ROLE_ASSISTANT,     'moxca:projects.index', 'index');
    $this->allow(Moxca_Access_RolesConstants::ROLE_ASSISTANT,     'moxca:projects.index', 'all-projects');
    $this->allow(Moxca_Access_RolesConstants::ROLE_ASSISTANT,     'moxca:projects.index', 'engagement');
    $this->allow(Moxca_Access_RolesConstants::ROLE_COORDINATOR,   'moxca:projects.action', 'accept-receipt');
    $this->allow(Moxca_Access_RolesConstants::ROLE_CONTROLLER,    'moxca:projects.action', 'acknowledge-receipt');
    $this->allow(Moxca_Access_RolesConstants::ROLE_CONTROLLER,    'moxca:projects.action', 'acknowledge-start');
    $this->allow(Moxca_Access_RolesConstants::ROLE_ADMINISTRATOR, 'moxca:projects.action', 'delivery-notify');
    $this->deny(Moxca_Access_RolesConstants::ROLE_CONTROLLER,     'moxca:projects.action', 'delivery-notify');
    $this->allow(Moxca_Access_RolesConstants::ROLE_ASSISTANT,     'moxca:projects.action', 'create');
    $this->allow(Moxca_Access_RolesConstants::ROLE_CONTROLLER,    'moxca:projects.action', 'change-start');
    $this->allow(Moxca_Access_RolesConstants::ROLE_CONTROLLER,    'moxca:projects.action', 'create-product');
    $this->allow(Moxca_Access_RolesConstants::ROLE_ASSISTANT,     'moxca:projects.action', 'edit-product');
    $this->allow(Moxca_Access_RolesConstants::ROLE_ASSISTANT,     'moxca:projects.action', 'detail');
    $this->allow(Moxca_Access_RolesConstants::ROLE_ASSISTANT,     'moxca:projects.action', 'edit');
    $this->allow(Moxca_Access_RolesConstants::ROLE_ASSISTANT,     'moxca:projects.action', 'populate-subordinated-to');
    $this->allow(Moxca_Access_RolesConstants::ROLE_COORDINATOR,   'moxca:projects.action', 'reject-receipt');
    $this->allow(Moxca_Access_RolesConstants::ROLE_ASSISTANT,     'moxca:projects.action', 'remove');
    $this->allow(Moxca_Access_RolesConstants::ROLE_COORDINATOR,   'moxca:projects.action', 'budget-create');
    $this->allow(Moxca_Access_RolesConstants::ROLE_COORDINATOR,   'moxca:projects.action', 'budget-forecast');

    $this->allow(Moxca_Access_RolesConstants::ROLE_CONTROLLER,    'moxca:resources.responsible');
    $this->allow(Moxca_Access_RolesConstants::ROLE_CONTROLLER,    'moxca:resources.responsible', 'create');
    $this->allow(Moxca_Access_RolesConstants::ROLE_CONTROLLER,    'moxca:resources.responsible', 'assigned');
    $this->allow(Moxca_Access_RolesConstants::ROLE_ADMINISTRATOR, 'moxca:resources.responsible', 'contract');
    $this->allow(Moxca_Access_RolesConstants::ROLE_ADMINISTRATOR, 'moxca:resources.responsible', 'dismiss');
    $this->deny(Moxca_Access_RolesConstants::ROLE_CONTROLLER,     'moxca:resources.responsible', 'contract');
    $this->deny(Moxca_Access_RolesConstants::ROLE_CONTROLLER,     'moxca:resources.responsible', 'dismiss');

    $this->allow(Moxca_Access_RolesConstants::ROLE_CONTROLLER,    'moxca:resources.material-supply');
    $this->allow(Moxca_Access_RolesConstants::ROLE_CONTROLLER,    'moxca:resources.material-supply', 'create');
    $this->allow(Moxca_Access_RolesConstants::ROLE_CONTROLLER,    'moxca:resources.material-supply', 'contract');
    $this->allow(Moxca_Access_RolesConstants::ROLE_CONTROLLER,    'moxca:resources.material-supply', 'dismiss-material');
    $this->allow(Moxca_Access_RolesConstants::ROLE_ADMINISTRATOR, 'moxca:resources.material-supply', 'contract');
    $this->allow(Moxca_Access_RolesConstants::ROLE_ASSISTANT,     'moxca:resources.material-supply', 'outlays');

    $this->allow(Moxca_Access_RolesConstants::ROLE_ASSISTANT,     'moxca:projects.project', 'amend');
    $this->allow(Moxca_Access_RolesConstants::ROLE_ASSISTANT,     'moxca:projects.project', 'create');
    $this->allow(Moxca_Access_RolesConstants::ROLE_ASSISTANT,     'moxca:projects.project', 'detail');
    $this->allow(Moxca_Access_RolesConstants::ROLE_ASSISTANT,     'moxca:projects.project', 'edit');
    $this->allow(Moxca_Access_RolesConstants::ROLE_ADMINISTRATOR, 'moxca:projects.project', 'payables');
    $this->allow(Moxca_Access_RolesConstants::ROLE_ASSISTANT,     'moxca:projects.project', 'receivables');
    $this->allow(Moxca_Access_RolesConstants::ROLE_CONTROLLER,    'moxca:projects.project', 'unacknowledged');
    $this->allow(Moxca_Access_RolesConstants::ROLE_ASSISTANT,     'moxca:projects.project', 'populate-responsible-at-client');
    $this->allow(Moxca_Access_RolesConstants::ROLE_ASSISTANT,     'moxca:projects.project', 'engagement');

    $this->allow(Moxca_Access_RolesConstants::ROLE_ADMINISTRATOR, 'moxca:projects.contract', 'create');
    $this->allow(Moxca_Access_RolesConstants::ROLE_ADMINISTRATOR, 'moxca:projects.contract', 'edit');
    $this->allow(Moxca_Access_RolesConstants::ROLE_ADMINISTRATOR, 'moxca:projects.contract', 'detail');
    $this->deny(Moxca_Access_RolesConstants::ROLE_CONTROLLER,     'moxca:projects.contract');

    $this->allow(Moxca_Access_RolesConstants::ROLE_ASSISTANT,     'moxca:register.contact', 'create');
    $this->allow(Moxca_Access_RolesConstants::ROLE_ASSISTANT,     'moxca:register.contact', 'remove');
    $this->allow(Moxca_Access_RolesConstants::ROLE_ASSISTANT,     'moxca:register.contact', 'edit');
    $this->allow(Moxca_Access_RolesConstants::ROLE_ASSISTANT,     'moxca:register.contact', 'detail');
    $this->allow(Moxca_Access_RolesConstants::ROLE_ASSISTANT,     'moxca:register.contact', 'index');
    $this->allow(Moxca_Access_RolesConstants::ROLE_ASSISTANT,     'moxca:register.contact', 'add-phone-number');
    $this->allow(Moxca_Access_RolesConstants::ROLE_ASSISTANT,     'moxca:register.contact', 'change-phone-number');
    $this->allow(Moxca_Access_RolesConstants::ROLE_ASSISTANT,     'moxca:register.contact', 'add-email');
    $this->allow(Moxca_Access_RolesConstants::ROLE_ASSISTANT,     'moxca:register.contact', 'change-email');

    $this->allow(Moxca_Access_RolesConstants::ROLE_ASSISTANT,     'moxca:register.institution', 'create');
    $this->allow(Moxca_Access_RolesConstants::ROLE_ASSISTANT,     'moxca:register.institution', 'edit');
    $this->allow(Moxca_Access_RolesConstants::ROLE_ASSISTANT,     'moxca:register.institution', 'index');
    $this->allow(Moxca_Access_RolesConstants::ROLE_ASSISTANT,     'moxca:register.institution', 'detail');

    $this->allow(Moxca_Access_RolesConstants::ROLE_ASSISTANT,     'moxca:register.linkage', 'create');
    $this->allow(Moxca_Access_RolesConstants::ROLE_ASSISTANT,     'moxca:register.linkage', 'edit');
    $this->allow(Moxca_Access_RolesConstants::ROLE_ASSISTANT,     'moxca:register.linkage', 'add-phone-number');
    $this->allow(Moxca_Access_RolesConstants::ROLE_ASSISTANT,     'moxca:register.linkage', 'change-phone-number');
    $this->allow(Moxca_Access_RolesConstants::ROLE_ASSISTANT,     'moxca:register.linkage', 'add-email');
    $this->allow(Moxca_Access_RolesConstants::ROLE_ASSISTANT,     'moxca:register.linkage', 'change-email');

  }

}
