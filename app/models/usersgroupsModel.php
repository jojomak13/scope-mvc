<?php

namespace SCOPE\Models;

class usersgroupsModel extends AbstractModel
{
    public $GroupId;
    public $GroupName;

    protected static $tableName = 'users_groups';
    protected static $primaryKey = 'GroupId';
    protected static $tableSchema = [
        'GroupId' => self::DATA_TYPE_INT,
        'GroupName' => self::DATA_TYPE_STR
    ];
}
