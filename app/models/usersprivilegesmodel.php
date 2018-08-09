<?php

namespace SCOPE\models;

use SCOPE\Models\AbstractModel;

class UsersPrivilegesModel extends AbstractModel
{
    public $PrivilegeId;
    public $PrivilegeName;
    public $Privilege;

    protected static $tableName = 'users_privileges';
    protected static $primaryKey = 'PrivilegeId';
    protected static $tableSchema = [
        'PrivilegeId'   => self::DATA_TYPE_INT,
        'PrivilegeName' => self::DATA_TYPE_STR,
        'Privilege'     => self::DATA_TYPE_STR
    ];
}