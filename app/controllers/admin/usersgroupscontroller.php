<?php

namespace SCOPE\Controllers\Admin;

use SCOPE\Core\Controller;
use SCOPE\Models\UsersGroupsModel;
use SCOPE\Models\UsersPrivilegesModel;
use SCOPE\Models\UsersGroupsPrivilegesModel;

use SCOPE\Helpers\Validate;
use SCOPE\Helpers\Helper;
use SCOPE\Core\MESSENGER;


class UsersGroupsController extends Controller
{
    use Validate;
    use Helper;

    public $label_validate = [
        'groupName' => 'req'
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
        $this->language->load('usersgroups.default');
        $this->language->load('usersgroups.labels');

        $this->_data['groups'] = UsersGroupsModel::getAll();
        $this->view(); 
   } 

   public function createAction()
   {

       $this->language->load('template.temp');
       $this->language->load('usersgroups.create');
       $this->language->load('usersgroups.labels');
       $this->language->load('validate.messages');
       
       $this->_data['privileges'] = UsersPrivilegesModel::getAll();

       if(isset($_POST['add']) && $this->isValid($this->label_validate, $_POST))
       {   
            $group = new UsersGroupsModel();
            $group->GroupName = $this->filterString($_POST['groupName']);
            
            if($group->save()){
                if(isset($_POST['privilege']) && is_array($_POST['privilege'])){
                    foreach($_POST['privilege'] as $privilegeId){
                        $groupPrivileges = new UsersGroupsPrivilegesModel();
                        $groupPrivileges->GroupId = $group->GroupId;
                        $groupPrivileges->PrivilegeId = $privilegeId;
                        $groupPrivileges->save();
                    }
                }
           
                $this->messenger->add('Users Group create successfully');
            } else { 
                $this->messenger->add('Some thing went wrong please try again', MESSENGER::APP_MESSAGE_ERROR);
            }

            $this->redirect('/usersgroups');          
       }
       
       $this->view();
   }

   public function editAction()
   {
        $id = $this->filterInt($this->_params[0]);
        $group =  UsersGroupsModel::getByPK($id);
       
        if($group === false){
            $this->messenger->add('There is no user group with this id', MESSENGER::APP_MESSAGE_ERROR);   
            $this->redirect('/usersgroups');
        }

        $this->_data['group'] = $group;
        $this->_data['privileges'] = UsersPrivilegesModel::getAll();
        $extractedPrivileges = $this->_data['groupPrivileges'] = UsersGroupsPrivilegesModel::getGroupPrivilege($group);

        $this->language->load('template.temp');
        $this->language->load('usersgroups.edit');
        $this->language->load('usersgroups.labels');
        $this->language->load('validate.messages');  

        if(isset($_POST['edit']) && $this->isValid($this->label_validate, $_POST))
        {
            $group = new UsersgroupsModel();
            $group->GroupId = $id;
            $group->GroupName = $this->filterString($_POST['groupName']);

            if($group->save()){
                $groupPrivileges = new UsersGroupsPrivilegesModel();
                $insertedData = isset($_POST['privilege'])? $_POST['privilege'] : [];
                $groupPrivileges->updateCheckBox($extractedPrivileges, $insertedData, $id);

                $this->messenger->add('User group edit successfully');   
            } else {
                 $this->messenger->add('Some thing went wrong please try again', MESSENGER::APP_MESSAGE_ERROR);
            }
     
            $this->redirect('/usersgroups');
        }

        $this->view();
   }

   public function deleteAction()
   {
       $id = $this->filterInt($this->_params[0]);
    
       $group = UsersGroupsModel::getByPK($id);
       
       if($group === false){
            $this->messenger->add('There is no user group with this id', MESSENGER::APP_MESSAGE_ERROR);   
            $this->redirect('/usersgroups');
       }

       $groupPrivileges = UsersGroupsPrivilegesModel::getBy(['GroupId' => [$id, UsersGroupsPrivilegesModel::DATA_TYPE_INT]]);

       if($groupPrivileges !== false){
            foreach($groupPrivileges as $groupPrivilege){
                $groupPrivilege->delete();
            }
       }
      
       if($group->delete($id)){
            $this->messenger->add('User Group deleted successfully');   
       } else {
            $this->messenger->add('Some thing went wrong please try again', MESSENGER::APP_MESSAGE_ERROR);
       }

       $this->redirect('/usersgroups');
       
   }

}
