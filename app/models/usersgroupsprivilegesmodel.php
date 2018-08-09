<?php

namespace SCOPE\Models;

class usersgroupsprivilegesmodel extends AbstractModel
{
    public $Id;
    public $PrivilegeId;
    public $GroupId;

    protected static $tableName = 'users_groups_privileges';
    protected static $primaryKey = 'Id';
    protected static $tableSchema = [
        //'Id'          => self::DATA_TYPE_INT, // Remove primary key to skip duplicate ID's
        'PrivilegeId' => self::DATA_TYPE_INT,
        'GroupId'     => self::DATA_TYPE_INT
    ];

    public static function getGroupPrivilege($groupObject)
    {
        $data = ['groupid' => [$groupObject->GroupId, self::DATA_TYPE_INT]];
        
        $result = self::getby($data);
        $extractedPrivileges = [];
        
        if($result !== false){
            foreach($result as $groupPrivileges){
                $extractedPrivileges[] = $groupPrivileges->PrivilegeId;
            }
        }
        return $extractedPrivileges;
    }

    public static function getPrivilegesForGroups($groupid)
    {
        $sql = 'SELECT ugp.*, up.Privilege FROM ' . self::$tableName . ' ugp ';
        $sql .= ' INNER JOIN users_privileges up ON up.PrivilegeId = ugp.PrivilegeId';
        $sql .= ' Where ugp.GroupId = ' . $groupid;
        $privileges = self::get($sql);

        $extractedUrls = [];
        if($privileges != false){
            foreach($privileges as $privilege){
                $extractedUrls[] = $privilege->Privilege;
            }
        }

        return $extractedUrls;
    }

    public function updateCheckBox($oldData = [], $newData = [], $groupId)
    {
        $deletedData = array_diff($oldData, $newData);
        $insertedData = array_diff($newData, $oldData);
       
        // Start delete
        if(is_array($deletedData) && !empty($deletedData)){
            foreach($deletedData as $privilegeId){
                $user_group_privilige_id = self::getBy([
                    'PrivilegeId' => [$privilegeId, self::DATA_TYPE_INT],
                    'GroupId'     => [$groupId, self::DATA_TYPE_INT]
                ]);
                
                $this->Id = $user_group_privilige_id[0]->Id;
                self::delete(); // TODO:: make it self
            }
        }
        // End Delete
        
        // Start insert
        if(is_array($insertedData) && !empty($insertedData)){
            foreach($insertedData as $privilegeId){
                $this->GroupId = $groupId;
                $this->PrivilegeId = $privilegeId;
                self::save(false);
            }
        } 
        // End insert
    }
}