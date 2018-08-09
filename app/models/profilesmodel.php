<?php

namespace SCOPE\Models;

class ProfilesModel extends AbstractModel
{
    public $Id;
    public $FirstName;
    public $LasName;
    public $Image;

    protected static $tableName = 'profiles';
    protected static $primaryKey = 'Id';
    protected static $tableSchema = [
        'Id' => self::DATA_TYPE_INT,
        'FirstName' => self::DATA_TYPE_STR,
        'LastName' => self::DATA_TYPE_STR,
        'Image' => self::DATA_TYPE_STR
    ];
}
