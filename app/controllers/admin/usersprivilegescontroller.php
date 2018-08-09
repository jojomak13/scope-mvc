<?php

namespace SCOPE\Controllers\Admin;

use SCOPE\Core\Controller;
use SCOPE\Models\UsersPrivilegesModel;
use SCOPE\Helpers\Validate;
use SCOPE\Helpers\Helper;
use SCOPE\Core\MESSENGER;


class UsersPrivilegesController extends Controller
{
    use Validate;
    use Helper;

    public $label_validate = [
        'privilegename' => 'req',
        'privilege'       => 'req',
    ];

   public function defaultAction()
   {
        $scripts = [
            '1' => 'datatables.min.js',
            '2' => 'dataTables.buttons.min.js',
            '3' => 'buttons.flash.min.js',
            '4' => 'jszip.min.js',
            '5' => 'pdfmake.min.js',
            '6' => 'vfs_fonts.js',
            '7' => 'buttons.html5.min.js',
            '8' => 'buttons.print.min.js',
            '9' => 'datatables-init.js',
        ];
        $this->_template->addScript($scripts);
        
        $this->language->load('template.temp');
        $this->language->load('usersprivileges.default');
        $this->language->load('usersprivileges.labels');

        $this->_data['privileges'] = UsersPrivilegesModel::getAll();
        $this->view(); 
   } 

   public function createAction()
   {
       
       $this->language->load('template.temp');
       $this->language->load('usersprivileges.create');
       $this->language->load('usersprivileges.labels');
       $this->language->load('validate.messages');
       
       if(isset($_POST['add']) && $this->isValid($this->label_validate, $_POST))
       {
            $userPrivilege = new UsersPrivilegesModel();
            $userPrivilege->Privilege = $this->filterString($_POST['privilege']);
            $userPrivilege->PrivilegeName = $this->filterString($_POST['privilegename']);
            
            if($userPrivilege->save()){
                $this->messenger->add('User Privilege create successfully');
            } else { 
                $this->messenger->add('Some thing went wrong please try again', MESSENGER::APP_MESSAGE_ERROR);
            }

            $this->redirect('/usersprivileges');          
       }
       
       $this->view();
   }

   public function editAction()
   {
        $id = $this->filterInt($this->_params[0]);
        $userPrivilege =  UsersPrivilegesModel::getByPK($id);
       
        if($userPrivilege === false){
            $this->messenger->add('There is no privilege with this id', MESSENGER::APP_MESSAGE_ERROR);   
            $this->redirect('/usersprivileges');
        }

        $this->_data['privilege'] = $userPrivilege;

        $this->language->load('template.temp');
        $this->language->load('usersprivileges.edit');
        $this->language->load('usersprivileges.labels');
        $this->language->load('validate.messages');  

        if(isset($_POST['edit']) && $this->isValid($this->label_validate, $_POST))
        {
            $Privilege = new UsersPrivilegesModel();
            $Privilege->PrivilegeId = $id;
            $Privilege->PrivilegeName = $this->filterString($_POST['privilegename']);
            $Privilege->Privilege = $this->filterString($_POST['privilege']);

            if($Privilege->save()){
                $this->messenger->add('Privilege edit successfully');   
            } else {
                 $this->messenger->add('Some thing went wrong please try again', MESSENGER::APP_MESSAGE_ERROR);
            }
     
            $this->redirect('/usersprivileges');
        }

        $this->view();
   }

   public function deleteAction()
   {
       $id = $this->filterInt($this->_params[0]);
    
       $userPrivilege = UsersPrivilegesModel::getByPK($id);
       
       if($userPrivilege === false){
            $this->messenger->add('There is no privilege with this id', MESSENGER::APP_MESSAGE_ERROR);   
            $this->redirect('/usersprivileges');
       }

       if($userPrivilege->delete($id)){
            $this->messenger->add('Privilege deleted successfully');   
       } else {
            $this->messenger->add('Some thing went wrong please try again', MESSENGER::APP_MESSAGE_ERROR);
       }

       $this->redirect('/usersprivileges');
       
   }

}
